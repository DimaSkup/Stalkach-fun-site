<?php

namespace App\Models;

use App\Helpers\Traits\FileUtils;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
	# !Constants
	public const MIME_TYPES_IMAGE = 'image';
	public const MIME_TYPES_VIDEO = 'video';
	public const MIME_TYPES_AUDIO = 'audio';
	public const MIME_TYPES_ARCHIVE = 'archive';
	public const MIME_TYPES_DOCUMENT = 'document';
	public const MIME_TYPES_PDF = 'pdf';

	public const TYPES = [
		self::MIME_TYPES_IMAGE => 'model.files.type.image',
		self::MIME_TYPES_VIDEO => 'model.files.type.video',
		self::MIME_TYPES_AUDIO => 'model.files.type.audio',
		self::MIME_TYPES_ARCHIVE => 'model.files.type.archive',
		self::MIME_TYPES_DOCUMENT => 'model.files.type.document',
		self::MIME_TYPES_PDF => 'model.files.type.pdf',
	];

	# !Parameters
	protected $fillable = [
		'original_name',
		'name',
		'disk',
	];

	# !Relationships
	public function fileModel(): Relation
	{
		return $this->belongsTo(FileModel::class, 'id', 'file_id');
	}


	// ------------------------------------------------------------------------------- //
	//                              MUTATORS (GETTERS)                                 //
	// ------------------------------------------------------------------------------- //

	public function getFileUrlAttribute(): string
	{
		return Storage::url($this->pathToFile);
	}

	public function getPathToFileAttribute(): string
	{
		$type = $this->fileModel->type;
		return Utils::getPathToDirByFileType($type) . $this->name;
	}

	# !Methods

	/**
	 * Loading a file into a model and saving it to storage
	 */
	public static function store(\SplFileInfo $uploadedFile, ?string $type = null, bool $isFileExistOnDisk = false): self
	{
		if (!$uploadedFile instanceof UploadedFile || !$uploadedFile instanceof \Illuminate\Http\File) {
			$uploadedFile = new UploadedFile($uploadedFile, $uploadedFile->getFilename());
		}

		if ($type) {         //  if we have some file type we get data about this type
			$typeData = Utils::getFileTypeConfig($type);

			if ($typeData) {
				$disk = $typeData['disk'];
				$path = $typeData['path'];
			}
		}

		$file = new self();
		$file->disk = $disk ?? config('filesystems.default'); // use a disk for this particular file type or just use default one
		$file->mime_type = $uploadedFile->getMimeType();
		$file->size = $uploadedFile->getSize();

		if (!$isFileExistOnDisk) // if this file is already stored on the disk we won't store it again
		{
			$file->original_name = $uploadedFile->getClientOriginalName();
			$file->name = $uploadedFile->hashName();
			$fileUrl = $uploadedFile->storeAs($path ?? null, $file->name, $file->disk); // store the file
		} else // this file is already stored
		{
			$file->original_name = $uploadedFile->getBasename();
			$file->name = $file->original_name;
		}

		$file->save();

		return $file;
	}


}
