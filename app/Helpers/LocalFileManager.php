<?php

namespace App\Helpers;

use App\Helpers\Traits\DevUtils;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

// this class is an implementation of the FileManager interface to work with files;
class LocalFileManager implements FileManager
{
    public const DEFAULT_DISK = 'public';       // a default disk name if we didn't set current working disk manually
    private string $disk;                       // contains a name of the current working disk
    private string $tempDisk = 'storage_root';     // a name for temporal disk
    private string $tempFileType = 'temp_file'; // a name for temporal files type

    public function __construct($disk = self::DEFAULT_DISK)
    {
        $this->setDisk($disk);
    }

    // ------------------------------------------------------------------------------- //
    //
    //                             PUBLIC FUNCTIONS
    //
    // ------------------------------------------------------------------------------- //

    public function setDisk(string $disk): void
    {
        $this->disk = $disk;
    }

    public function getDisk(): string
    {
        return $this->disk;
    }

    // returns the name of the temporal disk
    public function getTempDisk(): string
    {
        return $this->tempDisk;
    }

    // returns the name of the temporal files type
    public function getTempFileType(): string
    {
        return $this->tempFileType;
    }

    // ---------------------------- FILE DATA GETTERS -------------------------------- //

    // returns a full path to dir/file by passed $storagePath
    public function getFullPathByStoragePath(string $storagePath): string
    {
        return Storage::disk($this->disk)->path($storagePath);  // full path to the file
    }

	// returns a storage path to dir/file by passed $fullPath
	public function getStoragePathByFullPath(string $fullPath): string
	{
		$offset = strpos($fullPath, "/storage");
		return substr($fullPath, $offset + strlen("/storage"));
	}

    // returns the content of the passed file (it can be file object or link to the file)
    public function getContent(UploadedFile|string $fileResource): string
    {
        if ($fileResource instanceof UploadedFile)      // we have a file object
        {
            return $fileResource->getContent();
        }

        return $this->getContentByLink($fileResource);  // we have a link to the file
    } // getContent()

    // takes a FILE OBJECT or PATH or LINK to some file and returns its size in bytes
    public function getFileSizeInBytes(\SplFileInfo|string $fileResource): int
    {
        // if this file is REMOTE (we have a link to it)
        if ($this->isRemoteFile($fileResource))
        {
            $fileHeaders = get_headers($fileResource, 1);

            // there can be two possible array keys
            $contentLengthKey = array_key_exists("content-length", $fileHeaders) ? "content-length" : "Content-Length";
            return (int)$fileHeaders[$contentLengthKey];
        }

        // do we have a file here?
        if (!is_file($fileResource))
        {
            throw new FileNotFoundException($fileResource);
        }

        // if we have a FILE OBJECT
        if ($fileResource instanceof \SplFileInfo)
        {
            return $fileResource->getSize();
        }

        // we have a PATH to the file so we return its size
        return filesize($fileResource);
    } // getFileSizeInBytes()

    // defines if the input string is a link to some resource in the Internet
    public function isRemoteFile(string $file): bool
    {
        return str_contains($file, "http");
    }

    /*
      // checks if such a $file with such a $type exists on the $disk
    public function isFileExistOnDisk(File $file, string $type): bool
    {
        $pathInStorage = $this->getPathToDirByType($type);
        $pathToFileInStorage = $pathInStorage . $file->getBasename();

        return Storage::disk($this->disk)->exists($pathToFileInStorage); // check if this file has been stored before
    } // isFileExistsOnDisk()
     */

    // returns an array with all the configs for this particular $fileType
    // OR returns all the configs if the input param is NULL
    public function getFileConfigsByType(string $fileType = null): array
    {
        return DevUtils::getConfig('filesystems.types'.($fileType ? ".$fileType" : ''));
    }

    // returns a path to files directory by particular $fileType
    public function getPathToDirByType(string $fileType): string
    {
        $configs = $this->getFileConfigsByType($fileType);
        $keyExists = array_key_exists('path', $configs);   // check if we have a PATH key

        if ($keyExists) // if such a key exists
        {
            if ($configs['path']) // if the path data is not empty
            {
                return $configs['path']; // return the path
            }
        }

        // if we don't have a PATH key in configs we throw an exception about it
        throw new \RuntimeException("the PATH key is missing or path data is empty in configs of type: " . $fileType);
    }


    // ------------------------------ FILE OBJECT GETTERS ---------------------------- //

    // returns a File object by $path location in the Storage folder
    public function getFileByStoragePath(string $storagePath): File
    {
        $fullFilePath =  $this->getFullPathByStoragePath($storagePath);  // full path to the file

        if (!is_file($fullFilePath))    // check if we have a file by this path
        {
            throw new FileNotFoundException($fullFilePath);
        }

        return $this->getFileByFullPath($fullFilePath);                   // return a File object
    } // getFileByStoragePath()


    // takes a full PATH to the file and return a File object
    public function getFileByFullPath(string $fullPathToFile): File
    {
        if (!is_file($fullPathToFile))    // check if we have a file by this path
        {
            throw new FileNotFoundException($fullPathToFile);
        }

        return new File($fullPathToFile, true);
    } // getFileByFullPath()


    // Description: this function is using to create a local copy of some file by particular resource
    // 1. takes a file object or link to some file and
    // 2. creates a local (temporal) copy of this file
    // 3. returns this copy as a File object
    public function getTempFileByResource(\SplFileInfo|string $fileOrLink): File
    {
		$storeToDir = $this->getPathToDirByType($this->getTempFileType());
		$extension = pathinfo($fileOrLink, PATHINFO_EXTENSION);

		if (is_string($fileOrLink)) // if we have a link to the file
		{
			$fileContent = $this->getContentByLink($fileOrLink); // download the file content by its link

			$diskName = $this->getDisk();                        // save the current disk name
			$this->setDisk($this->getTempDisk());                // set a storage disk for temporal files

			// create a new file object using prepared data
			$storagePathToFile = $this->storeContentAsFileTo($fileContent, $storeToDir, $extension);
			$tempFile = $this->getFileByStoragePath($storagePathToFile);

			$this->setDisk($diskName);             // set the previous one disk name
		}
		else // else we have some image object so we just copy this file into the temp dir
		{
			$storeFrom = $this->getStoragePathByFullPath($fileOrLink->getRealPath());

			// generate a path to file
			$tempImageName = hash('sha256', time());        // get a hash-code which we will use as filename
			$storeTo = $storeToDir . $tempImageName . "." . $extension; // short_path + name + extension

			// copy the file
			Storage::disk($this->disk)->copy($storeFrom, $storeTo);
			$tempFile = $this->getFileByStoragePath($storeTo);
		}

		return $tempFile;  // return the temporal file
    } // getTempFileByResource()



    // ------------------------------ FILE SAVERS ------------------------------------ //

    // gets a file content and store it as a new file by the $path path
    // returns a path to a new file in the Storage folder
    public function storeContentAsFileTo(string $content,
                                         string $storagePath,
                                         string $extension = "webp"): string
    {
        // check the arguments
        DevUtils::checkArguments($content, $storagePath, $extension);

        // generate file path
        $imageName = hash('sha256', $content.random_int(1, 100));    // get a hash-code which we will use as filename
        $storagePathToFile = $storagePath . $imageName . "." . $extension; // short_path + name + extension

        // store the image into the disk
        $result = Storage::disk($this->disk)->put($storagePathToFile, $content);
        if (!$result)
        {
            throw new \RuntimeException("can't store a file into the disk");
        }

        return $storagePathToFile;   // return a path to the file in the Storage folder
    } // storeContentAsFileTo()


    // --------------------------- OPERATIONS WITH FILES ----------------------------- //

    // deletes a single file by the $storagePath
    public function deleteFileByStoragePath(string $storagePath): bool
    {
        // check if we have a file by such a path
        if (!is_file($this->getFullPathByStoragePath($storagePath)))
        {
            throw new FileNotFoundException($storagePath);
        }

        return Storage::disk($this->disk)->delete($storagePath);
    }

    // deletes a single file by its full path
    public function deleteFileByFullPath(string $fullPathToFile): bool
    {
        // check if we have a file by such a path
        if (!is_file($fullPathToFile))
        {
            throw new FileNotFoundException($fullPathToFile);
        }

        return unlink($fullPathToFile);
    }

    /*
     // drop all the files (not folders) by $storagePathToDir location
    public function deleteAllFilesInDirByStoragePath(string $storagePathToDir): bool
    {
        $fullPathToDir =  Storage::disk($this->disk)->path($storagePathToDir);
        return FacadesFile::cleanDirectory($fullPathToDir);  // delete content of the directory
    }
     */




    // ------------------------------------------------------------------------------- //
    //
    //                           PRIVATE FUNCTIONS (HELPERS)
    //
    // ------------------------------------------------------------------------------- //

    // returns the content of a file by it's link in the Internet
    private function getContentByLink(string $linkToFile): string
    {
        $isRemote = $this->isRemoteFile($linkToFile); // is this file remote?

        if ($isRemote)
        {
            $content = file_get_contents($linkToFile);
            if ($content === false)  // we can't get a file content
            {
                throw new FileException(sprintf('Could not get the content of the file "%s".', $linkToFile));
            }

            return $content;  // return content of the image
        }

        return "The file isn't remote";
    } // getContentByLink()
}