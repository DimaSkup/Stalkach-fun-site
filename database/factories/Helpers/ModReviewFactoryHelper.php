<?php


namespace Database\Factories\Helpers;


use App\Helpers\Utils;
use App\Models\Mod;
use App\Models\ModRating;
use App\Models\ModReview;
use App\Models\User;

class ModReviewFactoryHelper
{
	// set key=>true to make a new fake model object for making a relation with it
	// OR key=>model_id to make a relation with this particular model object (by its id)
	// OR left key=>null to make no external relation
	private static array $modReviewConfigs = [
		'hasAuthorId' => null,    // an author's id
		'hasModId' => null,       // a related mod's id
		'hasModRatingId' => null, // a related mod rating id
	];

	private ModReview $modReview;

	public function __construct(ModReview $modReview)
	{
		$this->modReview = $modReview;
	}

	// ------------------------------------------------------------------------------- //
	//                             PUBLIC METHODS                                      //
	// ------------------------------------------------------------------------------- //

	// according to particular configurations
	// the function creates, sets up and returns a new ModReview instance
	public function getModel(): ModReview
	{
		$this->configureModReview();  // set up relations

		$this->resetConfigurationsToDefault();
		$this->modReview->save();  // update to store changes

		return $this->modReview;
	}

	// a helper for setting configuration parameters for mod review
	public static function setConfig(string $key, int|bool $value): void
	{
		self::$modReviewConfigs[$key] = $value;
	}

	// a helper for getting a configuration for mod review
	public static function getConfig(string $key): int|bool|null
	{
		return self::$modReviewConfigs[$key];
	}

	// ------------------------------------------------------------------------------- //
	//                               PRIVATE METHODS                                   //
	// ------------------------------------------------------------------------------- //

	// sets up the current ModReview instance
	private function configureModReview(): void
	{
		if ($authorId = self::getConfig('hasAuthorId'))
		{
			// if we have some author's id or want to create a new author
			$this->addOrCreateAuthor($authorId);
		}

		// in any case we need to have some related modification and related mod rating
		$this->addOrCreateMod(self::getConfig('hasModId'));
		$this->addOrCreateModRating(self::getConfig('hasModRatingId'));

	} // configureModReview()

	// if $authorId === true then we create a new author (User instance) and
	// make a relation with it
	private function addOrCreateAuthor(int|bool $authorId): void
	{
		if ($authorId === true)  // if we want to relate a new user as an author
		{
			$this->modReview->author = User::factory()->getModel();
		}
		else if ($authorId > 0)  // else we have some user's id
		{
			$this->modReview->author = User::find($authorId);
		}
	}

	// if we didn't pass some modification's id we create a new one
	// make a relation with it;
	private function addOrCreateMod($modId): void
	{
		if (is_int($modId) && $modId >= 1) // if we have some id
		{
			$this->modReview->mod = Mod::find($modId);
		}
		else // create a new modification
		{
			$this->modReview->mod = Mod::factory()->getModel();
		}
	}

	//  if we didn't pass some modRating's id we create a new one
	// make a relation with it;
	private function addOrCreateModRating($modRatingId): void
	{
		if (is_int($modRatingId) && $modRatingId >= 1) // if we have some id
		{
			$this->modReview->modRating = ModRating::find($modRatingId);
		}
		else // create a new mod rating
		{
			$this->modReview->modRating = ModRating::factory()->create();
		}
	}



	// ------------------------------------------------------------------------------- //
	//                               HELPER UTILS                                      //
	// ------------------------------------------------------------------------------- //

	// after each creation of a ModReview instance we must reset configurations
	private function resetConfigurationsToDefault(): void
	{
		self::$modReviewConfigs = [
			'hasAuthorId' => null,    // an author's id
			'hasModId' => null,       // a related mod's id
			'hasModRatingId' => null, // a related mod rating id
		];
	}
}