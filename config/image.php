<?php

// contains parameters to configure the behaviour of the ImageUploader class
return [
    'disk' => 's3',

    'avatars' => [
        'check' => true,
        'ban' => true,
        'folder' => 'avatars',
    ],

    'gallery' => [
        'check' => true,
        'weak' => true,
        'ban' => false,
        'folder' => 'gallery',
    ],
];