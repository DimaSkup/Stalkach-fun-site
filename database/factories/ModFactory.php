<?php

namespace Database\Factories;

use Database\Factories\Helpers\ModFactoryHelper;
use App\Models\Mod;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/*
  EXAMPLES OF USING:
        $mod0 = Mod::factory()->getModel();                          // create a new basic mod and record it into the database

        $mod1 = Mod::factory()->hasAuthor()->getModel();             // +author

        $mod2 = Mod::factory()->hasAuthor()->hasGuide()->getModel(); // +author +guide

        // +author +guide +two mod reviews +trailer +review videos
        $mod3 = Mod::factory()->hasAuthor()
                              ->hasGuide()
                              ->hasModReviews(2)
                              ->hasTrailerVideo()->hasReviewVideo()
                              ->getModel();

        // +author +guide +two mod reviews +trailer +review videos +tags +images
        $mod4 = Mod::factory()->hasAuthor()
                              ->hasGuide()
                              ->hasModReviews(2)
                              ->hasTrailerVideo()->hasReviewVideo()
                              ->hasTags()
                              ->hasMainImage()                       // with a random main image
                              ->hasScreenshots()                     // with random screenshots
                              ->hasBoxartImage()                     // with a random boxart image
                              ->hasBackgroundImage()                 // with a random background image
                              ->getModel();




		// --- HELPERS --- //

		// to get an array of paths to all the mod FAKE images
		$pathsArray = Mod::factory()->getFakeImagesPathsList();

		// to get a File object of some random mod image
		$imageFile = Mod::factory()->getRandImageFile();
 */

class ModFactory extends Factory
{
    protected $faker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mod::class;

    private static string $defaultTrailerVideoLink = "https://www.youtube.com/watch?v=VmoQTgX78do";
    private static string $defaultReviewVideoLink = "https://www.youtube.com/watch?v=OuHdnsF118U";

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create();

        // --------------------------- prepare common data ---------------------------------- //
        $name = $this->faker->unique()->text(40);
        $description = substr(implode(PHP_EOL, $this->faker->paragraphs(2)), 0, 255);
        $presentation = $this->faker->text;
        $game = array_rand(Mod::GAME);
        $views = random_int(100, 1000);
        $downloadLinks = [
            'google_drive_disk'     => "https://drive.google.com/file/d/180WWpheT_Q1vkoKpFv6MRIikWDaAfheS/view?usp=sharing",
            'yandex_disk'           => "https://disk.yandex.ru/",
            'cloud_mail_disk'       => "https://cloud.mail.ru/",
        ];

        # -------------------------- prepare other links ------------------------------------- #
        $customLinks = [];
        $societyLinks = [];

        return [
            // common data
            'name'              => $name,
            //'slug'              => Str::slug($name),
            'description'       => $description,
            'presentation'      => $presentation,
            'game'              => $game,
            'views'             => $views,
            'download_links'    => $downloadLinks,

            // relations
            'guide_id'          => null, // by default we don't have a guide for a mod
            'author_id'         => null, // author id can be null only in case if we blocked the user but didn't delete the modification

            // other links
            'custom_links'      => $customLinks,
            'society_links'     => $societyLinks,

            'created_at'        => now(),
            'updated_at'        => now(),
        ]; // return
    }  // definition()

    /**
     * doing some changes about the model data
     * @return Factory
     */
    public function mod(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            foreach ($data as $key => $value)
            {
                $attributes[$key] = $value;
            }

            return $attributes;
        });
    } // mod()

	// ------------------------------------------------------------------------------- //
	//                             PUBLIC HELPERS                                      //
	// ------------------------------------------------------------------------------- //

	// returns an array of fake images files
	public function getFakeImagesPathsList(): array
	{
		return ModFactoryHelper::getFakeImagesPathsList();
	}

	// returns a File object of some random image
	public function getRandImageFile(): File
	{
		$modFactoryHelper = new ModFactoryHelper($this->make());
		return $modFactoryHelper->getRandImageFile();
	}


    // ---------------------------------------------------------------------------- //
    //                              FOR UNIT TESTS                                  //
    // ---------------------------------------------------------------------------- //

    // in case if we set some external relations we must get
    // a new mod instance using this function
    public function getModel(): Mod
    {
        $modFactoryHelper = new ModFactoryHelper($this->make());
        return $modFactoryHelper->getModel();
    }

    // set that this mod will have an author
    public function hasAuthor(): ModFactory
    {
        $this->setModConfig('hasAuthor', true);
        return $this;
    }

    // set that this mod will have a guide
    public function hasGuide(): ModFactory
    {
        $this->setModConfig('hasGuide', true);
        return $this;
    }

    // set that this mod will have one or several mod review
    public function hasModReviews(int $modReviewsCount = 1): ModFactory
    {
        $this->setModConfig('hasModReview', $modReviewsCount);
        return $this;
    }

    // set that this mod will have a trailer video
    public function hasTrailerVideo(string $trailerVideoLink = ""): ModFactory
    {
        $trailerVideoLink = $trailerVideoLink ?: self::$defaultTrailerVideoLink;
        $this->setModConfig('hasTrailerVideo', $trailerVideoLink);
        return $this;
    }

    // set that this mod will have a review video
    public function hasReviewVideo(string $reviewVideoLink = ""): ModFactory
    {
        $reviewVideoLink = $reviewVideoLink ?: self::$defaultReviewVideoLink;
        $this->setModConfig('hasReviewVideo', $reviewVideoLink);
        return $this;
    }

    // set that this mod will have some tags
    public function hasTags(string $tagsString = ""): ModFactory
    {
        $tagsString = $tagsString ?: "factoryTag1 factoryTag2";
        $this->setModConfig('hasTags', $tagsString);

        return $this;
    }

    public function hasMainImage(): ModFactory
	{
		// do nothing because in any case the modification must have a main image
		return $this;
	}

    // set that this modification will have screenshots in count of $screenshotsNumber
    public function hasScreenshots(int $screenshotsNumber = 3): ModFactory
    {
    	if ($screenshotsNumber < 3)
		{
			throw new \InvalidArgumentException("modification can't have less that 3 screenshots");
		}

        $this->setModConfig('hasScreenshots', $screenshotsNumber);
        return $this;
    }

    // set that this modification will have a boxart image
    public function hasBoxartImage(): ModFactory
    {
        $this->setModConfig('hasBoxartImage', true);
        return $this;
    }

    // set that this modification will have a background image
    public function hasBackgroundImage(): ModFactory
    {
        $this->setModConfig('hasBackgroundImage', true);
        return $this;
    }

    // a helper for setting configurations for the mod
    private function setModConfig(string $key, mixed $value): void
    {
        ModFactoryHelper::setModConfig($key, $value);
    }




    // ---------------------------------------------------------------------------- //
    //                           FOR FEATURE TESTS                                  //
    // ---------------------------------------------------------------------------- //

    // returns correct raw modification data like we get it from the creation form;
    // takes a user to make a relation with him;
    public function getRawCorrectData(User $relatedUser): array
    {
        $faker = \Faker\Factory::create();

        // prepare some data
        $modificationName = $faker->name;
        $trailerVideoLink = "https://www.youtube.com/watch?v=HR5zpFs7YpY&ab_channel=TV-8-301";
        $reviewVideoLink = "https://www.youtube.com/watch?v=OuHdnsF118U";
        $googleDriveLink = "https://drive.google.com/file/d/180WWpheT_Q1vkoKpFv6MRIikWDaAfheS/view?usp=sharing";
        $yandexDiskLink = "https://disk.yandex.ru/";
        $mailRuDisk = "https://cloud.mail.ru/";
        $tags = 'mod_1 mod_2 mod_3';
        $customLinks = "https://some.fake.custom.link.com";
        $societyLinks = [
            'facebook' => "https://https://www.facebook.com/LOOKMUMNOCOMPUTER/"
        ];

        // make some images with size 1000x1000 pixels
        $uploadedMainImage = UploadedFile::fake()->image('main_image.jpg', 1000, 1000);
        $uploadedScreenshots = [
            UploadedFile::fake()->image('screenshot_1.jpg', 1000, 1000),
            UploadedFile::fake()->image('screenshot_2.jpg', 1000, 1000),
            UploadedFile::fake()->image('screenshot_3.jpg', 1000, 1000)
        ];


        return [
            'author_id'         => $relatedUser->id,      // set an author id
            'name'              => $modificationName,
            'description'       => $faker->text(254),
            'presentation'      => $faker->text(254),
            'main_image'        => $uploadedMainImage,    // only one image
            'screenshots'       => $uploadedScreenshots,  // from 3 to 10 images
            'trailer_video'     => $trailerVideoLink,     // a link to the trailer video on YouTube
            'review_video'      => $reviewVideoLink,
            'game'              => array_rand(Mod::GAME), // a version of the base game
            'views'             => random_int(100, 1000),
            'google_drive_disk' => $googleDriveLink,
            'yandex_disk'       => $yandexDiskLink,
            'cloud_mail_disk'   => $mailRuDisk,
            'tags'              => $tags,
            'custom_links'      => $customLinks,  // links to fixes and additions for the modification
            'society_links'     => $societyLinks, // social networks of the developers
            'created_at'        => now(),
            'updated_at'        => now(),
        ]; // return[]
    } // getRawCorrectData()


    // wrong raw modification data like we get it from the creation form
    public function getRawWrongData($returnEmptyData = false): array
    {
        if ($returnEmptyData)
        {
            $name = null;
            $description = null;
            $file = null;   // a main image or screenshots
            $video_link = null;
            $game = null;
            $download_link = null;
            $tags = null;   // if we pass empty tags line there won't be an error
        }
        else    // not empty incorrect data
        {
            $file = UploadedFile::fake()->create('document.pdf');  // instead of an image we pass a pdf-file

            $name = "name";             // the number of characters is fewer than necessary
            $description = "desc";      // the number of characters is fewer than necessary
            $video_link = "https://www.youtube.com/watch?v=&ab_channel=TV-8-301"; // a YouTube video link but without a video id
            $game = "stalker100";       // an incorrect game version
            $download_link = "incorrect_link";
            $tags = $file;              // instead of a string with tags we pass file object
        }

        // return incorrect data
        return [
            'name'              => $name,
            'slug'              => Str::slug("name"),
            'description'       => $description,
            'main_image'        => $file,
            'screenshots'       => $file,
            'video_link'        => $video_link,
            'author_id'         => User::inRandomOrder()->take(1)->first()->id,
            'game'              => $game,
            'views'             => random_int(100, 1000),
            'google_drive_disk' => $download_link,
            'yandex_disk'       => $download_link,
            'cloud_mail_disk'   => $download_link,
            'tags'              => $tags,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }
}

