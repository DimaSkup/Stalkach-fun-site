<?php

namespace Database\Factories;

use App\Models\ModReview;
use Database\Factories\Helpers\ModReviewFactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/*
  EXAMPLES OF USING:

	// get a ModReview instance with random relations
	$modReview1 = ModReview::factory()             // use ModReview factory
				->hasAuthor()                      // with a random author
				->hasMod()                         // with a random modification
				->hasModRating()                   // with a random mod rating
				->getModel();                      // return a ModReview instance


	// get a ModReview instance with particular relations
	$modReview2 = ModReview::factory()             // use ModReview factory
				->hasAuthor($yourUserObj->id)      // with a particular author
				->hasMod($yourModObj->id)          // with a particular modification
				->hasModRating($yourModRating->id) // with a particular mod rating
				->getModel();                      // return a ModReview instance
*/
class ModReviewFactory extends Factory
{
	// ---------------------------------------------------------------------------- //
	//                                 DATA                                         //
	// ---------------------------------------------------------------------------- //
	public static array $modReviewsData = [
		[
			'text' => "This is a bull shit",
		],
		[
			'text' => "What an amazing modification",
		],
		[
			'text' => "This stuff crash every 5 minutes but the gameplay isn't so bad",
		],
		[
			'text' => "I love this modification!",
		],
		[
			'text' => "This modification needs more optimization",
		]
	]; // $modReviewsData


    // Define the model's default state.
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        # mod review data
        $data = $faker->randomElement(self::$modReviewsData);
        $text = $data['text'];
        $likes = random_int(10, 500);

        return [
            'text' => $text,
            'likes' => $likes,
			'author_id' => null,

			// we need to have a ModReview instance which is already stored into
			// the database for making external relations;
            //'mod_id'  => null,
			//'mod_rating_id' => null,
        ];
    }  // definition()




    // ---------------------------------------------------------------------------- //
    //                             FOR UNIT TESTS                                   //
    // ---------------------------------------------------------------------------- //

    // returns a new ModReview instance with set up relations
    public function getModel(): ModReview
    {
		$modReviewFactoryHelper = new ModReviewFactoryHelper($this->make());
		return $modReviewFactoryHelper->getModel();
    }

    // set a related author by its id or make relation with a new one
    public function hasAuthor(int|bool $authorId = true): ModReviewFactory
    {
		$this->setConfig('hasAuthorId', $authorId);
		return $this;
    }

    // set a related modification by its id or make relation with a new one
    public function hasMod(int|bool $modId = true): ModReviewFactory
    {
		$this->setConfig('hasModId', $modId);
		return $this;
    }

	// set a related mod rating by its id or make relation with a new one
    public function hasModRating(int|bool $modRatingId = true): ModReviewFactory
    {
		$this->setConfig('hasModRatingId', $modRatingId);
		return $this;
    }


    // ---------------------------------------------------------------------------- //
    //                                 HELPERS                                      //
    // ---------------------------------------------------------------------------- //
	private function setConfig(string $key, int|bool $value): void
	{
		ModReviewFactoryHelper::setConfig($key, $value);
	}
}
