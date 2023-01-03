@extends('documentation.base')

@section('content')
    <h1>
        ModsTest: перевірка моделі
        <a href="{{ route('documentation.show', ['path' => 'models.mod']) }}" class="file-name">
            Mod
        </a>
    </h1>
    <p>
        Перевіряємо коректність поведінки модифікацій: відношень/геттерів/сеттерів.<br>
        Будь-яка фіча цієї моделі (в тестах), будь то гайд, теги чи головне зображення --
        генеруються за допомогою факторі (ModFactory) та її внутрішніх функцій,
        якими налаштовується генерована модель модифікацій.<br>
        Детальніше про
        <a href="{{ route('documentation.show', ['path' => 'factory.mod-factory']) }}">
            ModFactory
        </a>

    </p>
    <br><br><hr>

    {{-------------------------------- USE -----------------------------------}}
    <div>
        <h2>USE:</h2>
        <span class="function-name">use RefreshDatabase</span><br>
        <p>
            Використовується для того щоб кожного разу,
            перед запуском тестів у цьому файлі,
            виконувати операцію refresh над бд.
        </p>
    </div>
    <br><br><hr>

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

    {{-------------------------------- COMMON TESTS  ----------------------------------}}
    <div class="drop-down-list">
        <h2 class="title">Загальні тести:</h2>

        <div class="drop-down-list-content hide">
            <ul>
                <li>
                    <span class="function-name">test_make_some_preparations_for_tests()</span>
                    <p>
                        Не є тестом сама по собі, просто генерує рандомне зображення та
                        записує його у приватну змінну
                        <span class="variable-name">$defaultTestImageFile</span>
                    </p>
                </li>

                <li>
                    <span class="function-name">test_mod_can_be_created()</span>
                    <p>
                        Перевірка можливості створення базового об'єкта Mod.
                    </p>
                </li>
            </ul>

        </div>
    </div>
    <br><br><hr>


    {{---------------------------- TEST ATTRIBUTES  ---------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_attributes')


    {{------------------------------- UTILS -----------------------------------}}
    <div>
        <h2>Утиліти (utils):</h2>

        <ul>
            <li>
                <span class="function-name">test_clean_mods_images_dir</span>
                <p>
                    Не є тестом сама по собі, але викликається як тест, адже
                    після виконання усіх, вище перерахованих, тестів, необхідно
                    очистити тимчасову папку із тестовими зображенням.
                </p>
            </li>
        </ul>
        <br><br><hr>
    </div>
@endsection