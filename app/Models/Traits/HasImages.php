<?php

namespace App\Models\Traits;

use App\Helpers\FileManager;
use App\Helpers\LocalFileManager;
use App\Helpers\Utils;
use App\Service\ImageEditor;
use Illuminate\Support\Collection;
use \Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

trait HasImages
{
    // ----------------------------------------------------------------------- //
    //                       MUTATORS (SETTERS)                                //
    // ----------------------------------------------------------------------- //

    // prepares an image file and makes relation to it
    // according to particular image type and extension
    private function setImageHelper(File $imageFile,
                                    string $imageType): void
    {
        // create a relation between the image and the model object
        $this->files()->create([
            'file' => $imageFile,
            'type' => $imageType,
        ]);
    }

    // ----------------------------------------------------------------------- //
    //                       ACCESSORS (GETTERS)                               //
    // ----------------------------------------------------------------------- //

    protected function getDefaultFile(): string
    {
        if($this->type && config("filesystems.types.$this->type.default_file")) {
            return Storage::url(config("filesystems.types.$this->type.default_file"));
        }
        return Storage::url(config('filesystems.default_files.image'));
    }

    # ---------------------- Accessors (for urls) ---------------------------- //

    // returns a url of the first related image to this model by particular $type
    public function getImageUrlByType(string $type): string
    {
		// use last() because if we for example changed a main image we want to use
		// this last image BUT not the previous one
    	$fileModel = $this->files()->where('type', $type)->get()->last();
        return ($fileModel) ? $fileModel->file_url : "there is no image";
    }

    // returns a collection of images urls of the related image to this model;
    // sorts images by the passed $type;
    public function getImagesUrlsCollectionByType(string $type): Collection
    {
        $imagesFilesCollection = $this->files()->where('type', $type)->get();  // get a collection of FileModel objects from the database

        return $imagesFilesCollection->map(function ($item, $key) {            // go through each FileModel object
            return $item->file_url;                                            // and get a link to this file
        });
    }


    # ------------ Accessors (for retrieving a file object) ------------------ //

    // according to the passed $type
	// returns an array of File objects related to this image;
    public function getImageFileObjectsByType(string $type): Collection
    {
		$fileModels = $this->files()->where('type', $type)->get(); // get the related FileModel instances
		$storageFilesPaths = $this->getImagesPathsByRelatedFileModels($fileModels); // get the storage files paths

		// return an array of file objects
		return $this->getFileObjectsByStoragePaths($storageFilesPaths);
    }




	// ----------------------------------------------------------------------- //
	//                            PRIVATE HELPERS                              //
	// ----------------------------------------------------------------------- //

    // get an array of file paths which are respectively related to some FileModel instance
    private function getImagesPathsByRelatedFileModels(EloquentCollection $fileModels): array
	{
		$storagePaths = [];

		foreach ($fileModels as $fileModel) // go through each FileModel
		{
			$storagePaths[] = $fileModel->fileInStorage->pathToFile; // and get a path of the related file
		}

		return $storagePaths;
	}

	// makes an array of file objects by its storage paths
	private function getFileObjectsByStoragePaths(array $storageFilesPaths): Collection
	{
		$fileManager = new LocalFileManager();  // to get files through its storage path
		$fileObjects = new Collection();

		foreach ($storageFilesPaths as $path)
		{
			$fileObjects[] = $fileManager->getFileByStoragePath($path); // get a File object
		}

		return $fileObjects; // return an array of File objects
	}
}
