<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Models\Traits\HasImages;
use App\Models\Traits\HasVideos;
use \Illuminate\Http\File as HttpFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mod extends Model
{
    use HasFactory;
    use HasImages;
    use HasVideos;

    public const IMAGE_TYPE_MAIN = 'mod_image_main';
    public const IMAGE_TYPE_SCREENSHOTS = 'mod_image_screenshot';
    public const IMAGE_TYPE_TRAILER = 'mod_image_trailer';
    public const IMAGE_TYPE_REVIEW = 'mod_image_review';
    public const IMAGE_TYPE_BOXART = 'mod_image_boxart';
    public const IMAGE_TYPE_BACKGROUND = 'mod_image_background';
    public const IMAGE_TYPE_GALLERY_VIDEO = 'mod_image_gallery_video_preview';

    public const VIDEO_TYPE_GALLERY = 'mod_video_gallery';

    public const DOWNLOAD_SOURCE_GOOGLE = 'google_drive_disk';
    public const DOWNLOAD_SOURCE_YANDEX = 'yandex_disk';
    public const DOWNLOAD_SOURCE_MAIL = 'cloud_mail_disk';

    public const DOWNLOAD_SOURCES_TRANS = [
        self::DOWNLOAD_SOURCE_GOOGLE => 'model.mod.download_sources.google',
        self::DOWNLOAD_SOURCE_YANDEX => 'model.mod.download_sources.yandex',
        self::DOWNLOAD_SOURCE_MAIL => 'model.mod.download_sources.mail',
    ];

    public const DOWNLOAD_SOURCES = [
        'google' => 'google_drive_disk',
        'yandex' => 'yandex_disk',
        'mail' => 'cloud_mail_disk',
    ];

    public const SOCIAL_LINK_TYPES = [
        'google' => 'google',
        'facebook' => 'facebook',
        'telegram' => 'telegram',
    ];

    public const GAME = [
        "soc" => "soc",
        "cs" => "cs",
        "cop" => "cop",
        "hoc" => "hoc",
    ];

    public const GAME_NAMES = [
    	"soc" => "S.T.A.L.K.E.R: Shadow of Chernobyl",
    	"cs" => "S.T.A.L.K.E.R: Clear Sky",
		"cop" => "S.T.A.L.K.E.R: Call of Pripyat",
		"hoc" => "S.T.A.L.K.E.R: Heart of Chornobyl",
	];

    public const GAME_ICO_DIR_PATH = "images/icons/games/";

    public const MOD_FEATURES_LIST = [
    	'story' => [
    		'text'      => "With new story",
			'icon_name' => "auto_stories",
		],
		'graphic' => [
			'text'      => "Graphic improvements",
			'icon_name' => "add_photo_alternate",
		],
		'bestsellers' => [
			'text'      => "Bestsellers",
			'icon_name' => "star_border",
		],
		'voice' => [
			'text'      => "With voice acting",
			'icon_name' => "mic",
		],
		'guns' => [
			'text'      => "With new guns",
			'icon_name' => "backpack",
		],
		'old_comp' => [
			'text'      => "For old computers",
			'icon_name' => "speed",
		],
	];

    public const MOD_DIFFICULTIES_LIST = [
    	'all' => [
    		'text'       => "All difficulties",
    		'icon_name'  => "emergency",
			'icon_color' => "white",
		],
		'hard' => [
			'text'       => "Hard difficult",
			'icon_name'  => "trip_origin",
			'icon_color' => "red",
		],
		'medium' => [
			'text'       => "Medium difficult",
			'icon_name'  => "trip_origin",
			'icon_color' => "yellow",
		],
		'easy' => [
			'text'       => "Easy difficult",
			'icon_name'  => "trip_origin",
			'icon_color' => "blue",
		],
		'novice' => [
			'text'       => "For novices",
			'icon_name'  => "trip_origin",
			'icon_color' => "green",
		],
	];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        //'screenshots' => 'array',
        //'download_links' => 'array'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'presentation',
        'game',
        'views',
        'download_links',
		'average_grade',

        'trailer_video_id',
        'review_video_id',
        'author_id',
        'guide_id',

        'custom_links',
        'society_links',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    // ----------------------------------------------------------------------- //
    //                            RELATIONS                                    //
    // ----------------------------------------------------------------------- //

    // return an User object of the modification author
    public function author()
    {
        return $this->belongsTo(User::class)->first();
    }

    public function guide()
    {
        return $this->belongsTo(Post::class)->first();
    }

    // returns all the related tags
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // returns all the related files
    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(FileModel::class, 'model');
    }

    // ----------------------------------------------------------------------- //
    //                       ACCESSORS (GETTERS)                               //
    // ----------------------------------------------------------------------- //

    //  generate and return a route to show modification page
    public function getUrlAttribute(): string
    {
        return route('mods.show', ['mod' => $this->slug]);
    }

    // get an array of download link sources
    public function getDownloadLinksAttribute(): array
    {
        return json_decode($this->attributes['download_links'], true, 512, JSON_THROW_ON_ERROR);
    }

    // get an array of custom link sources
    public function getCustomLinksAttribute(): array
    {
        return json_decode($this->attributes['custom_links'], true, 512, JSON_THROW_ON_ERROR);
    }

    // get an array of society link sources
    public function getSocietyLinksAttribute(): array
    {
        return json_decode($this->attributes['society_links'], true, 512, JSON_THROW_ON_ERROR);
    }

    // get a string which contains all the tags names related to this modification
    public function getTagsNamesStringAttribute(): string
    {
        return implode(' ', array_column($this->tags()->get()->all(), 'name'));
    }

    // returns a full name of the basic game version
    public function getBasicGameNameAttribute(): string
	{
		return self::GAME_NAMES[$this->game];
	}

	public function getAverageGradeAttribute(): string
	{
		return $this->attributes['average_grade'];
	}

	public function getSubscribersCountAttribute(): string
	{
		return -1;
	}




    // ---------------------- GET EXTERNAL RELATIONS  --------------------------- //

    // receive the related author
    public function getAuthorAttribute()
    {
        return $this->author();
    }

    // receive all the related mod reviews
    public function getModReviewsAttribute()
    {
        return ModReview::where('mod_id', $this->id)->get();
    }

    // receive the related mod guide
    public function getGuideAttribute()
    {
        return $this->guide();
    }

    // -------------------------- GET VIDEO DATA -------------------------------- //

    // returns an id of the trailer video on YouTube
    public function getTrailerVideoIdAttribute(): string
    {
        return $this->attributes['trailer_video_id'];
    }

    // returns an id of the review video on YouTube
    public function getReviewVideoIdAttribute(): string
    {
        return $this->attributes['review_video_id'] ?? "no_review_video_link";
    }

    // returns a full url to the trailer video on YouTube
    public function getTrailerVideoUrlAttribute(): string
    {
        return sprintf(config('content.youtube.url'), $this->trailerVideoId);
    }

    // returns a full url to the trailer video on YouTube
    public function getReviewVideoUrlAttribute(): string
    {
        return sprintf(config('content.youtube.url'), $this->reviewVideoId);
    }

    // returns url for the gallery video
    public function getGalleryVideoUrlAttribute(): string
    {
        return $this->getVideoUrlByType(self::VIDEO_TYPE_GALLERY);
    }


    // -------------------------- GET IMAGES -------------------------------- //

    public function getMainImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_MAIN);
    }

    public function getScreenshotsAttribute(): Collection
    {
        return $this->getImagesUrlsCollectionByType(self::IMAGE_TYPE_SCREENSHOTS);
    }

    // return a preview image for the trailer YouTube video
    public function getTrailerVideoPreviewImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_TRAILER);
    }

    // return a preview image for the review YouTube video
    public function getReviewVideoPreviewImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_REVIEW);
    }

    public function getBoxartImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_BOXART);
    }

    public function getBackgroundImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_BACKGROUND);
    }

    public function getGalleryVideoImageAttribute(): string
    {
        return $this->getImageUrlByType(self::IMAGE_TYPE_GALLERY_VIDEO);
    }

    // returns a path to the model images directory
    public static function getPathToImagesDir(): string
    {
        return Utils::getPathToDirByFileType(self::IMAGE_TYPE_MAIN);
    }

	// returns a path to the ico of the basic game version (cop ico, cs ico, etc)
    public static function getPathToIcoImageByKey(string $key): string
	{
		return asset(self::GAME_ICO_DIR_PATH . $key . ".ico");
	}

    // returns a path to the ico of the basic game version (cop ico, cs ico, etc)
    public function getBasicGameIcoPathAttribute(): string
	{
		return self::getPathToIcoImageByKey($this->game);

	}




    // ----------------------------------------------------------------------- //
    //                       MUTATORS (SETTERS)                                //
    // ----------------------------------------------------------------------- //

    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = $name;
        if (!isset($this->attributes['slug']) || !$this->slug) // if we haven't had a slug yet
        {
            $this->attributes['slug'] = Str::slug($name);
        }
    }

    public function setSlugAttribute(string $slug): void
    {
        $this->attributes['slug'] = Str::slug($slug);
    }

    public function setAuthorAttribute(User $author): void
    {
        $this->attributes['author_id'] = $author->id;
    }

    public function setGuideAttribute(Post $guide): void
    {
        $this->attributes['guide_id'] = $guide->id;
    }

    // relate a mod review to this modification
    public function setModReviewsAttribute(ModReview $modReview): void
	{
		$modReview->mod = $this;
		$modReview->update();
	}

    // set the download links
    public function setDownloadLinksAttribute(array $links): void
    {
        $this->attributes['download_links'] = json_encode($links, JSON_THROW_ON_ERROR);
    }

    // set the custom links (links to pages about modification fixes, updates, etc.)
    public function setCustomLinksAttribute(array $links): void
    {
        $this->attributes['custom_links'] = json_encode($links, JSON_THROW_ON_ERROR);
    }

    // set the society links (links to developers in social networks)
    public function setSocietyLinksAttribute(array $links): void
    {
        $this->attributes['society_links'] = json_encode($links, JSON_THROW_ON_ERROR);
    }

    // relates tags to this model object and creates relations between these tags
    public function setTagsAttribute($tagsString)
    {
        Tag::relateModelToTags($this, $tagsString);
    }

    // --------------------- SET VIDEOS (AND ITS PREVIEWS) --------------------------- //
    public function setTrailerVideoIdAttribute(string $trailerVideoId): void
    {
        $this->attributes['trailer_video_id'] = $trailerVideoId;
    }

    public function setTrailerVideoPreviewImageAttribute(HttpFile $previewImage): void
    {
        $this->setImageHelper($previewImage, self::IMAGE_TYPE_TRAILER);
    }

    public function setReviewVideoIdAttribute(string $reviewVideoId): void
    {
        $this->attributes['review_video_id'] = $reviewVideoId;
    }

    public function setReviewVideoPreviewImageAttribute(HttpFile $previewImage): void
    {
        $this->setImageHelper($previewImage, self::IMAGE_TYPE_REVIEW);
    }

    // create a relation between the gallery video and this modification object
    public function setGalleryVideoAttribute(HttpFile $galleryVideoFile): void
    {
        $this->setImageHelper($galleryVideoFile, self::VIDEO_TYPE_GALLERY);
    }

    public function setGalleryVideoImageAttribute(HttpFile $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_GALLERY_VIDEO);
    }


    // -------------------------- SET IMAGES -------------------------------- //

    // sets a main image for this modification
    public function setMainImageAttribute(HttpFile $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_MAIN);
    }

    // sets screenshots for this modification
    public function setScreenshotsAttribute(array $images): void
    {
        foreach ($images as $image) // go through each screenshot image
        {
            $this->setImageHelper($image, self::IMAGE_TYPE_SCREENSHOTS);
        }
    }

    // sets a boxart image for this modification
    public function setBoxartImageAttribute(HttpFile $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_BOXART);
    }

    // sets a background image for this modification
    public function setBackgroundImageAttribute(HttpFile $image): void
    {
        $this->setImageHelper($image, self::IMAGE_TYPE_BACKGROUND);
    }

} // class Mod
