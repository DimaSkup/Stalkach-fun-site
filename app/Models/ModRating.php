<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// this model contains grades of a modification;
// together with ModReview represents a review of some particular modification;
class ModRating extends Model
{
    use HasFactory;

    public const GRADES_TYPES = [
        'story',
        'graphics',
        'difficulty',
        'optimization',
        'atmosphere',
        'main',
    ];

    // ----------------------------------------------------------------------- //
    //                            RELATIONS                                    //
    // ----------------------------------------------------------------------- //

    // returns the related modification review
    public function modReview()
    {
        return ModReview::where('mod_rating_id', $this->id)->first();
    }

    // ----------------------------------------------------------------------- //
    //                       ACCESSORS (GETTERS)                               //
    // ----------------------------------------------------------------------- //

    // returns an array with grades
    public function getGradesAttribute(): array
    {
        $grades = [];

        foreach (self::GRADES_TYPES as $gradeType)
        {
            $grades[$gradeType] = $this->attributes[$gradeType];
        }

        return $grades;
    }

    // returns an average rating for related modification
	public function getAverageRatingAttribute(): float
	{
		$sumRate = 0;
		$countOfGradesTypes = count(self::GRADES_TYPES);

		foreach ($this->grades as $grade)
		{
			$sumRate += $grade;
		}

		return $sumRate / $countOfGradesTypes;
	}
}
