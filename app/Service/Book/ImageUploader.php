<?php

namespace App\Book\Service;

use App\Models\User;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

final class ImageUploader
{
    private ImageGuard $imageGuard;
    private FilesystemManager $fileSystemManager;
    private WrongImageUploadsListener $listener;
    private Repository $config;

    public function __construct(ImageGuard $imageGuard,
                                FileSystemManager $fileSystemManager,
                                WrongImageUploadsListener $listener,
                                Repository $config)
    {
        $this->imageGuard = $imageGuard;
        $this->fileSystemManager = $fileSystemManager;
        $this->listener = $listener;
        $this->config = $config;
    }


    public function upload(UploadedFile $file,
                           User $uploadedBy,
                           string $type)
    {
        $fileContent = $file->getContent();

        $options = $this->config->get('image.' . $type); // get configurations for images

        // if we want to check an image's content
        if (Arr::get($options, 'check', true))
        {
            $weak = Arr::get($options, 'weak', false); // if we want or not to have weaken rules for checking

            if (!$this->imageGuard->check($fileContent, $weak))  // if some image don't pass checking of its content
            {
                if (Arr::get($options, 'ban', true)) // if we want to ban user or not
                {
                    $this->listener->handle($uploadedBy);
                }

                return false;
            }
        }

        $fileName = $options['folder'] . 'some_unique_file_name.jpg';

        $defaultDisk = $this->config->get('image.disk');

        $this->fileSystemManager
            ->disk(Arr::get($options, 'disk', $defaultDisk))
            ->put($fileName, $fileContent);

        return $fileName;
    } // upload()



}











// OOP
/*

use App\models\User;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\UploadedFile;
use ImageChecker; // an interface

final class ImageUploader
{
    private ImageChecker $imageChecker;
    private FileSystemManager $fileSystemManager;
    private WrongImageUploadsListener $listener;

    public function __construct(
        ImageChecker $imageChecker,
        FileSystemManager $fileSystemManager,
        WrongImageUploadsListener $listener)
    {
        $this->imageChecker = $imageChecker;
        $this->fileSystemManager = $fileSystemManager;
        $this->listener = $listener;
    }

    public function upload(UploadedFile $file,
                           User $uploadedBy,
                           string $folder)
    {
        $fileContent = $file->getContents();


        if (!$this->imageChecker->check($fileContent))
        {
            $this->listener->handle($uploadedBy);

            return false;
        }

        $fileName = $folder . 'some_unique_file_name.jpg';

        $this->fileSystemManager
            ->disk('...')
            ->put($fileName, $fileContent);

        return $fileName;
    }
}
 */