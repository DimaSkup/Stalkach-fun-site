{{----------------------------------- VARIABLES -----------------------------------}}


<div class="drop-down-list">
    <h3 class="title">Приватні/захищені змінні:</h3>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">protected $model</span>
                <p>
                    Через цю змінну ми вказуємо до якої моделі відносить ця факторі.
                    В даному випадку -- до моделі Mod.
                </p>
            </li>

            <li>
                <span class="function-name">string $defaultTrailerVideoLink</span>
                <p>
                    Дефолтне посилання на відео-трейлер.
                    Якщо ми не передаємо власний параметр до функції
                    <span class="variable-name">hasTrailerVideo()</span>
                    , то в якості посилання на трейлер буде юзатись значення із змінної
                    <span class="variable-name">$defaultTrailerVideoLink</span>
                </p>
            </li>

            <li>
                <span class="function-name">string $defaultReviewVideoLink</span>
                <p>
                    Аналогічно до <span class="variable-name">$defaultTrailerVideoLink</span>,
                    тільки це відео-рев'ю.
                </p>
            </li>
        </ul>

        <br><br><hr>
    </div>
</div>