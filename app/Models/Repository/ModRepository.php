<?php


namespace App\Models\Repository;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Traits\DevUtils;
use App\Models\Mod;
use App\Helpers\Utils;
use App\Service\ImageChecker;
use App\Service\ImageEditor;
use App\Service\ImageUploader;
use App\Service\YouTubeVideoService;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

// this class is responsible for interaction between the Mod model and the database
class ModRepository
{
    private ImageUploader $imageUploader;

    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }

    // creates, initializes and stores a new modification into the database
    // by the data which we retrieve from the creation form
    public function create(Collection $modData): Mod
    {
        // create a new instance of Mod
        $mod = new Mod();

        $this->setUpBasicMod($mod, $modData);  // set up this new modification
        $mod->save();   // now we need to save this model object because later we'll create relations to it

        $this->makeExternalRelationsToMod($mod, $modData); // make some external relations
        $mod->update();  // after all we need to update the modification to save new relations

        return $mod; // return the new Mod object
    } // create()



    // ------------------------------------------------------------------------------- //
    //
    //                                  HELPERS
    //
    // ------------------------------------------------------------------------------- //

    // returns a standard mod repository instance which is configured to work with 'public' disk
    public static function getStandardModRepositoryInstance(): ModRepository
    {
        $fileManager = new LocalFileManager('public');
        $imageUploader = new ImageUploader($fileManager, new ImageEditor, new ImageChecker);
        return new ModRepository($imageUploader);
    }

    // configure the modification with some basic parameters
    public function setUpBasicMod(Mod $mod, Collection $modData): bool
    {
        // prepare some data
        $downloadLinksJsonString = $this->prepareDownloadLinks($modData);
        $customLinksJsonString = $this->prepareCustomLinks($modData->get('custom_links'));
        $societyLinksJsonString = $this->prepareSocietyLinks($modData->get('society_links'));

        // set up the modification
        $mod->name = $modData->get('name');
        $mod->description = $modData->get('description');
        $mod->presentation = $modData->get('presentation');
        $mod->game = $modData->get('game');
        $mod->views = 0;

        // set the links for this modification
        $mod->downloadLinks = $downloadLinksJsonString;
        $mod->customLinks = $customLinksJsonString;
        $mod->societyLinks = $societyLinksJsonString;

        return true;
    } // SetUpBasicMod()

    // makes relations of some other models to this modification
    private function makeExternalRelationsToMod(Mod $mod, Collection $modData): void
    {
        $mod->author_id = Auth::user()->id;   // set author of mod
        $mod->tags = $modData->get('tags');   // set tags for the mod

        // ------- relate images -------- //
        $this->relateImagesToMod($mod, $modData);

        // ------- relate videos -------- //
        $this->relateVideosToMod($mod, $modData->get('trailer_video'), $modData->get('review_video'));
    }

    // relates images to this modification
    public function relateImagesToMod(Mod $mod, Collection $modData): void
    {
        $mod->mainImage = $modData->get('main_image'); // make a MAIN IMAGE relation
        $mod->screenshots = $modData->get('screenshots'); // make a SCREENSHOTS relation
        $mod->boxartImage = $modData->get('boxart_image'); // make a BOXART relation
        $mod->backgroundImage = $modData->get('background_image'); // make a BACKGROUND relation
    }

    // relate some YouTube videos to this modification
    public function relateVideosToMod(Mod $mod, $trailerLink = null, $reviewLink = null): bool
    {
        // if we have some link of a YouTube trailer video
        if ($trailerLink)
        {
            $trailerVideoData = $this->getVideoPreviewImageAndId($trailerLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE); // prepare data of the video (get its preview image and an id)
            $mod->trailerVideoId = $trailerVideoData->get('id'); // make relations
            $mod->trailerVideoPreviewImage = $trailerVideoData->get('image');
        }

        // if we have some link of a YouTube trailer video
        if ($reviewLink)
        {
            $reviewVideoData = $this->getVideoPreviewImageAndId($reviewLink, YouTubeVideoService::YOUTUBE_PREVIEW_IMAGE);   // prepare data of the video (get its preview image and an id)
            $mod->reviewVideoId = $reviewVideoData->get('id'); // make relations
            $mod->reviewVideoPreviewImage = $reviewVideoData->get('image');
        }

        return true;
    } // relateVideosToMod()

    // get the video's preview image of particular $videoType and id by a video link
    public function getVideoPreviewImageAndId($videoLink, $videoType): Collection
    {
        // upload the video preview image file
        $video = new YouTubeVideoService($videoLink);
        $previewImageFile = $this->imageUploader->upload($video->getHighThumbnail()->url, $videoType, "jpg");

        // return the video's thumbnail image and its id
        return new Collection([
            'image'   => $previewImageFile,
            'id'      => $video->getId(),
        ]);
    } // GetVideoPreviewImageAndId()


    // prepare download links to converting it into a json format
    public function prepareDownloadLinks($downloadLinks): bool|string
    {
        $downloadLinksArray = [];
        foreach (Mod::DOWNLOAD_SOURCES as $sourceType) // make associative array
        {
            $downloadLinksArray[$sourceType] = $downloadLinks[$sourceType] ?? null;
        }
        return json_encode($downloadLinksArray, JSON_THROW_ON_ERROR);
    }

    public function prepareCustomLinks(string $customLinksLine): string
    {
        return json_encode(explode(" ", $customLinksLine), JSON_THROW_ON_ERROR);
    }

    public function prepareSocietyLinks(array $societyLinks): string
    {
        return json_encode($societyLinks, JSON_THROW_ON_ERROR);
    }
}