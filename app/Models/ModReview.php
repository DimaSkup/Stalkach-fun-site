<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'likes',
        'author_id',
        'mod_id',
		'mod_rating_id'
    ];

    // ----------------------------------------------------------------------- //
    //                              RELATIONS                                  //
    // ----------------------------------------------------------------------- //

    // returns the user which is the author of this review
    public function author()
    {
        return $this->belongsTo(User::class)->first();
    }

    // returns the related modification (only one)
    public function mod()
    {
        return $this->belongsTo(Mod::class)->first();
    }

    // returns the related mod rating (only one)
    public function rating()
    {
        return ModRating::where('id', $this->mod_rating_id)->first();
    }


	// ----------------------------------------------------------------------- //
	//                        ACCESSORS (GETTERS)                              //
	// ----------------------------------------------------------------------- //

	// if author of this review is deleted we return null
	public function getAuthorAttribute(): Model|null
	{
		return $this->author() ?: null;
	}

	public function getModAttribute(): Model
	{
		return $this->mod();
	}

	public function getModRatingAttribute(): Model
	{
		return $this->rating();
	}

	// ----------------------------------------------------------------------- //
	//                        MUTATORS (SETTERS)                               //
	// ----------------------------------------------------------------------- //

	public function setAuthorAttribute(User $author): void
	{
		$this->attributes['author_id'] = $author->id;
	}

	public function setModAttribute(Mod $mod): void
	{
		$this->attributes['mod_id'] = $mod->id;
	}

	public function setModRatingAttribute(ModRating $modRating): void
	{
		$this->attributes['mod_rating_id'] = $modRating->id;
	}
}
