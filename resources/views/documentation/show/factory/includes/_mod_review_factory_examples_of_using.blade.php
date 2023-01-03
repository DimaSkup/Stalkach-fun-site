{{------------------------------ EXAMPLES OF USING --------------------------------}}

<div class="drop-down-list">
    <h3 class="title">Приклади використання:</h3>

    <div class="drop-down-list-content hide">
        <p>
            Дана факторі викликається через
            <span class="variable-name">Mod::factory()</span>, а далі
            ми можемо за допомогою ланцюжка викликів функцій, налаштовувати сам об'єкт
            та отримати його.
        </p>
        <br><br>

        <h4>Створення моделі:</h4>
        <ol>
            <li>
                <span class="function-name">$modReview1 = ModReview::factory()<br>
                    ->hasAuthor()<br>
                    ->hasMod()<br>
                    ->hasModRating()<br>
                    ->getModel();
                </span>
                <p>
                    За допомогою такої конструкції ми можемо отримати
                    екземпляр ModReview
                    <span class="variable-name">
                        разом із рандомно згенерованими відношеннями (relations)
                    </span>
                    , тобто створюються:
                    новий автор (User), модифікація (Mod), рейтинг модифікації (ModRating).
                </p>
            </li>

            <li>
                <span class="function-name">$modReview2 = ModReview::factory()<br>
                    ->hasAuthor($user->id)<br>
                    ->hasMod($mod->id)<br>
                    ->hasModRating($modRating->id)<br>
                    ->getModel();
                </span>
                <p>
                    За допомогою такої конструкції ми можемо отримати
                    екземпляр ModReview разом із конкретно заданими відношеннями
                    <span class="variable-name">
                        до вже існуючих: автора (User), модифікації (Mod) та
                        рейтингу модифікації (ModRating).
                    </span>
                    Це виконується через передачу id об'єктів до відповідних функцій.
                </p>
            </li>


        </ol>
        <br><br><hr>
    </div>
</div>
