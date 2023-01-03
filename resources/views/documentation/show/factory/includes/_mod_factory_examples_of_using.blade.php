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
                <span class="function-name">$mod0 = Mod::factory()->getModel();</span>
                <p>
                    За допомогою такої конструкції ми можемо отримати
                    тестову базову версію об'єкта класу Mod.
                    Функція <span class="variable-name">getModel()</span>
                    повертає нам безпосередньо об'єкт Mod.
                    В такого об'єкта немає ніяких зв'язків (relations) з іншими моделями. <br>
                    Ініціалізовані лише ті атрибути, які є репрезентацією табличних полів,
                    наприклад: ім'я, slug, опис, базова версія гри і тд.
                </p>
            </li>

            <li>
                <span class="function-name">$mod1 = Mod::factory()->hasAuthor()->getModel();</span>
                <p>
                    Функція <span class="variable-name">hasAuthor()</span>, в ланцюжку
                    викликів, вказує для факторі, що новостворений об'єкт повинен мати
                    автора (зв'язок з моделлю User). Такий автор рандомно генерується під час виклику функції
                    <span class="variable-name">getModel()</span>.
                </p>
            </li>

            <li>
                <span class="function-name">$mod2 = Mod::factory()->hasAuthor()->hasGuide()->getModel();</span>
                <p>
                    Тепер об'єкт буде мати автора та гайд.
                </p>
            </li>

            <li>
                    <span class="function-name">$mod3 = Mod::factory()<br>
                        ->hasAuthor()<br>
                        ->hasGuide()<br>
                        ->hasModReviews(2)<br>
                        ->hasTrailerVideo()<br>
                        ->hasReviewVideo()<br>
                        ->hasTags()<br>
                        ->hasMainImage()<br>
                        ->hasScreenshots()<br>
                        ->hasBoxartImage()<br>
                        ->hasBackgroundImage()<br>
                        ->getModel();
                    </span>
                <p>
                    Тепер об'єкт буде мати такі штуки:
                    автора, гайд, два рев'ю (огляди), відео-трейлер, відео-рев'ю,
                    теги, головне зображення, скріншоти, boxart-зображення та фонове зображення.<br>
                    Тобто такий об'єкт буде "повністю укомлектованим".
                </p>
            </li>
        </ol>

        <h4>Хелпери:</h4>
        <ol>
            <li>
                <span class="function-name">Mod::factory()->getFakeImagesPathsList()</span>
                <p>
                    Повертає <span class="variable-name">array</span>
                    шляхів (string) до фейкових зображень модифікацій (головні зображення).
                </p>
            </li>

            <li>
                <span class="function-name">Mod::factory()->getRandImageFile()</span>
                <p>
                    Повертає <span class="variable-name">Illuminate\Http\File</span>
                    об'єкт із рандомним фейковим зображенням
                    модифікації (одне з головних зображень).
                </p>
            </li>
        </ol>

        <br><br><hr>
    </div>
</div>
