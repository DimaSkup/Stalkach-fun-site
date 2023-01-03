<?php

namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FacadesFile;
use JetBrains\PhpStorm\Pure;

// There are utils for files manipulation
trait FileUtils
{
    private static $defaultDisk = 'public';

    public static function getDefaultDisk(): string
    {
        return self::$defaultDisk;
    }

    // takes a PATH or LINK to some file and returns its size in bytes
    public static function getFileSizeInBytes($fileResource): int
    {
        if (self::isRemoteFile($fileResource)) // if this file is remote
        {
            $fileHeaders = get_headers($fileResource, 1);
            return (int)$fileHeaders["Content-Length"];
        }

        return filesize($fileResource); // else this file is local
    }

    // getting of a file object by $path location in the Storage folder
    public static function getFileByStoragePath(string $storagePathToFile, $disk = null): File
    {
        $disk = ($disk) ?: self::$defaultDisk;                 // definition of the disk for Storage
        $fullFilePath =  Storage::disk($disk)->path($storagePathToFile);    // full path to the file
        return new File($fullFilePath, true);                  // return a File object
    }

    // takes a full PATH to the file and return a File object
    public function getFileByFullPath(string $fullPathToFile): File
    {
        return new File($fullPathToFile, true);
    }

    // delete a single file by the $filePath
    public static function deleteFileByStoragePath(string $storagePathToFile,
                                                   string $disk = null): bool
    {
        $disk = ($disk) ?: self::$defaultDisk;
        return Storage::disk($disk)->delete($storagePathToFile);
    }

    // drop all the files (not folders) by $path location
    public static function cleanDirInStorage(string $storagePathToDir, string $disk = null): bool
    {
        $disk = ($disk) ?: self::$defaultDisk;
        $fullPathToDir =  Storage::disk($disk)->path($storagePathToDir);
        return FacadesFile::cleanDirectory($fullPathToDir);  // delete content of the directory
    }

    // defines if the input string is a link to some resource in the Internet
    public static function isRemoteFile(string $file): bool
    {
        return str_contains($file, "http");
    }


    // gets an image content and store it as a new image by the $path path
    // returns a path to a new image in the Storage folder
    public static function storeFileContentAsFileTo(string $content,
                                                    string $path,
                                                    string $extension = "webp",
                                                    $disk = null): string
    {
        DevUtils::checkArguments($content, $path, $extension);    // check the arguments

        // generate file path
        $disk = ($disk) ?: self::$defaultDisk;
        $imageName = hash('sha256', $content.random_int(1, 100));    // get a hash-code which we will use as filename
        $storagePathToImage = $path . $imageName . "." . $extension; // path + name + extension

        // store the image into the disk
        $result = Storage::disk($disk)->put($storagePathToImage, $content);
        if (!$result)
        {
            throw new \RuntimeException("can't store a file into the disk");
        }

        return $storagePathToImage;   // return a path to the image in the Storage folder
    }

    // if the $filePathOrLink parameter is a link we delete a file by $fullPathToFileCopy
    public static function deleteCopyIfFileIsRemote(\SplFileInfo|string $filePathOrLink, string $fullPathToFileCopy): bool
    {
        DevUtils::checkArguments($filePathOrLink, $fullPathToFileCopy);  // check the arguments

        if (self::isRemoteFile($filePathOrLink))   // check if there is a link to file
        {
            $deleteResult = FacadesFile::delete($fullPathToFileCopy);  // delete file by the path
            if (!$deleteResult)
            {
                throw new \RuntimeException("Can't delete the file by such path: \n$fullPathToFileCopy");
            }
        }

        return true;
    } // deleteCopyIfFileIsRemote()

    // checks if such $file with such $type exists on the $disk
    public static function isFileExistOnDisk($file, string $type, string $disk = null): bool
    {
        $disk = ($disk) ?: self::$defaultDisk;
        $pathInStorage = FileUtils::getPathToDirByFileType($type);
        $pathToFileInStorage = $pathInStorage . $file->getBasename();

        return Storage::disk($disk)->exists($pathToFileInStorage); // check if this file has been stored before
    }

    // returns an array with all the configs for this particular file type
    public static function getFileTypeConfig(?string $type = null): array
    {
        return DevUtils::getConfig('filesystems.types'.($type ? ".$type" : ''));
    }

    // return a path to file directory by a file type
    public static function getPathToDirByFileType(string $fileType): string
    {
        return DevUtils::getConfig("filesystems.types.$fileType.path");
    }

}
