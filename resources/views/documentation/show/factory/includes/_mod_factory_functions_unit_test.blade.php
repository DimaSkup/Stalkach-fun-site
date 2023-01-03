<div class="drop-down-list">
    <h3 class="title">Функції для unit-тестів:</h3>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">getModel(): Mod</span>
                <p>
                Повертає сконфігурований об'єкт класу Mod.

                <h4>Опис нутрощів функції:</h4>
                Виклик
                <span class="variable-name">
                        $modFactoryHelper = new ModFactoryHelper($this->make())
                    </span>
                ініціалізує допоміжний об'єкт хелпера, через який ми налаштуємо об'єкт Mod.
                Це необхідно для того щоб ми могли використовувати функцію
                <span class="variable-name">getModel()</span>
                напряму через виклик конструкції<br>
                <span class="variable-name">
                        Mod::factory()->getModel()
                    </span>.<br>
                Параметр конструктора
                <span class="variable-name">$this->make()</span>
                створює базовий об'єкт Mod (але не записує його в бд).
            </li>

            <li>
                <span class="function-name">has-функції:</span>
                <p>
                    Функція з префіксом has -- задає конфігурацію об'єкта Mod.
                    А точніше наявність (при виклику) чи відсутність (не викликаємо таку функцію)
                    певних зовнішніх зв'язків (relations).
                    <br>
                    В класі <span class="variable-name">ModFactoryHelper</span> існує масив
                    значень-прапорців для конфігурації. По цих прапорцях
                    при виклику функції <span class="variable-name">getModel()</span> і налаштовується
                    об'єкт моделі.
                    <br>
                    Таким чином кожна has-функція лише викликає внутрішні допоміжні функції для
                    задання конфігурації.<br>
                    Наприклад:
                    <span class="variable-name">
                        hasAuthor() => $this->setModConfig() => ModFactoryHelper::setModConfig()
                    </span>
                </p>
            </li>

            <li>
                <span class="function-name">hasAuthor(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати рандомного автора (model User).
                </p>
            </li>

            <li>
                <span class="function-name">hasGuide(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати гайд (model Post).
                </p>
            </li>

            <li>
                <span class="function-name">hasModReviews(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати огляд-рев'ю (model ModReview).
                </p>
            </li>

            <li>
                <span class="function-name">hasTrailerVideo(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати відео-трейлер (з YouTube).
                </p>
            </li>

            <li>
                <span class="function-name">hasReviewVideo(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати відео-рев'ю (з YouTube).
                </p>
            </li>

            <li>
                <span class="function-name">hasTags(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати теги (model Tag).
                </p>
            </li>

            <li>
                <span class="function-name">hasMainImage(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати головне зображення.
                </p>
            </li>

            <li>
                <span class="function-name">hasScreenshots(int $screenshotsNumber = 3): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати вказану в аргументі кількість скріншотів.
                </p>
            </li>

            <li>
                <span class="function-name">hasBoxartImage(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати boxart-зображення.
                </p>
            </li>

            <li>
                <span class="function-name">hasBackgroundImage(): ModFactory</span>
                <p>
                    Вказує для факторі, що дана модифікація повинна
                    мати фонове-зображення.
                </p>
            </li>

            <br><br>
            <h4>Хелпери:</h4>
            <li>
                <span class="function-name">setModConfig(string $key, mixed $value): void</span>
                <p>
                    Є проміжною функцією між has-функціями та ModFactoryHelper.<br>
                    Задає параметри для конфігурування об'єкта класу Mod, який повертає
                    функція <span class="variable-name">getModel()</span>
                </p>
            </li>
        </ul>
        <br><br><hr>
    </div>
</div>