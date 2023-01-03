<?php
// lang/ua/modification.php

return [
    // -------------- головна сторінка МОДИФІКЦІЙ (сторінка зі списком модів) -------------
    'index' => [
        'latest' => "останні модифікації",
        'in_tags' => "в тегах:",
        'read_more' => "Читати більше",
    ], // index


    // -------------- сторінка створення модифікацій --------------------------------------
    'create' => [
        // загальні
        'caption'           => "Створення нової модифікації",
        'create_button'     => 'Створити',
        'success_creation'  => "Модифікація була успішно створена",

        // помилки щодо процесу збереження модифікації
        'submit' => [
            'empty_field'   => "Вам необхідно заповнити це поле",
            'not_all'       => "Вам потрібно заповнити всі необхідні поля",
            'error_common'  => "Під час збереження модифікації сталася якась помилка",
        ], // submit


        // назва, опис, презентація
        'name'          => [
            'label'         => "Назва модифікації",
            'put_here'      => "напишіть тут назву модифікації",
            'error' => [
                'empty'     => "Вам необхідно заповнити це поле",
                'type'      => "Назва повинна бути рядком",
                'min'       => "Назва повинна складатися мінімум з :nameMinSize символів.",
                'max'       => "Назва повинна складатися максимум з :nameMaxSize символів.",
                'unique'    => "Назва повинна бути унікальною. Будь ласка оберіть інакшу",
            ],
        ],

        'description'          => [
            'label'         => "Опис",
            'put_here'      => "напишіть тут опис модифікації",
            'error' => [
                'empty'     => "Вам необхідно заповнити це поле",
                'type'      => "Опис повинен бути рядком",
                'min'       => "Опис повинен складатися мінімум з :descMinSize символів.",
                'max'       => "Опис повинен складатися максимум з :descMaxSize символів.",
            ],
        ],

        'presentation' => [
            'label'         => "Презентація",
            'put_here'      => "напишіть тут текст для презентація даної модифікації",
            'error' => [
                'empty'     => "Вам необхідно заповнити це поле",
                'type'      => "Презентація повинна бути рядком",
                'min'       => "Презентація повинна складатися мінімум з :presentationMinSize символів.",
                'max'       => "Презентація повинна складатися максимум з :presentationMaxSize символів.",
            ],
        ],

        // зображення
        // images
        'images' => [
            'both' => [
                'error' => [
                    'empty'     => "Вам необхідно одночасно завантажити і головне зображення, і скріншоти",
                    'type'      => "Зображення повинні бути файлами у форматі: jpg, jpeg, png, bmp, gif, svg, webp.",
                    'common'    => "Щось пішло не так під час збереження зображень",
                ],
            ],
            'main_image' => [
                'label' => "Головне зображення (лише один файл)",
                'error' => [
                    'common'    => "Помилка завантаження головного зображення.",
                    'type'      => "Головне зображення повинне бути файлом у форматі: jpg, jpeg, png, bmp, gif, svg, webp.",
                    'range'     => "Вам потрібно завантажити лише одне головне зображення",
                    'max'       => "Перевищено допустимий розмір зображення. Зображення повинне бути розміром меншим ніж :imageMaxSize",
                ],
            ],
            'screenshots' => [
                'label' => "Скріншоти (від 3 до 10 файлів)",
                'error' => [
                    'empty'     => "Вам необхідно завантажити кілька скріншотів",
                    'common'    => "Помилка завантаження скріншотів",
                    'type'      => "Скріншоти повиненні бути файлами у форматі: jpg, jpeg, png, bmp, gif, svg, webp.",
                    'range'     => "Вам необхідно завантажити від 3 до 10 зображень",
                    'max'       => "Перевищено допустимий розмір зображення. Зображення повинне бути розміром меншим ніж :imageMaxSize",
                ],
            ],
        ],  // images

        // посилання на відео в YouTube
        'video_link' => [
            'label'     => 'Посилання на відео в YouTube',
            'put_here'  => 'напишіть тут посилання на відео про модифікцію',
            'error' => [
                'empty'     => "Вам необхідно заповнити поле з посиланням на відео",
                'invalid'   => "Ваше посилання на відео є некоректним",
                'get_id'    => "Помилка отримання ідентифікатора відео",
                'unique'    => "Таке відео вже є на сайті",
            ],
        ], // video_link

        // вибір версії гри на основі якої побудовано модифікацію
        'game_version' => [
            'label' => "Оберіть базову версію гри",
            'menu_options' => [
                'default'   => "версія гри",
                'soc'       => "Тінь Чорнобиля",
                'cs'        => "Чисте Небо",
                'cop'       => "Поклик Прип'яті",
                'hoc'       => "Серце Чорнобиля",
            ],
            'error' => [
                'invalid'   => "Обрана версія гри є некоректною",
            ],
        ], // game_version

        // посилання для завантаження
        'download_links' => [
            'label' => "Посилання для завантаження модифікації",
            'put_here' => "напишіть тут посилання на",
            'menu_options' => [
                'default'   => "додати джерело",
                'google'    => "Гугл диск",
                'yandex'    => "Яндекс диск",
                'mail'      => "Mail диск",
            ],
            'error' => [
                'common' => [
                    'empty' => "Вам потрібно вказати хоча б одне посилання",
                ],
                'google' => [
                    'url' => 'Посилання на Гугл диск є некоректним',
                ],
                'yandex' => [
                    'url' => 'Посилання на Яндекс диск є некоректним',
                ],
                'mail' => [
                    'url' => 'Посилання на Mail диск є некоректним',
                ],
            ],
        ], // download links

        // теги
        'tags' => [
            'label' => "Теги модифікації",
            'put_here' => "напишіть тут теги для модифікації",
            'error' => [
                'type' => "Теги повинні бути рядкового типу",
            ],
        ], // tags

        // social links
        'social_links' => [
            'label' => "Посилання на соціальні мережі розробників",
            'menu_options' => [
                'default' => "Додати посилання на соціальну мережу",
            ],
            'put_here' => "напишіть тут посилання на",
            'error' => [

            ],
        ], // social_links
    ], // create

    // ---------------- переклади для сторінки редагування --------------------------------
    'edit' => [
        'success_updating' => "Модифікація була успішно відредагована",
        'failed_updating'  => "Не вдалося оновити модифікацію",
        'images' => [
            'main_image'  => 'Поточне головне зображення:',
            'screenshots' => 'Поточні скріншоти:',
        ], // images
    ], // edit
];

?>