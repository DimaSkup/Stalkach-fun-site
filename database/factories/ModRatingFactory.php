<?php

namespace Database\Factories;

use App\Models\ModReview;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class ModRatingFactory extends Factory
{
    public const MIN_GRADE = 1;
    public const MAX_GRADE = 10;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'story'        => random_int(self::MIN_GRADE, self::MAX_GRADE),
            'graphics'     => random_int(self::MIN_GRADE, self::MAX_GRADE),
            'difficulty'   => random_int(self::MIN_GRADE, self::MAX_GRADE),
            'optimization' => random_int(self::MIN_GRADE, self::MAX_GRADE),
            'atmosphere'   => random_int(self::MIN_GRADE, self::MAX_GRADE),
            'main'         => random_int(self::MIN_GRADE, self::MAX_GRADE),
        ];
    }

    // ---------------------------------------------------------------------------- //
    //                             PUBLIC FUNCTIONS                                 //
    // ---------------------------------------------------------------------------- //

    // changes some data of this modification rating
    // 1. you can pass an array with min_grade and max_grade to make a random grades range
    // 2. or you can pass an array with grades types which have particular grade value
    public function modRating(Collection $data): Factory
    {
        return $this->state(function (array $attributes) use ($data) {
            $changedAttrAndVal = [];
            foreach ($data as $key => $value)
            {
                $changedAttrAndVal[$key] = $value; // set a grade value according to its type
            }

            return $changedAttrAndVal;
        });
    } // modRating()
}
