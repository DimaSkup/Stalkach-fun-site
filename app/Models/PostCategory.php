<?php

namespace App\Models;

use App\Helpers\Traits\FileUtils;
use App\Helpers\Utils;
use App\Models\Traits\HasImages;
use App\Service\ImageEditor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    use HasFactory;

    # images
    public const IMAGE_TYPE_BACKGROUND = 'post_category_image_background';

    protected $fillable = [
        'name',
        'dev_name',
        'slug',
        'description',

        'pinned_title',
        'pinned_subtitle',
        'pinned_description',

        'is_private',
        'is_enabled',
    ];
    // ----------------------------------------------------------------------- //
    //                       PUBLIC FUNCTIONS                                  //
    // ----------------------------------------------------------------------- //

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }


    // makes relations with posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // makes relation with a file model
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(FileModel::class, 'model');
    }

    // ----------------------------------------------------------------------- //
    //                       ACCESSORS (GETTERS)                               //
    // ----------------------------------------------------------------------- //

    // returns a default path to the model images directory
    public static function getPathToImagesDir(): string
    {
        return Utils::getPathToDirByFileType(self::IMAGE_TYPE_BACKGROUND);
    }

    // return a background image for this category
    public function getBackgroundImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_BACKGROUND);
    }

    // returns a Collection of all the PostCategory objects
    public static function getList(): Collection
    {
        return self::all();
    }

    // returns a Collection of all the PostCategory names
    public static function getCategoriesNames(): Collection
    {
        return self::getList()->map(function ($item) {
            return $item->name;
        });
    }



    // ----------------------------------------------------------------------- //
    //                       MUTATORS (SETTERS)                                //
    // ----------------------------------------------------------------------- //

    //  generate and return a route to show category page
    public function getUrlAttribute(): string
    {
        return route('post.category', ['post_category' => $this->slug]);
    }

    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;
        if (!isset($this->attributes['slug']) || !$this->slug)
        {
            $this->attributes['slug'] = Str::slug($name);
        }
    }

    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = Str::slug($slug);
    }

    // sets a background image for this category
    public function setBackgroundImageAttribute(\SplFileInfo|string $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_BACKGROUND);
    }





    // ----------------------------------------------------------------------- //
    //                         PRIVATE FUNCTIONS                               //
    // ----------------------------------------------------------------------- //
}
