<?php

namespace Database\Factories\Helpers;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use App\Models\Mod;
use App\Models\ModReview;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Repository\ModRepository;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

// contains a lot of functional for the ModFactory and mod seeder
class ModFactoryHelper
{
    // configurations for mod instance
    private static array $modConfigs = [
        'hasAuthor' => false,      // will this mod have an author?
        'hasGuide' => false,       // will this mod have a guide?
        'hasModReview' => 0,       // mod reviews number for this mod
        'hasTrailerVideo' => "",   // a link of the trailer video
        'hasReviewVideo'  => "",   // a link of the review video
        'hasTags' => "",           // tags names for this mod
        //'hasMainImage' => true,  // in any case we need to have a main image so we don't set such a flag because it is true by default
        'hasScreenshots' => 0,     // the number of screenshots
        'hasBoxartImage' => false,
        'hasBackgroundImage' => false,
        'hasGalleryVideoImage' => false,
    ];

    private ModRepository $modRepository;
    private Mod $mod; // the current modification instance which can be changed and returned as result of the getModel() function
    private FileManager $fileManager;

    private array $imagesPathsList; // an array of storage paths to fake mod images

    public function __construct(Mod $mod)
    {
		$this->mod = $mod;
		$this->modRepository = ModRepository::getStandardModRepositoryInstance();

        $this->fileManager = new LocalFileManager('storage_root');
        $this->imagesPathsList = self::getFakeImagesPathsList();
    }

    // ------------------------------------------------------------------------------- //
    //                             PUBLIC METHODS                                      //
    // ------------------------------------------------------------------------------- //

	// according to configurations this function creates, sets up and returns
	// a new Mod instance
	public function getModel(): Mod
	{
		// make basic configurations
		$this->addInternalConfigurations();

		// for making external relations first we need to store a modification into the database;
		$this->mod->save();

		// make external relations to the modification
		$this->addExternalRelations();

		$this->resetConfigurationsToDefault(); // reset configurations to the default state
		$this->mod->update();      // store all the mod changes into the database

		return $this->mod;         // return a new Mod instance
	}



	// ------------------------------------------------------------------------------- //
	//                             PUBLIC HELPER UTILS                                 //
	// ------------------------------------------------------------------------------- //

	// a helper for setting a configuration for mod
	public static function setModConfig(string $key, mixed $value): void
	{
		self::$modConfigs[$key] = $value;
	}

	// a helper for getting a configuration for mod
	public static function getModConfig(string $key): mixed
	{
		return self::$modConfigs[$key];
	}

	// returns an array of paths to the mod fake images;
	// these images can be used as main images, screenshots, background images, etc.
	public static function getFakeImagesPathsList(): array
	{
		$fakeModImagesDirPath = Utils::getFileTypeConfig(Mod::IMAGE_TYPE_MAIN)['fake'];
		return Storage::disk('storage_root')->allFiles($fakeModImagesDirPath);
	}


	// returns a File object of some random image
	public function getRandImageFile(): File
	{
		$randomPathToImage = Arr::random($this->imagesPathsList);

		return $this->fileManager->getFileByStoragePath($randomPathToImage);
	}

	// makes an array of screenshots and returns this array
	public function getScreenshotsFilesList(int $screenshotsNumber = 3): array
	{
		$screenshotsFileList = [];

		// make an array of random screenshots files
		for ($i = 0; $i < $screenshotsNumber; $i++)
		{
			$screenshotsFileList[] = $this->getRandImageFile();
		}

		return $screenshotsFileList;
	}




	// ------------------------------------------------------------------------------- //
    //                             PRIVATE  ADDERS                                     //
    // ------------------------------------------------------------------------------- //

    // configs internal fields of a modification model (these fields are placed in the mods table)
    private function addInternalConfigurations(): void
    {
    	$this->addAuthor();
		$this->addGuide();
    }

    // make external relations to the modification
    private function addExternalRelations(): void
    {
        // for the next configurations we must have a Mod instance which is already
        // stored in the database to make external relations to this modification

		$this->addModReviews();
		$this->addVideos();       // add a trailer video or review video or both together

		$this->addTags();
		$this->addImages();       // add a main image, screenshots, ect.
    }


    // creates a new author (user) special for this modification
    private function addAuthor(): void
    {
    	if (self::getModConfig('hasAuthor')) // if we want to relate an author
		{
			$author = User::factory()->create();
			$this->mod->author = $author;
		}
    } // addAuthor()


    // creates a new guide (post) special for this modification
    private function addGuide(): void
    {
    	if (self::getModCOnfig('hasGuide')) // if we want to relate a guide
		{
			$postCategory = PostCategory::factory()->create();
			$guide = Post::factory()->create(['post_category_id' => $postCategory->id]);
			$this->mod->guide = $guide;
		}
    } // addGuide()


    // adds some mod reviews to the current modification
    private function addModReviews(): void
    {
		$modReviewNum = self::getModConfig('hasModReview'); // get a count of necessary mod reviews

        for ($i = 0; $i < $modReviewNum; $i++)
        {
            ModReview::factory()
                ->hasAuthor()            // set a random author
                ->hasMod($this->mod->id) // relate this modification to the modification review
                ->hasModRating()         // set a random modification rating
                ->getModel();
        }
    } // addModReviews()

	// add related videos to this modification
	private function addVideos(): void
	{
		$trailerLink = self::getModConfig('hasTrailerVideo') ?: null;
		$reviewLink = self::getModConfig('hasReviewVideo') ?: null;

		$this->modRepository->relateVideosToMod($this->mod, $trailerLink, $reviewLink);
	}

	// add tags to this modification
	private function addTags(): void
	{
		if ($tags = self::getModConfig('hasTags'))  // if we have some tags
		{
			$this->mod->tags = $tags;
		}
	}


	// relate images (if it is necessary in particular cases) to this modification
    private function addImages(): void
	{
		$this->addMainImage();  // in any case we need to have a main image
		$this->addScreenshots();
		$this->addBoxartImage();
		$this->addBackgroundImage();
	}

    // adds a random image as a main
    private function addMainImage(): void
    {
        $this->mod->mainImage = $this->getRandImageFile(); // make a relation
    }

    // adds random images as screenshots
    private function addScreenshots(): void
    {
		$screenshotsNumber = self::getModConfig('hasScreenshots');
		$screenshotsFiles = $this->getScreenshotsFilesList($screenshotsNumber);
		$this->mod->screenshots = $screenshotsFiles; // make relations
    }

    // adds a random image as a boxart image
    private function addBoxartImage(): void
    {
		if (self::getModConfig('hasBoxartImage')) // if we want to add a boxart image
		{
			$this->mod->boxartImage = $this->getRandImageFile(); // make a relation
		}
    }

    // adds a random image as a background image
    private function addBackgroundImage(): void
    {
		if (self::getModConfig('hasBackgroundImage')) // if we want to add a background image
		{
			$this->mod->backgroundImage = $this->getRandImageFile(); // make a relation
		}
    }



    // ------------------------------------------------------------------------------- //
    //                             PRIVATE HELPER UTILS                                //
    // ------------------------------------------------------------------------------- //

    // after each creation of a mod instance we must reset configurations
    private function resetConfigurationsToDefault(): void
    {
        self::$modConfigs = [
            'hasAuthor' => false,      // will this mod have an author?
            'hasGuide' => false,       // will this mod have a guide?
            'hasModReview' => 0,       // mod reviews number for this mod
            'hasTrailerVideo' => "",   // a link of the trailer video
            'hasReviewVideo'  => "",   // a link of the review video
            'hasTags' => "",           // tags names for this mod
            'hasMainImage' => false,
            'hasScreenshots' => false,
            'hasBoxartImage' => false,
            'hasBackgroundImage' => false,
            'hasGalleryVideoImage' => false,
        ];
    }


}