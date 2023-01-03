<?php

// fake paths
$fakePostCategoryImagesDir = 'fake/post_category/';
$fakePostImagesDir = 'fake/post/';
$fakeModImagesDir = 'fake/mod/images/';
$fakeModVideosDir = 'fake/mod/videos/';

// real paths
$postCategoryImages = 'images/post_category/';
$postImages = 'images/post/';
$modImages = 'images/mod/';
$modVideos = 'videos/mod/';



return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),
    'stage' => env('APP_STAGE', 'dev'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => public_path(),
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],
        'proj_root' => [
           'driver' => 'local',
           'root' => "",
        ],
        "storage_root" => [
            'driver' => 'local',
            'root' => storage_path(),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

    'types' => [
        // --------------------------- TEMPORAL ----------------------------- //
        'temp_file' => [
            'disk' => 'storage_root', // prefix
            'path' => 'temp/',  // suffix
        ],

        // ------------------------- YOUTUBE PREVIEW ----------------------- //
        'youtube_image_preview' => [
            'disk' => 'public',
            'path' => 'images/youtube/preview',
            'default_file' => 'default/no-photo.png',
        ],

        // --------------------------- CATEGORY----------------------------- //
        'post_category_image_background' => [
            'disk' => 'public',
            'fake' => $fakePostCategoryImagesDir,
            'path' => $postCategoryImages,  // suffix
            'default_file' => 'default/no-photo.png',
        ],
        // --------------------------- MOD -------------------------------- //
        'mod_image_main' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages,  // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_screenshot' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_trailer' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_review' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_boxart' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_background' => [
            'disk' => 'public',
            'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'mod_image_gallery_video_preview' => [
            'disk' => 'public',
            //'fake' => $fakeModImagesDir,
            'path' => $modImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],


        'mod_video_gallery' => [
            'disk' => 'public',
            'fake' => $fakeModVideosDir,
            'path' => $modVideos, // suffix
            'default_file' => 'default/no-video.mp4',
        ],


        // --------------------------- POST ------------------------------- //
        'post_image_main'  => [
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'post_image_square' => [
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'post_image_album' => [
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'post_image_masthead' => [      // a background image
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        'post_image_gallery' => [
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
        /*
         'post_illustrations' => [
            'disk' => 'public',
            'fake' => $fakePostImagesDir,
            'path' => $postImages, // suffix
            'default_file' => 'default/no-photo.png',
        ],
         */
    ],

    /*
    |--------------------------------------------------------------------------
    | Mime types
    |--------------------------------------------------------------------------
    */
    'mime_types' => [
        'image' => ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/svg+xml', 'image/tiff', 'image/webp'],
        'video' => ['video/mpeg', 'video/webm', 'video/x-msvideo'],
        'audio' => ['audio/mpeg', 'audio/webm', 'audio/wav'],
        'archive' => [
            'application/zip', 'application/vnd.rar', 'application/x-tar', 'application/gzip',
            'application/x-7z-compressed', 'application/x-bzip', 'application/x-bzip2',
        ],
        'document' => [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/pdf',
        ],
        'pdf' => ['application/pdf']
    ],


    'default_files' => [
        'image' => 'default/no-photo.png'
    ],

];
