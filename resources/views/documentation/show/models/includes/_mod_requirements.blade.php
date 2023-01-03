{{----------------- REQUIREMENTS -----------------}}
<div class="drop-down-list">
    <h2 class="title">ВИМОГИ</h2>
    <div class="drop-down-list-content hide">
        <div class="description">
            <h2>До кожної модифікації ставляться певні вимоги, зокрема модифікація ПОВИННА мати:</h2>
        </div>
        <ul>
            <li>
                <span class="variable-name">Ім'я (name)</span>
                <br>
                <img src="{{ asset($pathToImages . "name.png") }}" alt="name">
            </li>

            <li>
                <span class="variable-name">Опис (description)</span>
                <br>
                <img src="{{ asset($pathToImages . "description.png") }}" alt="description">
            </li>

            <li>
                    <span class="variable-name">
                        Головне зображення (main image)
                    </span>
                <br>
                Буде використовуватись всюди в якості репрезентації даного моду, тобто в
                якості всяких піктограмок і тд.
                <br>
                <img src="{{ asset($pathToImages . "main_image.png") }}" alt="main_image">
            </li>
            <li>
                    <span class="variable-name">
                        Скріншоти (мінімум 3 штуки, screenshots)
                    </span>
                <br>
                Скріншоти процесу геймплею даної модифікації
                <br>
                <img src="{{ asset($pathToImages . "screenshots.png") }}" alt="name">
                <br>
                <img src="{{ asset($pathToImages . "screenshots_2.png") }}" alt="name">
            </li>

            <li>
                <span class="variable-name">Автор модифікації (author)</span>
                <br>
                Посилання на сторіку (на нашому сайті) творця (творців) даної модифікації.
                Саме по собі є просто нікнеймом такого користувача.
            </li>

            <li>
                    <span class="variable-name">
                        Версія базової гри (на основі якої будувалась модифікація) (game)
                    </span>
                <br>
                Тобто вибір з: Тінь Чорнобиля, Чисте Небо, Поклик Прип'яті, та
                нової S.T.A.L.K.E.R. 2 (якщо там можна буде робити моди)
                <br>
                <img src="{{ asset($pathToImages . "game_version.png") }}" alt="game_version">
            </li>

            <li>
                    <span class="variable-name">
                        Посилання для завантаження (1 чи більше) (download_links)
                    </span>
                <br>
                Творець модифікації повинен сам завантажити свій мод на якусь хмару,
                і сюди просто закинути посилання, наприклад, на Google Drive.
                <br>
                <img src="{{ asset($pathToImages . "download.png") }}" alt="download">
            </li>

            <li>
                    <span class="variable-name">
                        Посилання на сторінку з новинами про модифікацію
                        (оновлення, баг-фікси, і тд.) (custom_links)
                    </span>
                Сторінка, де творець модифікації може розповісти про
                процес розробки та покращення своєї модифікації.
                Що там додалося нового, які речі виправили чи видалили.
                Щось у тому роді.
                <br>
                <img src="{{ asset($pathToImages . "change_log.png") }}" alt="changelog">
            </li>

            <li>
                    <span class="variable-name">
                        Посилання на соц мережі розробників (society_links)
                    </span>
                <br>
                Для можливості, при потребі, зв'язатися з цими розробниками.
            </li>
        </ul>

        <hr><br><br>
    </div>
</div>
