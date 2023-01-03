{{-- MOD MUTATORS (SETTERS) --}}

<div class="drop-down-list sub-list">
    <h3 class="title">Мутатори (сеттери, mutators/setters):</h3>

    <div class="drop-down-list-content hide">

        <ul>
            <li>
                <span class="variable-name">setNameAttribute (string)</span><br>
                Встановити ім'я модифікації.<br>
                <span class="file-name">Примітка</span>
                : Якщо slug модифікації, поки, не був встановлений, то він ініціалізується
                на основі даного імені (name).
            </li>
            <li>
                <span class="variable-name">setSlugAttribute (string)</span><br>
                Встановити slug модифікації.
            </li>
            <li>
                <span class="variable-name">setAuthorAttribute (User)</span><br>
                Встановити автора модифікації.
            </li>
            <li>
                <span class="variable-name">setGuideAttribute (Post)</span><br>
                Встановити гайд модифікації.
            </li>
            <li>
                <span class="variable-name">setModReviewsAttribute (ModReview)</span><br>
                Встановити рев'ю (відгук) модифікації.
                Модифікація може мати кілька відгуків.
            </li>
            <li>
                <span class="variable-name">setDownloadLinksAttribute</span><br>
                Встановити посилання (джерела) для завантаження модифікації.
                Наприклад, з Google Drive, і тому подібного.
            </li>
            <li>
                <span class="variable-name">setCustomLinksAttribute</span><br>
                Встановити посилання на сторінку (сторінки) новин про модифікацію.
            </li>
            <li>
                <span class="variable-name">setSocietyLinksAttribute</span><br>
                Встановити посилання на соціальні мережі розробників модифікації.
            </li>
            <li>
                <span class="variable-name">setTagsAttribute</span><br>
                Встановити теги, що будуть стосуватися даної модифікації.
            </li>
            <br>

            <h4>Мутатори для встановлення відео-атрибутів: </h4>
            <li>
                <span class="variable-name">setTrailerVideoIdAttribute</span><br>
                Встановити id відео-трейлера з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">setTrailerVideoPreviewImageAttribute</span><br>
                Встановити зображення-прев'ю відео-трейлера з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">setReviewVideoIdAttribute</span><br>
                Встановити id відео-рев'ю з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">setReviewVideoPreviewImageAttribute</span><br>
                Встановити зображення-прев'ю відео-рев'ю з YouTube до модифікації.
            </li>
            <li>
                <span class="variable-name">setGalleryVideoAttribute</span><br>
                Встановити галерейне відео.
            </li>
            <li>
                <span class="variable-name">setGalleryVideoImageAttribute</span><br>
                Встановити прев'ю до галерейного відео.
            </li>
            <br>

            <h4>Мутатори для встановлення зображень-атрибутів: </h4>
            <li>
                <span class="variable-name">setMainImageAttribute</span><br>
                Встановити головне зображення модифікації.
            </li>
            <li>
                <span class="variable-name">setScreenshotsAttribute</span><br>
                Встановити скріншоти модифікації.
            </li>
            <li>
                <span class="variable-name">setBoxartImageAttribute</span><br>
                Встановити boxart-зображення.
            </li>
            <li>
                <span class="variable-name">setBackgroundImageAttribute</span><br>
                Встановити фонове зображення.
            </li>
        </ul>

    </div> {{-- menu content --}}
</div> {{-- menu --}}
