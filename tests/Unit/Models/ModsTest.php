<?php

namespace Tests\Unit\Models;


use App\Helpers\LocalFileManager;
use App\Models\ModReview;
use App\Models\Post;
use App\Models\Repository\ModRepository;
use App\Models\User;
use App\Models\Mod;
use App\Models\Tag;
use Illuminate\Http\File;

use App\Service\YouTubeVideoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection as DatabaseCollection;
use Illuminate\Support\Facades\File as FacadesFile;
use Tests\TestCase;


// check the behaviour of the Mod model:
// can we set/get all the attributes? etc.
class ModsTest extends TestCase
{
	use RefreshDatabase; // each time when this test is ran we refresh the database

	private static string $testTrailerVideoLink = "https://www.youtube.com/watch?v=VmoQTgX78do";
	private static string $testReviewVideoLink = "https://www.youtube.com/watch?v=OuHdnsF118U";
	private static File $defaultTestImageFile;


	// ----------------------------------------------------------------------- //
	//                             COMMON TESTS                                //
	// ----------------------------------------------------------------------- //

	public function test_make_some_preparations_for_tests(): void
	{
		// for more productivity we will mainly use this image file
		self::$defaultTestImageFile = Mod::factory()->getRandImageFile();

		$this->assertInstanceOf(File::class, self::$defaultTestImageFile);
	}

	// can we create a new BASIC (with no relations) modification?
	public function test_mod_can_be_created(): void
	{
		// act
		$mod = Mod::factory()->getModel();

		// assertions
		$this->assertModelExists($mod);                                        // assert that a given model exists in the database
	}



	// ----------------------------------------------------------------------- //
	//                   TEST ATTRIBUTES (GET/SET OPERATIONS)                  //
	// ----------------------------------------------------------------------- //

 	// can we set/get an AUTHOR of the mod mod properly?
	public function test_mod_set_and_get_author(): void
	{
		// preparation
		$mod = Mod::factory()->hasAuthor()->getModel();                        // create a new mod and record it into the database
		$prevAuthorId = $mod->author->id;

		// act: set the author of the mod
		$mod->author = User::factory()->create();
		$mod->update();                                                        // record our changes into the database

		// assertions: get the current author and compare it with the previous one
		$this->assertInstanceOf(User::class, $mod->author);
		$this->assertNotEquals($prevAuthorId, $mod->author->id);               // check that the current author is not the previous one
	}


	// can we set/get a GUIDE for the mod properly?
	public function test_mod_set_and_get_guide(): void
	{
		// preparation
		$mod = Mod::factory()->hasGuide()->getModel();                         // create a new mod and record it into the database
		$newGuide = Post::factory()->hasType(Post::TYPE_GUIDE)->getModel();    // get a new post with the guide type
		$prevGuideId = $mod->guide()->first()->id;

		// act: change the guide to a new one
		$mod->guide = $newGuide;
		$mod->update();                                                        // record our changes into the database

		// assertions: get the current guide and compare it with the previous one
		$this->assertInstanceOf(Post::class, $mod->guide);
		$this->assertNotEquals($prevGuideId, $mod->guide->id);
	}


	// can we add/get MOD REVIEWS?
	public function test_mod_set_and_get_mod_review(): void
	{
		// preparation
		$numModReviews = 2;
		$mod = Mod::factory()->hasModReviews($numModReviews)->getModel();
		$newModReview = ModReview::factory()->getModel();

		// act: add new mod review
		$mod->modReviews = $newModReview;

		// assertions: try to access to the related mod reviews
		$this->assertInstanceOf(DatabaseCollection::class, $mod->modReviews);  // assert that we get collection of mod review
		$this->assertInstanceOf(ModReview::class, $mod->modReviews->first());  // can we access to one of the related mod reviews?
		$this->assertTrue(count($mod->modReviews) > $numModReviews);           // assert that we really added a new modification so now we have more number of it
	}


	// can we set/get mod's TRAILER VIDEO?
	public function test_mod_set_and_get_trailer_video(): void
	{
		// preparation
		$mod = Mod::factory()->getModel();
		$modRepository = ModRepository::getStandardModRepositoryInstance();    // get a standard instance of ModRepository
		$trailerVideoData = $modRepository->getVideoPreviewImageAndId(self::$testTrailerVideoLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE);

		// act: set trailer video data
		$mod->trailerVideoId = $trailerVideoData->get('id');
		$mod->trailerVideoPreviewImage = $trailerVideoData->get('image');

		// assertions: can we access to the trailer id, url, and preview image?
		$this->assertIsString($mod->trailerVideoId);
		$this->assertNotEmpty($mod->trailerVideoId);

		$this->assertIsString($mod->trailerVideoUrl);
		$this->assertNotEmpty($mod->trailerVideoUrl);

		$this->assertIsString($mod->trailerVideoPreviewImage);
		$this->assertNotEmpty($mod->trailerVideoPreviewImage);
	} // test_mod_set_trailer_video()

	// can we set/get mod's REVIEW VIDEO?
	public function test_mod_set_and_get_review_video(): void
	{
		// preparation
		$mod = Mod::factory()->getModel();
		$modRepository = ModRepository::getStandardModRepositoryInstance();     // get a standard instance of ModRepository
		$reviewVideoData = $modRepository->getVideoPreviewImageAndId(self::$testTrailerVideoLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE);

		// act: set review video data
		$mod->reviewVideoId = $reviewVideoData->get('id');
		$mod->reviewVideoPreviewImage = $reviewVideoData->get('image');

		// assertions: can we get the review id, url, and preview image?
		$this->assertIsString($mod->reviewVideoId);
		$this->assertNotEmpty($mod->reviewVideoId);

		$this->assertIsString($mod->reviewVideoUrl);
		$this->assertNotEmpty($mod->reviewVideoUrl);

		$this->assertIsString($mod->reviewVideoPreviewImage);
		$this->assertNotEmpty($mod->reviewVideoPreviewImage);
	} // test_mod_set_and_get_review_video()

	// can we set/get mod's TAGS?
	public function test_mod_set_and_get_tags(): void
	{
		// preparation
		$mod = Mod::factory()->hasTags()->getModel();                          // create a new mod and record it into the database
		$faker = \Faker\Factory::create();
		$tagName1 = $faker->word;
		$tagName2 = $faker->word;

		// act: set tags
		$mod->tags = "$tagName1 $tagName2"; // add some new tags

		// assertions: get tags
		$this->assertInstanceOf(DatabaseCollection::class, $mod->tags);         // assert that we get collection of tags
		$this->assertInstanceOf(Tag::class, $mod->tags->first());               // can we access to one of the related tags?
		$this->assertTrue($mod->tags->contains('name', $tagName1));
		$this->assertTrue($mod->tags->contains('name', $tagName2));
	} // test_mod_set_and_get_tags()


	// can we set/get a MAIN IMAGE of the mod?
	public function test_mod_set_and_get_main_image(): void
	{
		// preparation
		$mod = Mod::factory()->hasMainImage()->getModel();                     // create a modification with some random main image
		$prevMainImageUrl = $mod->mainImage;                                   // get the main image url
		$prevMainImageFile = $mod->getImageFileObjectsByType(Mod::IMAGE_TYPE_MAIN)->last(); // use last() because we can have only one main image and want to work only with the last set image

		// act: change the main image
		$mod->mainImage = self::$defaultTestImageFile;

		// assertions
		$this->assertInstanceOf(File::class, $prevMainImageFile);              // assert that we can get a main image file object
		$this->assertIsString($mod->mainImage);                                // assert that we can get a url to the main image
		$this->assertNotEmpty($mod->mainImage);                                // assert that this url is not an empty string
		$this->assertNotEquals($mod->mainImage, $prevMainImageUrl);            // assert that we really changed the main image attribute (compare images urls)
	}


	// can we set/get SCREENSHOTS of the mod?
	public function test_mod_set_and_get_screenshots(): void
	{
		// preparation
		$screenshotsCount = 3;                                                 // minimal number of screenshots for a modification
		$mod = Mod::factory()->hasScreenshots($screenshotsCount)->getModel();  // create a modification with some 3 random screenshots
		$screenshotsUrls = $mod->screenshots;                                  // get a Collection of screenshots urls
		$screenshotFile = $mod->getImageFileObjectsByType(Mod::IMAGE_TYPE_SCREENSHOTS)->random(); // get a screenshot file object
		$countBeforeAdding = $screenshotsUrls->count();                        // the screenshots count before adding a new one

		// act: add a new screenshot
		$mod->screenshots = [self::$defaultTestImageFile];
		$countAfterAdding = $mod->screenshots->count();                        // the screenshots count after adding a new one

		// assertions
		$this->assertInstanceOf(File::class, $screenshotFile);                 // assert that we can get a screenshot file object
		$this->assertIsString($mod->screenshots->random());                    // assert that we can get urls to the screenshots
		$this->assertNotEmpty($mod->screenshots->random());                    // assert that this url is not an empty string
		$this->assertNotEquals($countBeforeAdding, $countAfterAdding);
	}


	// can we set/get a BOXART image of the mod?
	public function test_mod_set_and_get_boxart_image(): void
	{
		// preparation
		$mod = Mod::factory()->hasBoxartImage()->getModel();                   // create a modification with some random boxart image
		$prevBoxartImageUrl = $mod->boxartImage;                               // get the boxart image url
		$prevBoxartImageFile = $mod->getImageFileObjectsByType(Mod::IMAGE_TYPE_BOXART)->last(); // use last() because we can have only one boxart image and want to work only with the last set image

		// act: change the boxart image
		$mod->boxartImage = self::$defaultTestImageFile;

		// assertions
		$this->assertInstanceOf(File::class, $prevBoxartImageFile);            // assert that we can get a file object of the boxart image
		$this->assertIsString($mod->boxartImage);                              // assert that we can get a url to the boxart image
		$this->assertNotEmpty($mod->boxartImage);                              // assert that this url is not an empty string
		$this->assertNotEquals($mod->boxartImage, $prevBoxartImageUrl);        // assert that we really changed the boxart image attribute (compare images urls)
	}


	// can we set/get a BACKGROUND image of the mod?
	public function test_mod_set_and_get_background_image(): void
	{
		// preparation
		$mod = Mod::factory()->hasBackgroundImage()->getModel();               // create a modification with some random background image
		$prevBackgroundImageUrl = $mod->boxartImage;                           // get the background image url
		$prevBackgroundImageFile = $mod->getImageFileObjectsByType(Mod::IMAGE_TYPE_BACKGROUND)->last(); // use last() because we can have only one background image and want to work only with the last set image

		// act: change the background image
		$mod->backgroundImage = self::$defaultTestImageFile;

		// assertions
		$this->assertInstanceOf(File::class, $prevBackgroundImageFile);        // assert that we can get a file object of the background image
		$this->assertIsString($mod->backgroundImage);                          // assert that we can get a url to the background image
		$this->assertNotEmpty($mod->backgroundImage);                          // assert that this url is not an empty string
		$this->assertNotEquals($mod->backgroundImage, $prevBackgroundImageUrl); // assert that we really changed the background image attribute (compare images urls)
	}

	// can we call attributes getters of a mod properly?
	public function test_mod_get_table_attributes(): void
	{
		// create a new mod and record it into the database
		$mod = Mod::factory()->getModel();

		// table columns
		$this->assertIsString($mod->name);
		$this->assertIsString($mod->slug);
		$this->assertIsString($mod->description);
		$this->assertIsString($mod->presentation);

		$this->assertContains($mod->game, Mod::GAME);
		$this->assertIsInt($mod->views);
		$this->assertIsArray($mod->downloadLinks);

		$this->assertIsArray($mod->customLinks);
		$this->assertIsArray($mod->societyLinks);

		$this->assertInstanceOf(\Illuminate\Support\Carbon::class, $mod->created_at);
		$this->assertInstanceOf(\Illuminate\Support\Carbon::class, $mod->updated_at);
	} // test_mod_get_table_attributes()


	// can we get data values using our custom model attributes?
	// (there are no such columns in the database)
	public function test_mod_get_custom_attributes(): void
	{
		// create a new mod and record it into the database
		$mod = Mod::factory()->hasTags()->getModel();

		// custom accessors
		$this->assertIsString($mod->url);
		$this->assertNotEmpty($mod->url);
		$this->assertIsString($mod->tagsNamesString);
		$this->assertNotEmpty($mod->tagsNamesString);
	}


	// --------------------------------- UTILS --------------------------------------- //

	// THIS IS NOT A TEST BY ITSELF BUT EXECUTES AS TEST because we need
	// to clean up the mods images directory from test images;
	public function test_clean_mods_images_dir(): void
	{
		// get full path to directory to clean it later
		$fileManager = new LocalFileManager('public');
		$pathToDir = Mod::getPathToImagesDir();
		$fullPathToTempDir = $fileManager->getFullPathByStoragePath($pathToDir);

		// clean the temporary directory from temporal files
		$cleanResult = FacadesFile::cleanDirectory($fullPathToTempDir);

		$this->assertTrue($cleanResult); // confirm that the temp directory is empty now
	}

}
