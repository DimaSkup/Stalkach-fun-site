<?php

namespace App\Service;

use App\Helpers\FileManager;
use App\Helpers\Traits\DevUtils;
use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

// this class is responsible for handling the uploading process of images
class ImageUploader
{
    private FileManager $fileManager;    // for work with the filesystem
    private ImageEditor $imageEditor;    // for editing images (resizing, etc.)
    private ImageChecker $imageChecker;  // for checking if an image resource is correct

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        $this->imageEditor = new ImageEditor;
        $this->imageChecker = new ImageChecker;
    }

    // uploads an image into the local disk;
    // takes some resource and makes an image with specified $fileType and $extension;
    // returns a File object of this new uploaded image
    public function upload(\SplFileInfo|string $fileResource,
                           //User $uploadedBy,
                           string $fileType,
                           string $extension = "webp"): File
    {
		try {
			// first of all we need to check the image
			$this->checkImageResource($fileResource);

			// get FULL path to the image so later we can use it for editing this image
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
		}
		catch (\Exception $e)
		{
			$this->printExceptionInfo($e, $fileResource, $fileType);
		}

    } // upload()


	private function checkImageResource(UploadedFile|string $fileResource): bool
	{
		if (is_string($fileResource))  // if we have some path to image
		{
			$fullPathToImage = $fileResource;
		}
		else // else we have some file object
		{
			$fullPathToImage = $fileResource->getRealPath();
		}

		return $this->imageChecker->check($fullPathToImage); // true -- if everything is ok about this image
	}









	private function printExceptionInfo(\Exception $e,
										\SplFileInfo|string $fileResource,
										string $fileType): void
	{
		dump("------------- EXCEPTION -------------:");
		dump("MESSAGE: ", $e->getMessage());
		dump("FILE:   " . $e->getFile());
		dump("LINE:   " . $e->getLine());

		printf(PHP_EOL);
		printf(PHP_EOL);

		$debugTrace = $e->getTrace();
		dump("DEBUG TRACE:", $debugTrace[0], $debugTrace[1], $debugTrace[2], $debugTrace[3], $debugTrace[4]);

		printf(PHP_EOL);
		printf(PHP_EOL);

		dump("FILE RESOURCE:" , $fileResource);
		printf(PHP_EOL);
		printf(PHP_EOL);

		dump("TYPE: ", $fileType);
		dd("");
	}
}