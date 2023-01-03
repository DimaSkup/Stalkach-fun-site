{{----------------- OPTIONAL -----------------}}
<div class="drop-down-list">
    <h2 class="title">ОПЦІОНАЛЬНО</h2>
    <div class="drop-down-list-content hide">
        <div class="description">
            <h2>ОПЦІОНАЛЬНО модифікація може мати:</h2>
        </div>

        {{-- GALLERY VIDEO --}}
        <ul>
            <li>
                <span class="variable-name">Галерейне відео (gallery video)</span>
                <br>
                Якщо таке відео встановлено,
                то воно буде відображатися в якості хедера на сторінці однієї модифікації
                (замість фонового зображення), відразу ж
                після завантаження (чи перезавантаження) даної сторінки.
                Умовно повинне містити уривок геймплею
                даної модифікації.
                <br><br>
                <img src="{{ asset($pathToImages . "gallery_video.png") }}" alt="gallery_video_img">
            </li>
        </ul>

        {{-- BOXART IMAGE --}}
        <ul>
            <li>
                <span class="variable-name">"Бокс-арт" зображення (boxart image)</span>
                <br>
                Відображається в слайдері модифікацій,
                на головній сторінці модифікацій (там де список усіх модів)
                <br><br>
                <img src="{{ asset($pathToImages . "boxart_image.png") }}" alt="boxart_image_img">
            </li>
        </ul>

        {{-- BACKGROUND IMAGE --}}
        <ul>
            <li>
                <span class="variable-name">Фонове зображення (background image)</span>
                <br>
                Якщо встановлено,
                то воно буде відображатися в якості хедера
                на сторінці однієї модифікації (замість галерейного відео), відразу ж
                після завантаження (чи перезавантаження) даної сторінки.
                Умовно може містити скрін геймплею даної модифікації або просто якесь
                інше придатне до репрезентації зображення.
                <br><br>
                <img src="{{ asset($pathToImages . "background_image.png") }}" alt="background_image_screen">
            </li>
        </ul>

        {{-- TRAILER VIDEO --}}
        <ul>
            <li>
                <span class="variable-name">Трейлер-відео модифікації (trailer video)</span>
                <br>
                В даної моделі є поле trailer_video_id (в таблиці)
                з ідентифікатором відео-трейлера з YouTube.
                Ідентифікатор формується за допомогою сервісу YouTubeVideoService та
                передається в чистому вигляду до мутатора (сеттера) даного поля.
                Відповідно за допомогою аксессорів (геттерів) ми отримуємо вже сформоване
                посилання на дане відео, і це посилання вже можна ліпити в шаблон сторінки.
                <br><br>
                <img src="{{ asset($pathToImages . "trailer_video.png") }}" alt="trailer_video">
            </li>
        </ul>

        {{-- REVIEW VIDEO --}}
        <ul>
            <li>
                <span class="variable-name">Рев'ю-відео модифікації (review video)</span>
                <br>
                Все аналогічно як і для trailer video, але з тією відмінністю що працюємо
                з полем review_video_id в таблиці моделі.
                <br><br>
                <img src="{{ asset($pathToImages . "review_video.png") }}" alt="review_video">
            </li>
        </ul>

        {{-- MOD REVIEW --}}
        <ul>
            <li>
                <span class="variable-name">Рев'ю на модифікацію (mod review)</span>
                <br>
                Користувач може написати власний огляд-відгук з коментарем на модифікацію
                (review, на скріні виділено червоним)
                та задати для даної модифікації оцінку (mod rating, на скріні виділено зеленим).
                <br>
                Такий огляд, в сутності, являє собою коментар до модифікації.
                <br><br>
                <img src="{{ asset($pathToImages . "mod_review.png") }}" width="320" alt="mod_review">
            </li>

        </ul>
        <hr><br><br>
    </div>
</div>
