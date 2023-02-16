<?php

namespace App\Models;

//use Database\Factories\UserFactory;
use App\Helpers\Utils;
use App\Models\Traits\HasImages;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\File as HttpFile;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use HasImages;

    public const IMAGE_TYPE_USER_ALL = 'user_images';           // represents all the user's images
    public const IMAGE_TYPE_USER_AVATAR = 'user_image_avatar';  // user's avatars

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_id',
        'handle_social',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	// ----------------------------------------------------------------------- //
	//                            RELATIONS                                    //
	// ----------------------------------------------------------------------- //

    // return all the posts which are written by this user
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

	// returns the related files
	public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
	{
		return $this->morphMany(FileModel::class, 'model');
	}


	// ----------------------------------------------------------------------- //
	//                       ACCESSORS (GETTERS)                               //
	// ----------------------------------------------------------------------- //

	public function getIsAdminAttribute(): bool
	{
		return $this->attributes['is_admin'];
	}

	public function getIsSuperAdminAttribute(): bool
	{
		return false;
	}

	// ---------------------------  GET IMAGES  ------------------------------ //

	// returns a default path to the model images directory
	public static function getPathToImagesDir(): string
	{
		return Utils::getPathToDirByFileType(self::IMAGE_TYPE_USER_ALL);
	}

	public static function getAvatarImageTypeName(): string
	{
		return self::IMAGE_TYPE_USER_AVATAR;
	}

	// returns a path to the user's avatar image
	public function getAvatarAttribute(): string
	{
		return $this->getImageUrlByType(self::getAvatarImageTypeName());
	}




	// ----------------------------------------------------------------------- //
	//                       MUTATORS (SETTERS)                                //
	// ----------------------------------------------------------------------- //


	// -------------------------- SET IMAGES -------------------------------- //

	// sets a main image for this modification
	public function setAvatarAttribute(HttpFile $image): void
	{
		$this->setImageHelper($image, self::getAvatarImageTypeName());
	}
}
