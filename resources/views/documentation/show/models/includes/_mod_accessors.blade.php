{{-- MOD ACCESSORS (GETTERS) --}}

<div class="drop-down-list sub-list">
    <h3 class="title">Аксессори (геттери, accessors/getters):</h3>

    <div class="drop-down-list-content hide">

        <ul>
            <li>
                <span class="variable-name">getUrlAttribute</span><br>
                Генерує та повертає url на сторінку даної модифікації
            </li>
            <li>
                <span class="variable-name">getDownloadLinksAttribute</span><br>
                Повертає масив посилань для завантажування модифікації.
            </li>
            <li>
                <span class="variable-name">getCustomLinksAttribute</span><br>
                Повертає масив посилань на сторінки (чи сторінку) з новинами про модифікацію.
            </li>
            <li>
                <span class="variable-name">getSocietyLinksAttribute</span><br>
                Повертає масив посилань на соціальні мережі розробників модифікації.
            </li>
            <li>
                <span class="variable-name">getTagsNamesStringAttribute</span><br>
                Повертає рядок в якому, через пробіл, записані імена усіх тегів, що прикріплені
                до даної модифікації.
            </li>
            <br>

            <h4>Геттери для отримання об'єктів, що відносяться (has relations) до моду: </h4>
            <li>
                <span class="variable-name">getAuthorAttribute</span><br>
                Повертає об'єкт User автора модифікації.
            </li>
            <li>
                <span class="variable-name">getModReviewsAttribute</span><br>
                Повертає масив об'єктів ModReview (огляди-рев'ю даної модифікації)
            </li>
            <li>
                <span class="variable-name">getGuideAttribute</span><br>
                Повертає об'єкт Post, який є гайдом до даної модифікації.
            </li>
            <br>

            <h4>Геттери для отримання відео-атрибутів: </h4>
            <li>
                <span class="variable-name">getTrailerVideoIdAttribute</span><br>
                Отримати id відео-трейлера з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">getReviewVideoIdAttribute</span><br>
                Отримати id відео-рев'ю з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">getTrailerVideoUrlAttribute</span><br>
                Отримати посилання на відео-трейлер з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">getReviewVideoUrlAttribute</span><br>
                Отримати посилання на відео-рев'ю з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">getGalleryVideoUrlAttribute</span><br>
                Отримати посилання на галерейне відео (gallery video) до модифікації.
            </li>
            <br>

            <h4>Геттери для отримання зображень-атрибутів: </h4>
            <li>
                <span class="variable-name">getMainImageAttribute</span><br>
                Отримати посилання на головне зображення.
            </li>
            <li>
                <span class="variable-name">getScreenshotsAttribute</span><br>
                Отримати масив посилання на зображення скріншотів.
            </li>
            <li>
                <span class="variable-name">getTrailerVideoPreviewImageAttribute</span><br>
                Отримати посилання на зображення-прев'ю відео-трейлера з YouTube.
            </li>
            <li>
                <span class="variable-name">getReviewVideoPreviewImageAttribute</span><br>
                Отримати посилання на зображення-прев'ю відео-рев'ю з YouTube.
            </li>
            <li>
                <span class="variable-name">getBoxartImageAttribute</span><br>
                Отримати посилання на boxart-зображення.
            </li>
            <li>
                <span class="variable-name">getBackgroundImageAttribute</span><br>
                Отримати посилання на background-зображення
            </li>
            <li>
                <span class="variable-name">getGalleryVideoImageAttribute</span><br>
                Отримати посилання на зображення-прев'ю галерейного відео.
            </li>
            <li>
                <span class="variable-name">getPathToImagesDir</span><br>
                Отримати storage-шлях до каталогу, де розташовуються усі зображення усіх модифікацій.
            </li>
        </ul>
        <br><br>

    </div> {{-- menu content --}}
</div> {{-- menu --}}
