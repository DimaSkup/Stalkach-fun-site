{{------------------------ FUNCTIONS FOR UNIT TESTS -------------------------------}}

<div class="drop-down-list">
    <h3 class="title">Функції для юніт-тестів:</h3>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">getModel(): ModReview</span>
                <p>
                    Повертає сконфігурований об'єкт класу ModReview.
                    <br><br>
                    Опис роботи функції дивіться для аналогічної в
                    <a href="{{ route('documentation.show', ['path' => 'factory.mod-factory']) }}">
                        <span class="file-name">ModFactory</span>
                    </a>
                </p>
            </li>


            <li>
                <span class="function-name">has-функції:</span>
                <p>
                    Функція з префіксом has --
                    <span class="variable-name">задає конфігурацію об'єкта</span>
                    ModReview.
                    А точніше наявність (при виклику) чи відсутність (не викликаємо таку функцію)
                    певних зовнішніх зв'язків (relations).
                    <br>
                    В класі <span class="variable-name">ModReviewFactoryHelper</span> існує масив
                    значень-прапорців для конфігурації. По цих прапорцях,
                    при виклику функції <span class="variable-name">getModel()</span> і налаштовується
                    об'єкт моделі.
                    <br>
                    Таким чином кожна has-функція лише викликає внутрішні допоміжні функції для
                    задання конфігурації.<br>
                    Наприклад:
                    <span class="variable-name">
                        hasAuthor() => $this->setConfig() => ModReviewFactoryHelper::setConfig()
                    </span>
                </p>
            </li>

            <li>
                <span class="function-name">hasAuthor(int|bool $authorId = true): ModReviewFactory</span>
                <p>
                    Встановити зовнішній зв'язок із:<br>
                    -- новим рандомним автором ($authorId = true, чи параметр порожній)<br>
                    -- або зв'язок із конкретно заданим автором ($authorId = some_number).
                </p>
            </li>

            <li>
                <span class="function-name">hasMod(int|bool $modId = true): ModReviewFactory</span>
                <p>
                    Встановити зовнішній зв'язок із:<br>
                    -- новою рандомною модифікацією ($modId = true, чи параметр порожній)<br>
                    -- або зв'язок із конкретною модифікацією ($modId = some_number).
                </p>
            </li>

            <li>
                <span class="function-name">hasModRating(int|bool $modRatingId = true): ModReviewFactory</span>
                <p>
                    Встановити зовнішній зв'язок із:<br>
                    -- новим рандомним рейтингом модифікації ($modRatingId = true, чи параметр порожній)<br>
                    -- або зв'язок із конкретним рейтингом ($modRatingId = some_number).
                </p>
            </li>

            <li>
                <span class="function-name">setConfig(string $key, int|bool $value): void</span>
                <p>
                    Це ПРИВАТНА функція-хелпер для задання конфігурації створюваного об'єкта ModReview.
                    Вона є проміжною між has-функціями та функціоналом класу ModReviewFactoryHelper.
                </p>
            </li>

        </ul>
        <br><br><hr>
    </div>
</div>