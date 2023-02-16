<?php

namespace App\Models;

use App\Helpers\Utils;
use App\Models\Traits\HasImages;
use RuntimeException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class FileModel extends Model
{
    use HasFactory;
    use HasImages;

    public $uploadedFile;
    //public $fileInStorage;

    protected $fillable = [
        'file',     // File object or string (link)
        'type',     // image type
        'model'
    ];

    /**
     * FileModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if(isset($attributes['file']) && $attributes['file']) {
            $this->setFileAttribute($attributes['file']);
            unset($attributes['file']);
        }

        parent::__construct($attributes);
    }

    # Relationships
    public function model(): Relation
    {
        return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
    }

    public function fileInStorage(): Relation
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

	// ------------------------------------------------------------------------------- //
	//                              MUTATORS (GETTERS)                                 //
	// ------------------------------------------------------------------------------- //

	// Get the url of the file depending on its storage format
    public function getFileUrlAttribute(): string
    {

        if ($this->url) {
            return $this->url;
        }

       // Utils::dd($this->type);
		if ($this->type === 'user_image_avatar')
			Utils::dd("KEK");

        $fileUrl = $this->fileInStorage->fileUrl ?? null;
        if ($fileUrl) {

            return $fileUrl;
        }

        return $this->getDefaultFile();
    }

    public function getPathToFileAttribute(): string
	{
		return $this->fileInStorage->pathToFile;
	}

    public function setFileAttribute($file): void
    {
        if ($file instanceof \SplFileInfo) {    // uploaded file
            $this->uploadedFile = $file;
        } elseif ($file instanceof File) {      // \models\File
            $this->fileInStorage = $file;
        } elseif (str_contains($file, 'http')) { // a link to the image in the Internet
            $this->url = $file;
        } else {
            throw new RuntimeException('Attribute "file" not identified');
        }
    }

}
