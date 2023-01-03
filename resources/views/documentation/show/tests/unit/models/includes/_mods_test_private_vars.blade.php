{{---------------------------- PRIVATE TEST VARIABLES -----------------------------}}

<div>
    <h2>Приватні змінні:</h2>
    <ul>
        <li>
            <span class="function-name">string $testTrailerVideoLink</span><br>
            <p>
                Тестове посилання на відео-трейлер в YouTube
            </p>
        </li>

        <li>
            <span class="function-name">string $testReviewVideoLink</span><br>
            <p>
                Тестове посилання на відео-рев'ю (огляд) в YouTube
            </p>
        </li>

        <li>
            <span class="function-name">File $defaultTestImageFile</span><br>
            <p>
                Тестовий об'єкт класу
                <span class="variable-name">Illuminate\Http\File</span>.
                В цю змінну записується рандомне зображення, яке генерується через
                Mod::factory(). Це робиться в оптимізаційних цілях -- щоб кожен раз
                не генерувати нове зображення, бо це затратно.
            </p>
        </li>
    </ul>
</div>
<br><br><hr>