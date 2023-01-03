<?php
// lang/en/modification.php

return [
    // -------------- MODIFICATIONS main page (the page with the modifications list) ---------
    'index' => [
        'latest' => "latest modifications",
        'in_tags' => "in tags:",
        'read_more' => "Read more",
    ], // index

    // ---------------- translations for the creation page -----------------------------------
    'create' => [
        // common
        'caption'           => "Creation of a new modification",
        'create_button'     => "Create",
        'success_creation'  => "The modification is saved successfully",

        // errors about a process of modification storing
        'submit' => [
            'empty_field'   => "You need to fill in this field",
            'not_all'       => "You need to fill in all the necessary fields",
            'error_common'  => "Something went wrong during saving of the modification",
        ], // submit


        // name and description
        'name' => [
            'label'         => "Modification name",
            'put_here'      => "put a name here",
            'error' => [
                'empty'     => "You need to fill in this field.",
                'type'      => "The name must be a string.",
                'min'       => "The name must be at least :nameMinSize characters.",
                'max'       => "The name must be maximum :nameMaxSize characters.",
                'unique'    => "The name must be unique. Please, choose an another one",
            ],
        ],
        'description' => [
            'label'         => "Description",
            'put_here'      => "put here a description of the modification",
            'error' => [
                'empty'     => "You need to fill in this field.",
                'type'      => "The description must be a string.",
                'min'       => "The description must be at least :nameMinSize characters.",
                'max'       => "The description must be maximum :nameMaxSize characters.",
            ],
        ],

        'presentation' => [
            'label'         => "Presentation",
            'put_here'      => "put here a presentation of the modification",
            'error' => [
                'empty'     => "You need to fill in this field.",
                'type'      => "The presentation must be a string.",
                'min'       => "The presentation must be at least :nameMinSize characters.",
                'max'       => "The presentation must be maximum :nameMaxSize characters.",
            ],
        ],

        // images
        'images' => [
            'both' => [
                'error' => [
                    'empty'     => "You must upload both a main image and screenshots",
                    'type'      => "The images must be files of type: jpg, jpeg, png, bmp, gif, svg, webp.",
                    'common'    => "Something went wrong during saving of the both fields",
                ],
            ],
            'main_image' => [
                'label' => "Main image (only one file)",
                'error' => [
                    'range'     => "You need to upload only one main image",
                    'common'    => "The main image failed to upload (kek).",
                    'type'      => "The main image must be a file of type: jpg, jpeg, png, bmp, gif, svg, webp.",

                    'max'       => "The main image must be size less than :imageMaxSize",
                ],
            ],
            'screenshots' => [
                'label' => "Screenshots (from 3 to 10 files)",
                'error' => [
                    'empty'     => "You need to upload several screenshots",
                    'common'    => "The screenshot failed to upload.",
                    'type'      => "The screenshots must be files of type: jpg, jpeg, png, bmp, gif, svg, webp.",
                    'range'     => "You must upload from 3 to 10 screenshots",
                    'max'       => "The main image must be size less than :imageMaxSize",
                ],
            ],
        ],  // images

        // YouTube video link
        'video_link' => [
            'label'     => [
                'trailer' => 'Link to a trailer video on YouTube',
                'review'  => 'Link to a review video on YouTube',
            ],
            'put_here'  => 'put here your link to a video about this modification',
            'error' => [
                'empty'     => "You need to fill in this field",
                'invalid'   => "The video link format is invalid.",
                'get_id'    => "Can't get a YouTube video id",
                'unique'    => "Such a video is already exists on the site",
            ],
        ], // video_link

        // choosing of the base game version
        'game_version' => [
            'label' => "Choose a base game version",
            'menu_options' => [
                'default'   => "game version",
                'soc'       => "Shadow of Chernobyl",
                'cs'        => "Clear Sky",
                'cop'       => "Call of Pripyat",
                'hoc'       => "Heart of Chernobyl",
            ],
            'error' => [
                'invalid'   => "Chosen game version is incorrect",
            ],
        ], // game_version

        // download sources
        'download_links' => [
            'label' => "Sources to download this modification",
            'put_here' => "put here a link to :source",
            'menu_options' => [
                'default'   => "add source",
            ],
            'error' => [
                'common' => [
                    'empty' => "You must set at least one download source",
                ],
                'invalid_link' => 'The link to :source is invalid',
            ],
        ], // download links

        // tags
        'tags' => [
            'label' => "Tags of the modification",
            'put_here' => "put modification tags here",
            'error' => [
                'type' => "Tag must be a string format",
            ],
        ], // tags

        // social links
        'social_links' => [
            'label' => "Developers social links",
            'menu_options' => [
                'default' => "Add a link to social",
            ],
            'put_here' => "put here a link to developer in",
            'error' => [

            ],
        ], // social_links
    ], // create

    // ---------------- translations for the editing page ----------------------------------
    'edit' => [
        'success_updating' => "The modification was successfully updated",
        'failed_updating'  => "Something went wrong during the modification updating",
        'images' => [
            'main_image'  => 'Current main image:',
            'screenshots' => 'Current screenshots:',
        ], // images
    ], // edit
];

?>