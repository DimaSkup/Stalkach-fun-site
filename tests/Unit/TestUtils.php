<?php

namespace Tests\Unit;

use App\Helpers\LocalFileManager;
use App\Helpers\Traits\DevUtils;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File as FacadesFile;

// contains some utils for files tests;
// for example: cleaning of the temporary dir, creation of a test file, etc.
trait TestUtils
{
    // cleans up temporary directory from test files;
    public static function cleanTempDir(): bool
    {
        // get full path to directory to clean it later
        $fileManager = new LocalFileManager('storage_root');
        $storagePathToTempDir = $fileManager->getPathToDirByType("temp_file");
        $fullPathToTempDir = $fileManager->getFullPathByStoragePath($storagePathToTempDir);

        // clean the temporary directory from temporal files
        return FacadesFile::cleanDirectory($fullPathToTempDir);
    }


    // return a File object of the new test file with particular filename and extension
    public static function createNewTestFile(string $filename, string $extension): File
    {
        // check the input arguments
        DevUtils::checkArguments($filename, $extension);

        // preparations
        $fileManager = new LocalFileManager("storage_root");

        $fileFactory = UploadedFile::fake();
        $isImage = in_array($extension, ['jpeg', 'jpg', 'png', 'gif', 'webp', 'wbmp', 'bmp']);
        $fullFilename = $filename . "." . $extension;

        // return a File object of the new test file
        $tempImageObj = ($isImage) ? $fileFactory->image($fullFilename, 1000, 1000)
                                   : $fileFactory->create($fullFilename, 1000);

        return $fileManager->getTempFileByResource($tempImageObj);
    }
}