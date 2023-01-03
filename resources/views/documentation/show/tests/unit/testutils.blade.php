@extends('documentation.base')

@section('content')
    <h1>Unit-тести: файл
        <span class="file-name">Unit/TestUtils.php</span>
    </h1>
    Допоміжний функціонал для роботи з юніт-тестами
    <div>
        <p>Функції:</p>
        {{--- cleanTempDir() ---}}
        <ul>
            <li>
                <span class="function-name">cleanTempDir()</span>: очищує тимчасовий каталог <b>/storage/temp/`</b>
            </li>
            <p>
                Аргументи: <span class="variable-name">void</span><br/>
                Повертає: <span class="variable-name">bool -- результат очищення</span><br/>
                Опис: деякі тести використовують цей тимчасовий каталог, для розміщення тестових файлів;
                операцію слід виконувати після виконання усіх тестів, розміщених у поточному php-файлі;
            </p>

            {{--- createNewTestFile() ---}}
            <li>
                <span class="function-name">createNewTestFile()</span>: створення тимчасового файлового об'єкту
            </li>
            <p>
                Аргументи: <span class="variable-name">$filename - ім'я для файлу; $extension - його розширення </span><br/>
                Повертає: <span class="variable-name">Illuminate\Http\File об'єкт</span><br/>
                Опис: цей файл буде розташовано в тимчасовому каталозі <b>/storage/temp/`</b>
            </p>
        </ul>
    </div>
@endsection