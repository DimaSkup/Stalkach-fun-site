<?php

namespace App\Models\Traits;

use App\Helpers\Traits\DevUtils;
use App\Helpers\Traits\FileUtils;
use App\Service\ImageEditor;
use App\Service\YouTubeVideoService;
use Illuminate\Http\File;
use Illuminate\Support\Collection;

trait HasVideos
{
    // ------------------------------------------------------------------------------- //
    //                           Mutators (for urls)                                   //
    // ------------------------------------------------------------------------------- //

    // returns an url of video of particular $type which is related to the model ($this)
    public function getVideoUrlByType(string $type): string
    {
        $fileObj = $this->files()->where('type', $type)->first();
        return ($fileObj) ? $fileObj->file_url : "there is no url";
    }


    // ------------------------------------------------------------------------------- //
    //                      Mutators (for retrieving files)                            //
    // ------------------------------------------------------------------------------- //
    // return a video file object of particular $type which is related to the model ($this)
    public function getVideoFileObjectByType(string $type): File
    {
        return $this->files()
            ->where('type', $type)->first()->fileInStorage()->first();
    }


 /*
     // ----------------------------------------------------------------------------- //
    //                                  HELPERS                                      //
    // ----------------------------------------------------------------------------- //

    // get the video's preview image of particular $videoType and id by a video link
    public function getVideoPreviewImageAndId($videoLink, $videoType): Collection
    {
        // first of all we need to check the input parameters
        DevUtils::checkArguments($videoLink, $videoType);

        // upload the video preview image file
        $video = new YouTubeVideoService($videoLink);
        $previewImageFile = $this->imageUploader->upload($video->getHighThumbnail()->url, $videoType, "jpg");

        // return the video's thumbnail image and its id
        return new Collection([
            'image'   => $previewImageFile,
            'id'      => $video->getId(),
        ]);
    } // getVideoPreviewImageAndId()
  */
}
