<?php

namespace App\Observers;

use App\Helpers\Traits\FileUtils;
use App\Models\File;
use App\Models\FileModel;
use Illuminate\Support\Facades\Storage;

class FileModelObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function created(FileModel $fileModel): void
    {
        if ($fileModel->uploadedFile) {
            $isFileExist = FileUtils::isFileExistOnDisk($fileModel->uploadedFile, $fileModel->type);
            $file = File::store($fileModel->uploadedFile, $fileModel->type, $isFileExist);
            $fileModel->file_id = $file->id;
            $fileModel->save();
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function updated(FileModel $fileModel): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function deleted(FileModel $fileModel): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function restored(FileModel $fileModel): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  FileModel  $fileModel
     * @return void
     */
    public function forceDeleted(FileModel $fileModel): void
    {
        //
    }
}
