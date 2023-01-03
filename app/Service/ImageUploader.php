<?php

namespace App\Service;

use App\Helpers\FileManager;
use App\Helpers\Traits\DevUtils;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

// this class is responsible for handling the uploading process of images
class ImageUploader
{
    private FileManager $fileManager;    // for work with the filesystem
    private ImageEditor $imageEditor;    // for editing images (resizing, etc.)
    private ImageChecker $imageChecker;  // for checking if an image resource is correct

    public function __construct(FileManager $fileManager,
                                ImageEditor $imageEditor,
                                ImageChecker $imageChecker)
    {
        $this->fileManager = $fileManager;
        $this->imageEditor = $imageEditor;
        $this->imageChecker = $imageChecker;
    }

    // uploads an image into the local disk;
    // takes some resource and makes an image with specified $fileType and $extension;
    // returns a File object of this new uploaded image
    public function upload(UploadedFile|string $fileResource,
                           //User $uploadedBy,
                           string $fileType,
                           string $extension = "webp"): File
    {
        // first of all we need to check the image
        $fileResourceToCheck = is_string($fileResource) ? $fileResource : $fileResource->getRealPath();
        $this->imageChecker->check($fileResourceToCheck);

        // get path to the image to use it for editing this image later
        $tempImage = $this->fileManager->getTempFileByResource($fileResource);  // we download it as a temporal file for later modifications
        $fullPathToTempImage = $tempImage->getRealPath();

        // get params for the future image
        $configKey = "content." . DevUtils::getConfigKeyByFileType($fileType);
        $imageParams = DevUtils::getConfig($configKey);

        // create image content with the necessary params
        $newImageContent = $this->imageEditor->createImageContentWithParams($fullPathToTempImage, $imageParams, $extension);

        // delete the temporal image because we already don't need it
        $this->fileManager->deleteFileByFullPath($tempImage->getRealPath());

        // store the file into the storage folder to a location for this particular file type
        $storeTo = $this->fileManager->getPathToDirByType($fileType);
        $storagePathToFile = $this->fileManager->storeContentAsFileTo($newImageContent, $storeTo);

        // return the File object of the image
        return $this->fileManager->getFileByStoragePath($storagePathToFile);
    } // upload()
}