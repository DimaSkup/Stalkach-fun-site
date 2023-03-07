<?php


namespace App\Service\Image;

use App\Helpers\LocalFileManager;


use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

// this class is responsible for interaction between models and its images
class ModelImageService
{
	private Model $model;  // model object with which we will work

	public function __construct(Model $model)
	{
		if (method_exists($model, 'files'))
		{
			$this->model = $model;
			return;
		}
		Utils::dd("You can't create an instance of the " . __CLASS__ . " because the input model object doesn't have a files() method!");
	}


	// ----------------------------------------------------------------------- //
	//                       MUTATORS (SETTERS)                                //
	// ----------------------------------------------------------------------- //

	// makes relation between some model and image;
	// and sets an image type value according to the $imageType
	public function setImage(File $imageFile, string $imageType): void
	{
		// create a relation between the image and the model object
		$this->model->files()->create([
			'file' => $imageFile,
			'type' => $imageType,
		]);
	}



	// ----------------------------------------------------------------------- //
	//                       ACCESSORS (GETTERS)                               //
	// ----------------------------------------------------------------------- //

	# ---------------------- Accessors (for urls) ---------------------------- //

	// returns a url to the first related image to the passed model by particular $type
	public function getImageUrlByType(string $type): string
	{
		// use last() to get the newest image file with such a $type
		$fileModel = $this->model->files()->where('type', $type)->get()->last();
		return ($fileModel) ? $fileModel->file_url : "there is no image";
	}

	// returns a collection of all the images by such a $type and which are related to the $model
	public function getImagesUrlsCollectionByType(string $type): Collection
	{
		$imagesFilesCollection = $this->model->files()->where('type', $type)->get();  // get a collection of FileModel objects from the database

		return $imagesFilesCollection->map(function ($item, $key) {             // go through each FileModel object
			return $item->file_url;                                             // and get a link to this file
		});
	}


	# ------------ Accessors (for retrieving a file object) ------------------ //

	// according to the passed $model and $type returns a collection of images files
	public function getImageFileObjectsByType(string $type): Collection
	{
		$fileModels = $this->model->files()->where('type', $type)->get(); // get the related FileModel instances
		$storageFilesPaths = $this->getImagesPathsCollectionByImagesFileModels($fileModels); // get the storage files paths

		// return a collection of file objects
		return $this->getFileObjectsByStoragePaths($storageFilesPaths);
	}



	// ----------------------------------------------------------------------- //
	//                     PRIVATE HELPERS (FOR GETTERS)                       //
	// ----------------------------------------------------------------------- //

	// get an array of files paths which are respectively related to some FileModel instance
	public function getImagesPathsCollectionByImagesFileModels(EloquentCollection $imagesFileModels): Collection
	{
		return $imagesFileModels->map(function ($item, $key) {
			return $item->fileInStorage->pathToFile;
		});

	/*
	 	$storagePaths = [];

		foreach ($imagesFileModelsCollection as $fileModel) // go through each image FileModel
		{
			$storagePaths[] = $fileModel->fileInStorage->pathToFile; // and get a path of the related file
		}

		return $storagePaths;

	 */
	}


	// makes an array of file objects by its storage paths
	public function getFileObjectsByStoragePaths(Collection $storageFilesPaths): Collection
	{
		$fileManager = new LocalFileManager();  // to get files through its storage path

		return $storageFilesPaths->map(function ($path, $key) use ($fileManager) {
			return $fileManager->getFileByStoragePath($path);  // get a File object
		});

		/*
			 $fileObjects = new Collection();

			foreach ($storageFilesPaths as $path)
			{
				$fileObjects[] = $fileManager->getFileByStoragePath($path); // get a File object
			}

			return $fileObjects; // return an array of File objects
		 */
	}
}