<div class="drop-down-list">
    <h3 class="title">Загальні функції/хелпери:</h3>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">definition(): array</span>
                <p>
                    Задає дефолтні фейкові параметри для моделі. Деякі з них
                    генеруються рандомно, наприклад: ім'я, опис, базова версія гри і тд.
                </p>
            </li>
        </ul>

        <ul>
            <li>
                <span class="function-name">mod(Collection): Factory</span>
                <p>
                    За допомогою цієї функції ми можемо під себе налаштувати
                    атрибути моделі, що були задані функцією
                    <span class="variable-name">definition()</span>.
                    В якості параметра виступає колекція значень
                    <span class="variable-name">attribute_name => value</span>.
                </p>
            </li>
        </ul>

        <ul>
            <li>
                <span class="function-name">getFakeImagesPathsList(): array</span>
                <p>
                    Функція-хелпер, яка повертає <span class="variable-name">array</span>
                    шляхів (string) до фейкових зображень модифікацій (головні зображення).
                    Вона є посередником між тестом та допоміжним класом
                    <span class="variable-name">ModFactoryHelper</span>, який власне й
                    виконує всю роботу.
                </p>
            </li>

            <li>
                <span class="function-name">getRandImageFile(): File</span>
                <p>
                    Функція-хелпер, яка повертає
                    <span class="variable-name">Illuminate\Http\File</span>
                    об'єкт із рандомним фейковим зображенням
                    модифікації (одне з головних зображень).
                    Вона є посередником між тестом та допоміжним класом
                    <span class="variable-name">ModFactoryHelper</span>, який власне й
                    виконує всю роботу по генерації рандомного об'єкта-зображення.
                    <br><br>

                    <h4>Опис нутрощів функції:</h4>
                    Виклик
                    <span class="variable-name">
                        $modFactoryHelper = new ModFactoryHelper($this->make())
                    </span>
                    ініціалізує допоміжний об'єкт хелпера, через який ми згенеруємо
                    рандомне зображення.
                    Це необхідно для того щоб ми могли використовувати функцію
                    <span class="variable-name">getRandImageFile()</span>
                    напряму через виклик конструкції
                    <span class="variable-name">
                        Mod::factory()->getRandImageFile()
                    </span>.<br>
                    Параметр конструктора
                    <span class="variable-name">$this->make()</span>
                    створює базовий об'єкт Mod (але не записує його в бд).
                </p>
            </li>
        </ul>
        <br><br><hr>
    </div>
</div>