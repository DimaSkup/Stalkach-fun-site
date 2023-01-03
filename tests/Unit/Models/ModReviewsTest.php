<?php

namespace Tests\Unit\Models;

use App\Helpers\Utils;
use App\Models\Mod;
use App\Models\ModRating;
use App\Models\ModReview;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// test that the ModReview model works properly
class ModReviewsTest extends TestCase
{
	use RefreshDatabase; // each time when this test is ran we refresh the database

	// can we create a new mod review?
	public function test_mod_review_can_be_created(): void
	{
		// act
		$modReview = ModReview::factory()->getModel();

		// assertions
		$this->assertModelExists($modReview);  // assert that a given model exists in the database
		$this->assertNull($modReview->author); // an author by default is null (for cases when the author of the review was deleted)
	}

	// can we set/get the text attribute of the mod review?
	public function test_mod_review_set_and_get_text(): void
	{
		// preparation
		$modReview = ModReview::factory()->getModel();
		$prevText = $modReview->text;
		$newText = "this is a new test text";

		// act
		$modReview->text = $newText;

		// assertions
		$this->assertIsString($modReview->text);
		$this->assertNotEmpty($modReview->text);
		$this->assertNotEquals($modReview->text, $prevText); // assert that we really changed the text attribute
	}

	// can we set/get the likes attribute of the mod review?
	public function test_mod_review_set_and_get_likes(): void
	{
		// preparation
		$modReview = ModReview::factory()->getModel();
		$prevLikesCount = $modReview->likes;
		$newLikesCount = $prevLikesCount - 10;

		// act
		$modReview->likes = $newLikesCount;

		// assertions
		$this->assertIsInt($modReview->likes);
		$this->assertNotEquals($modReview->likes, $prevLikesCount); // assert that we really changed the likes attribute
	}


 	// can we set/get an author of this mod review?
	public function test_mod_review_set_and_get_author(): void
	{
		// preparation
		$modReview = ModReview::factory()->hasAuthor()->getModel();
		$prevAuthor = $modReview->author; // get the author
		$newAuthor = User::factory()->create();

		// act
		$modReview->author = $newAuthor;

		// assertions
		$this->assertInstanceOf(User::class, $modReview->author); // assert that the author attribute is a User instance
		$this->assertNotEquals($prevAuthor, $modReview->author);  // assert that we really changed the author
	}


	// can we set/get a modification which is related to this mod review?
	public function test_mod_review_set_and_get_mod(): void
	{
		// preparation
		$modReview = ModReview::factory()->hasMod()->getModel();
		$prevMod = $modReview->mod;  // get the modification
		$newMod = Mod::factory()->getModel();

		// act
		$modReview->mod = $newMod;

		// assertions
		$this->assertInstanceOf(Mod::class, $modReview->mod); // assert that the mod attribute is a Mod instance
		$this->assertNotEquals($modReview->mod, $prevMod);    // assert that we really changed the related modification
	}

	// can we set/get a mod rating which is related to this mod review?
	public function test_mod_review_set_get_mod_rating(): void
	{
		// preparation
		$modReview = ModReview::factory()->hasModRating()->getModel();
		$prevModRating = $modReview->modRating; // get the mod rating
		$newModRating = ModRating::factory()->create();

		// act
		$modReview->modRating = $newModRating; // change the related mod rating

		// assertions
		$this->assertInstanceOf(ModRating::class, $modReview->modRating); // assert that the modRating attribute is a ModRating instance
		$this->assertNotEquals($modReview->modRating, $prevModRating);    // assert that we really changed the related mod rating
	}
}
