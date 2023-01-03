<?php

return [
    'main_title' => 'Stalker2',

    'landing' => [
        'enter_button' => 'Enter the zone',
        'download_mods_button' => 'Download mods',
        'video_post_title' => 'Latest Videos',
        'broadcasting_title' => 'Live',
    ],

    'logo_name' => 'stalker2',

    'search' => [
        'placeholder_form' => 'Monolith, ComicsCon, Anomalies, ...',

        'category' => [
            'all' => 'All',
            'news' => 'News',
            'modifications' => 'Modifications',
            'media' => 'Media',
        ],

        'latest' => [
            'posts_title' => 'Latest posts',
            'more_tag' => 'See more on the blog',
        ],

        'popular' => [
            'tags_title' => 'Popular tags',
            'content_title' => 'Popular content',
        ],
    ],

    'header' => [
        'login_button' => 'Login',
        'search_button' => 'search',
    ],

    'aside' => [
        'navigation' => [
            'menu' => 'Menu',
            'services' => 'Services',
        ]
    ],

     'footer' => [
         'description' => 'This is the first fan project for S.T.A.K.E.R 2. This is NOT official website. The latest news and a lot of content for S.T.A.K.E.R fans.',
         'contacts' => 'Contacts',
         'legal' => 'Legal',
         'social' => 'Social',
         'bottom' => 'stalker2 | All rights reserved.',
     ],

    'category' => [
        'section' => [
            'more_category_posts' => 'See more posts in category',
        ],

        'post_new' => 'Create a post',

        'posts_list' => [
            'all' => 'All',
            'articles' => 'Articles',
            'videos' => 'Videos',
            'gallery' => 'Gallery',
        ],
    ],

    'read_more' => 'Read More',

    'subscribe' => [
        'title' => 'Subscribe to our newsletter',
        'email_placeholder' => 'ENTER YOUR E_MAIL',
        'button' => 'subscribe',
    ],

    'pined' => [
        'posts_title' => 'Pinned posts',
        'post_info' => 'Important to read'
    ],

    'filter_label' => 'Order by',
    'filter_option_related' => 'Related',
    'filter_option_popular' => 'Most popular',
    'loading_button' => 'Loading',




    // ------------------------------------------------------------------------------------- //
    //                                       POST                                            //
    // ------------------------------------------------------------------------------------- //

     'post' => [
         // ----------------------------- CATEGORY ----------------------------------------- //
         'category' => [
             'loadmore' => [
                 'errors' => [
                     'page' => [
                         'required' => "The offset parameter is required",
                         'int'      => "The offset must be of integer type",
                         'min'      => "The offset can't have zero value or below",
                     ],
                     'type' => [
                         'in' => "The type parameter has an incorrect value",
                     ],
                     'orderBy' => [
                         'in' => "The orderBy parameter has an incorrect value",
                     ]
                 ], // errors
             ], // loadmore
         ], // category
    ], // post
];