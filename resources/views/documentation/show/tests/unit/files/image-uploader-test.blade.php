@extends('documentation.base')

@section('content')
    <h1>Unit-тести: перевірка функціоналу роботи з завантажувача (uploader) зображень.</h1>

    <div>
        {{---------- VARIABLES LIST ----------}}
        <div>
            <h3>Список приватних змінних: </h3>
            <ul>
                <li>
                    <span class="function-name">string $linkToRemoteImage</span><br>
                    <p>
                        Посилання на зображення в інеті. Ми його використаємо для
                        тестування завантаження зображення через посилання.
                    </p>
                </li>
                <li>
                    <span class="function-name">string $tempFilesType</span><br>
                    <p>
                        Для задання типу файлу: "тимчасовий".
                    </p>
                </li>
            </ul>
        </div>
        <br><br><hr>



        {{---------- FUNCTIONS LIST ----------}}
        <div>
            <h3>Список функцій-тестів:</h3>

            <ul>
                <li>
                    <span class="function-name">test_upload_method_with_image_object()</span>
                    <p>
                        Тестуємо завантаження зображення через вхідний об'єкт
                        <span class="variable-name">UploadedFile</span>
                        , немовби ми отримали його (файл) від поля з веб-форми.
                    </p>
                </li>

                <li>
                    <span class="function-name">test_upload_method_with_link_to_image()</span>
                    <p>
                        Тестуємо завантаження зображення через вхідне посилання на зображення.
                        Таке посилання може вставлятися безпосередньо в поле веб-форми.
                    </p>
                </li>
            </ul>
        </div>


        {{------------------------------- UTILS ---------------------------------}}
        <div>
            <h3>Список функцій-утиліт (utils):</h3>

            <ul>
                <li>
                    <span class="function-name">test_clean_up_temporary_directory_from_temporal_files()</span>
                    <p>
                        Очистка тимчасового каталогу від тимчасових файлів.
                        <span class="file-name">Примітка</span>
                        : це не є саме по собі тестом, але повинне виконуватись після усіх тестів.
                    </p>
                </li>
            </ul>
        </div>




        {{------------------------------- HELPERS ---------------------------------}}
        <div>
            <h3>Список функцій-хелперів (helpers):</h3>

            <ul>
                <li>
                    <span class="function-name">getTestImageUploader(): ImageUploader</span>
                    <p>
                        Об'єкт класу
                        <span class="variable-name">ImageUploader</span>
                        повинен щоразу ініціалізуватись через об'єкти класів:
                        <ol>
                            <li>LocalFileManager</li>
                            <li>ImageEditor</li>
                            <li>ImageChecker</li>
                        </ol>
                    <br>
                        тому, для розвантаження коду, цей процес було винесено в окрему функцію.
                    </p>
                </li>
            </ul>
        </div>



    </div>
@endsection