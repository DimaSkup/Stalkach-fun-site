<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Models\Traits\HasImages;
use App\Models\Traits\HasVideos;
use App\Service\ImageEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;
    use HasVideos;

    public const DEFAULT_IMAGE_TYPE = 'post_image_main';

    public const IMAGE_TYPE_MAIN = 'post_image_main';
    public const IMAGE_TYPE_MAIN_SQUARE = 'post_image_square';
    public const IMAGE_TYPE_MAIN_ALBUM = 'post_image_album';
    public const IMAGE_TYPE_MASTHEAD = 'post_image_masthead';
    public const IMAGE_TYPE_GALLERY = 'post_image_gallery';

    // there is a list of posts types
    public const TYPE_CASUAL    = 'casual';
    public const TYPE_GALLERY   = 'gallery';   // image gallery
    public const TYPE_VIDEO     = 'video';
    public const TYPE_GUIDE     = 'guide';      // live broadcasts

    // an array which contains posts types and it's translations
    public const TYPES = [
        self::TYPE_CASUAL       => 'model.post.type.casual',
        self::TYPE_GALLERY      => 'model.post.type.gallery',
        self::TYPE_VIDEO        => 'model.post.type.video',
        self::TYPE_GUIDE        => 'model.post.type.guide',
        //self::TYPE_LIVE         => self::TYPE_LIVE,
    ];


    public const VIEWS = [
        self::TYPE_CASUAL       => 'posts.show.casual',
        self::TYPE_GALLERY      => 'posts.show.gallery',
        self::TYPE_VIDEO        => 'posts.show.video',
        self::TYPE_GUIDE        => 'posts.show.guide',
    ];

    protected $fillable = [
        # common
        'title',
        'description',
        'text',

        # content scope
        'type',

        # author
        'user_id',
        'source_title',
        'source_url',

        # other relations
        //'category_id',
        //'video_id',

        # tracking
        'views',

        # parameters
        'is_pinned',
        'is_feature',
        'is_ad',
        'is_approved',
        'duration',
        //'settings',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // ----------------------------------------------------------------------- //
    //                            RELATIONS                                    //
    // ----------------------------------------------------------------------- //

    // returns all the related tags
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // returns all the related files
    public function files(): MorphMany
    {
        return $this->morphMany(FileModel::class, 'model');
    }

    // returns the user which has written this post
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // returns the related category
    public function category(): belongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    // get all the related posts to this one by its tags
    public function getRelatedPosts(int $countOfRelatedPosts = 3): Collection
    {
        return $this->getRelatedPostsHelper($countOfRelatedPosts);
    }


    // ---------------------------------------------------------------------------------- //
    //                             MUTATORS (SETTERS)                                     //
    // ---------------------------------------------------------------------------------- //

    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = $title;
        if (!isset($this->attributes['slug']) || !$this->slug)
        {
            $this->attributes['slug'] = Str::slug($title);
        }
    }

    public function setSlugAttribute(string $slug): void
    {
        $this->attributes['slug'] = Str::slug($slug);
    }

    public function setVideoUrlAttribute(string $linkToVideo): void
    {
        $this->setYouTubeVideoIdHelper($linkToVideo, 'video_id', self::IMAGE_TYPE_MAIN, "mainImage");
    }

    // relates tags to this model object and creates relations between these tags
    public function setTagsAttribute(string $tagsString): void
    {
        Tag::relateModelToTags($this, $tagsString);
    }

    // ----------------------------- SET IMAGES ---------------------------------- //

    // sets a main image for this post
    public function setMainImageAttribute(\SplFileInfo|string $image): void
    {
        $this->setMainImageHelper($image);
    }  // setMainImageAttribute()

    // sets a masthead image for this post
    public function setMastheadImageAttribute(\SplFileInfo|string $image):void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_MASTHEAD);
    } // setMastheadImageAttribute()

    // adds a single gallery image for this post
    public function setGalleryImageAttribute(\SplFileInfo|string $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_GALLERY);
    }

    // ---------------------------------------------------------------------------------- //
    //                             ACCESSORS (GETTERS)                                    //
    // ---------------------------------------------------------------------------------- //

    // returns a path to the model images directory
    public static function getPathToImagesDir($type = null): string
    {
        $imageType = $type ?: self::DEFAULT_IMAGE_TYPE;
        return Utils::getPathToDirByFileType($imageType);
    }

    // returns a Collection of all the post's types together with its translation keys or without
    public static function getTypes($withTransKeys = false): Collection
    {
        $types = ($withTransKeys) ? self::TYPES : array_keys(self::TYPES);
        return new Collection($types);
    }

    //  generate and return a route to show a page with some single modification
    public function getUrlAttribute(): string
    {
        return route('posts.show', ['post' => $this->slug]);
    }

    public function getTagsNamesStringAttribute(): string
    {
        return implode(" ", array_column($this->tags()->get()->all(), 'name'));
    }

    // returns an id of the YouTube video
    public function getVideoIdAttribute(): string
    {
        return $this->attributes['video_id'];
    }

    // returns a full url to the YouTube video
    public function getVideoUrlAttribute(): string
    {
        return sprintf(config('content.youtube.url'), $this->videoId);
    }

    // returns path to the blade template for particular posts
    public function getViewAttribute()
    {
        return view(self::VIEWS[$this->type]);
    }

    public function getCreatedTimeAttribute(): string
    {
        return $this->created_at->isoFormat('ddd D');
    }

    public function getCreatedFullTimeAttribute(): string
    {
        return $this->created_at->format('d F Y');
    }

    // returns the data about author of this post
    public function getAuthorAttribute(): Collection 
    {
        return $this->getAuthorAttributeHelper();
    }


    // returns a value of the post's popularity
    public function getPopularRateAttribute(): int
    {
        return $this->view;
    }

    // --------------------------- GET IMAGES -------------------------------- //
    public function getMainImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_MAIN);
    }

    public function getMainImageSquareAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_MAIN_SQUARE);
    }

    public function getMainImageAlbumAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_MAIN_ALBUM);
    }

    public function getMastheadImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_MASTHEAD);
    }

    public function getGalleryImagesAttribute(): Collection
    {
        return $this->getImagesUrlsCollectionByType(self::IMAGE_TYPE_GALLERY);
    }


    // ----------------------------------------------------------------------- //
    //                         PRIVATE FUNCTIONS                               //
    // ----------------------------------------------------------------------- //


    // helps us to get all the related posts to this one in the number of $countOfRelatedPosts
    private function getRelatedPostsHelper($countOfRelatedPosts = 5): Collection
    {
        // get an array of related tags
        $relatedTags = ($this->tags);
        $relatedPostsCollection = collect();

        // merge together all the related posts
        foreach ($relatedTags as $relatedTag)
        {
            $relatedPostsCollection = $relatedPostsCollection->merge($relatedTag->posts);
            $relatedPostsCollection = $relatedPostsCollection->unique('id');            // get only unique posts

            if ($relatedPostsCollection->count() > $countOfRelatedPosts)
            {
                $relatedPostsWithoutCurrentOne = $relatedPostsCollection->reject(function ($value, $key) {
                    return $value['id'] === $this->id;   // acquiring of related posts except current one
                });

                // we need only particular count of the posts
                return $relatedPostsWithoutCurrentOne->slice(0, $countOfRelatedPosts);
            }
        }

        return $relatedPostsCollection;
    }

    // helps to set a main image for this post
    private function setMainImageHelper(\SplFileInfo|string $inputImage): void
    {
        // set main image and get its file object
        $this->setImageHelper($inputImage, self::IMAGE_TYPE_MAIN);
        $mainImageFile = $this->getImageFileObjectsByType(self::IMAGE_TYPE_MAIN);

        // make copies of the main image in a particular form-factor
        $this->setImageHelper($mainImageFile, self::IMAGE_TYPE_MAIN_SQUARE);
        $this->setImageHelper($mainImageFile, self::IMAGE_TYPE_MAIN_ALBUM);
    }

    // helps us to get data about author of this post
    private function getAuthorAttributeHelper(): Collection
    {
        if($this->source_title && $this->source_url) {
            return new Collection([
                'url' => $this->source_url,
                'title' => $this->source_title,
            ]);
        }

        // TODO: Після створення сторінки юзера, направляти на його сторінку
        return new Collection([
            'url' => '#',
            'title' => $this->user->name,
        ]);
    }
}
