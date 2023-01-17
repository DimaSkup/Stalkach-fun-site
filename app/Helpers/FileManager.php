<?php

namespace App\Helpers;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

// this is an interface for work with files and filesystems
interface FileManager
{
    public function setDisk(string $disk): void;
    public function getDisk(): string;

    // ---------------------------- FILE DATA GETTERS -------------------------------- //
    public function getFullPathByStoragePath(string $storagePath): string; // returns a full path to dir/file by passed $storagePath
	public function getStoragePathByFullPath(string $fullPath): string;    // returns a storage path to dir/file by passed $fullPath
    public function getContent(UploadedFile|string $fileResource): string; // returns the content of the passed file (it can be file object or link to the file)

    public function getFileSizeInBytes(\SplFileInfo|string $fileResource): int;  // takes a PATH or LINK to some file and returns its size in bytes
    public function isRemoteFile(string $file): bool; // defines if the input string is alink to some resource in the Internet
    //public function checkIsFile(string $filePath): bool;
    //public function isFileExistOnDisk(File $file, string $type): bool;  // checks if such a $file with such a $type exists on the $disk
    public function getFileConfigsByType(string $fileType = null): array; // returns an array with all the configs for this particular file type
    public function getPathToDirByType(string $fileType): string; // returns a path to files directory by particular $fileType


    // ------------------------------ FILE OBJECT GETTERS ---------------------------- //
    public function getFileByStoragePath(string $storagePath): File; // getting of a File object by $path location in the Storage folder
    public function getFileByFullPath(string $fullPathToFile): File; // takes a full PATH to the file and return a File object
    public function getTempFileByResource(\SplFileInfo|string $fileResource): File; // this function is using to create a local copy of some file by particular resource


    // ------------------------------ FILE SAVERS ------------------------------------ //

    // gets an image content and store it as a new image by the $path path
    // returns a path to a new image in the Storage folder
    public function storeContentAsFileTo(string $content, string $storagePath, string $extension = "webp"): string;


    // --------------------------- OPERATIONS WITH FILES ----------------------------- //
    public function deleteFileByStoragePath(string $storagePath): bool; // deletes a single file by the $storagePath
    public function deleteFileByFullPath(string $fullPathToFile): bool;  // deletes a single file by its full path
    //public function deleteAllFilesInDirByStoragePath(string $storagePathToDir): bool; // drop all the files (not folders) by $storagePathToDir location
}