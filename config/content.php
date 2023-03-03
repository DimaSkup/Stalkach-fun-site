<?php


return [
    'post' => [
        'limit' => [
            'offset' => 12,
            'feature' => 3,
            'latest' => 3,
            'popular' => 5,
            'by_type' => 4,
            'by_category' => 4,
        ],
        'image' => [  // params for post images size
            'main' => [
                'width'  => 1600,
                'height' => 900,
            ],
            'masthead' => [
                'width'  => 1600,
                'height' => 900,
            ],
            'gallery' => [
                'width'  => 1600,
                'height' => 900,
            ],
            'square' => [
                'width' => 100,
                'height' => 100,
            ],
            'album' => [
                'width' => 1600,
                'height' => 900,
            ],
        ],
        'category' => [ // params for posts categories
            'image' => [
                'background' => [
                    'width'  => 1600,
                    'height' => 676,
                ],
            ],
        ],
    ], // posts



    'mod' => [
        'image' => [
            'main' => [
                'width' => 1600,
                'height' => 900,
            ],
            'screenshot' => [
                'width' => 1240,
                'height' => 600,
            ],
            'boxart' => [
                'width' => 300,
                'height' => 400,
            ],
            'background' => [
                'width' => 1240,
                'height' => 600,
            ],
        ], // images

        'review_sources' => [
            'youtube'  => "^(https?\\:\\/\\/)?(www\\.youtube\\.com|youtu\\.be)\\/.+$",
            'facebook' => "(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)?",
            'local'    => "localhost",
        ],
    ],


    // common necessary parameters for image files
    'images' => [
        'params' => [
            'max' => [
                'size'   => 5242880,               // max size of image in bytes
                'width'  => 1600,
                'height' => 900,
            ],
            'min' => [
                'width'  => 600,
                'height' => 350,
            ],
            'mime' => [
                'image/bmp',     // .bmp
                'image/gif',     // .gif
                'image/jpeg',    // .jpeg, etc
                'image/png',     // .png
                'image/webp',    // .webp
            ]
        ]
    ],


	'user' => [
		'image' => [
			'avatar' => [
				'width' => 640,
				'height' => 640,
			],
		],
	],

    'youtube' => [
        'url' => "https://www.youtube-nocookie.com/embed/%s",
        'image' => [
            'preview' => [
                'width'  => 1280,
                'height' => 720,
            ],
        ],
    ],

    // for tests
    'temp' => [
        'file' => [
            'width' => 1000,
            'height' => 1000,
        ]
    ]
];