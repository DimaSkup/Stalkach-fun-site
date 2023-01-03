{{--------- FUNCTIONS LIST OF THE FILE MANAGER UNIT-TEST -----------}}

<div class="drop-down-list">
    <h2 class="title">Список функцій-тестів:</h2>

    <div class="drop-down-list-content hide">
        В кожній з функцій-тестів ми працюємо з класом
        <span class="function-name">LocalFileManager</span> та його екземплярами (об'єктами, інстансами).
        Функціонал буде викликатись виключно від цих об'єктів.
        Тому надалі це завжди буде матись на увазі.
        <ul>
            <li>
                <span class="function-name">test_creation_of_file_manager_object()</span>:
                <p>
                    Перевірка можливості створення екземпляру класу
                    <span class="function-name">LocalFileManager</span>
                    та чи це цей об'єкт має атрибут "disk"
                </p>
            </li>

            <li>
                <span class="function-name">test_can_set_and_get_disk_from_file_manager()</span>:
                <p>
                    Перевірка можливості задання імені файлового диску через конструктор класу,
                    а також можливості зміни цього імені за допомогою функції
                    <span class="function-name">setDisk()</span>,
                    а згодом отримати це значення через
                    <span class="function-name">getDisk()</span>
                </p>
            </li>

            <li>
                <span class="function-name">test_we_get_and_set_temp_disk()</span>:
                <p>
                    Перевірка можливості задання поточного файлового диску для роботи
                    з тимчасовими файлами шляхом передачі результату функції
                    <span class="function-name">getTempDisk()</span>
                    (повертає ім'я дефолтного файлового диску для тимчасових файлів),
                    в якості аргументу до функції
                    <span class="function-name">setDisk()</span>
                </p>
            </li>

            <li>
                <span class="function-name">test_we_cant_get_temp_file_type()</span>:
                <p>
                    Перевірка можливості отримання дефолтного типу для тимчасових файлів
                    через функцію
                    <span class="function-name">getTempDisk()</span>
                </p>
            </li>

            <li>
                <span class="function-name">test_we_cant_get_temp_file_type()</span>:
                <p>
                    Перевірка можливості отримання дефолтного типу для тимчасових файлів
                    через функцію
                    <span class="function-name">getTempDisk()</span>
                </p>
            </li>
            <br>
            <hr>

            {{--- FILE DATA GETTERS TESTS ---}}
            <br><br>
            <h3>Тестування геттерів, котрі повертають певні дані файлу:</h3>
            <li>
                <span class="function-name">test_get_full_path()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання повного системного шляху до файлу</span>
                    за допомогою шляху файлу відносно каталогу <b>/storage/</b>,
                    використовуючи функцію
                    <span class="function-name">getFullPathByStoragePath()</span>, яка
                    отримує цей шлях в якості параметра
                </p>
            </li>

            <li>
                <span class="function-name">test_get_content_by_file_object()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання контенту файлу через об'єкт</span>
                    цього файлу. Такий об'єкт повинен буде екземпляром класу, що наслідується від
                    <span class="function-name">/SplFileInfo</span>, тобто, наприклад,
                    об'єкти класів
                    <span class="function-name">\Illuminate\Http\UploadedFile</span> або
                    <span class="function-name">\Illuminate\Http\File</span>,
                    можуть передаватися в якості параметра до функції
                    <span class="function-name">getContent()</span>, яка
                    поверне нам <span class="variable-name">контент цього файлу</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_content_by_link_to_file()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання контенту файлу через посилання</span>
                    на цей файл. Це посилання повинне передаватись в якості параметра до функції
                    <span class="function-name">getContent()</span>, яка
                    поверне нам <span class="variable-name">контент цього файлу</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_file_size_in_bytes()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання розміру файлу у байтах</span>
                    за допомогою функції
                    <span class="function-name">getFileSizeInBytes()</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_is_remote_file()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">визначення чи файл є віддаленим</span>
                    за допомогою функції
                    <span class="function-name">isRemoteFile()</span>, яка поверне
                    bool-значення результату. Якщо файл є локальним то
                    <span class="variable-name">true</span>,
                    інакше -- <span class="variable-name">false</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_file_configs_by_some_particular_type()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">
                        отримання конфігураційних значень через тип файлу
                    </span>
                    (не мається на увазі розширення файлу), за допомогою функції
                    <span class="function-name">getFileConfigsByType($fileType)</span>,
                    яка поверне array-значення результату для даного конкретного $fileType типу.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_all_the_file_configs_if_config_key_is_empty()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">
                        отримання конфігураційних значень для УСІХ типів файлів
                    </span>
                    (не мається на увазі розширення файлу), за допомогою функції
                    <span class="function-name">getFileConfigsByType(void)</span>,
                    яка поверне array-значення з конфігураціями у випадку, якщо ми нічого не
                    передаємо в якості параметра функції.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_an_exception_if_there_is_no_such_config_key()</span>:
                <p>
                    Перевірка ситуації
                    <span class="variable-name">
                        коли ми хочемо отримати конфігурацію для неіснуючого типу файлів
                    </span>
                    (не мається на увазі розширення файлу), за допомогою функції
                    <span class="function-name">getFileConfigsByType($wrongFileType)</span>.
                    <br>
                    В такому випадку отримаємо виключення
                    <span class="function-name">RuntimeException</span>
                </p>
            </li>

            <li>
                <span class="function-name">test_get_path_to_directory_by_file_type()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">
                        отримання шляху до каталогу по заданому типу файлів
                    </span>
                    (не мається на увазі розширення файлу), за допомогою функції
                    <span class="function-name">getPathToDirByType($fileType)</span>,
                    яка поверне string-значення storage-шляху до каталогу.
                    По задумці, такий каталог повинен містити лише файли типу $fileType.
                    <br>
                    У випадку якщо такого каталогу/шляху немає -- то ми отримаємо
                    <span class="function-name">RuntimeException</span>
                </p>
            </li>
            <br>
            <hr>


            {{---------- FILE OBJECT GETTERS TESTS ----------}}
            <br><br>
            <h3>Тестування геттерів, котрі повертають об'єкт File файлу:</h3>

            <li>
                <span class="function-name">test_get_file_by_storage_path()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання файлового об'єкту типу</span>
                    <span class="function-name">\Illuminate\Http\File</span>
                    за допомогою функції
                    <span class="function-name">getFileByStoragePath()</span>,
                    яка отримує в якості параметра, storage-шлях до файлу.
                    <br>
                    У випадку якщо за заданим шляхом ми не маємо такого файлу, то отримаємо виключення
                    <span class="function-name">FileNotFoundException</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_file_by_full_path()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">отримання файлового об'єкту типу</span>
                    <span class="function-name">\Illuminate\Http\File</span>
                    за допомогою функції
                    <span class="function-name">getFileByFullPath()</span>,
                    яка отримує в якості параметра, повний (системний) шлях до файлу.
                    <br>
                    У випадку якщо за заданим шляхом ми не маємо такого файлу, то отримаємо виключення
                    <span class="function-name">FileNotFoundException</span>.
                </p>
            </li>

            <li>
                <span class="function-name">test_get_temp_file_by_resource()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">
                        отримання ТИМЧАСОВОГО файлового об'єкту типу
                    </span>
                    <span class="function-name">\Illuminate\Http\File</span>
                    за допомогою функції
                    <span class="function-name">getTempFileByResource()</span>,
                    яка отримує в якості параметра два можливих параметри:
                    <span class="variable-name">файловий об'єкт</span>
                    або <span class="variable-name">посилання на файл</span>
                </p>
            </li>
            <br>
            <hr>

            {{---------- FILE SAVERS TESTS ----------}}
            <br><br>
            <h3>Тестування функціоналу, котрий зберігає файл на диск</h3>

            <li>
                <span class="function-name">test_store_content_as_file_to()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">
                        збереження контенту файлу на диск
                    </span>
                    за допомогою функції
                    <span class="function-name">storeContentAsFileTo()</span>,
                    яка отримує такі параметри:<br>
                <ol>
                    <li>контент файлу $fileContent</li>
                    <li>шлях $storeTo, куди зберегти (storage-шлях)</li>
                    <li>розширення $extension для файлу</li>
                </ol>
            </li>
            <br>
            <hr>


            {{---------- TESTS FOR OPERATIONS WITH FILES ----------}}
            <br><br>
            <h3>Тестування функціоналу для оперування файлами в файловій системі</h3>

            <li>
                <span class="function-name">test_delete_file_by_storage_path()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">видалення файлу через storage-шлях</span>
                    за допомогою функції
                    <span class="function-name">deleteFileByStoragePath()</span>,
                    яка отримує в якості параметра, storage-шлях до файлу.
                </p>
            </li>

            <li>
                <span class="function-name">test_delete_file_by_storage_path()</span>:
                <p>
                    Перевірка можливості
                    <span class="variable-name">видалення файлу через повний шлях</span>
                    за допомогою функції
                    <span class="function-name">deleteFileByFullPath()</span>,
                    яка отримує в якості параметра, повний (системний) шлях до файлу.
                </p>
            </li>
            <br>
            <hr>



            {{---------- UTILS ----------}}
            <br><br>
            <h3>Утиліти для тестів</h3>
            Дані функції не є тестами в сутності, але оскільки потрібно їх завжди запускати
            після виконання усіх вище перерахованих тестів, то вони мають префікс
            <span class="variable-name">test_</span>, тому й запускаються немов тести.

            <br><br>
            <li>
                <span class="function-name">test_clean_up_temporary_directory_from_temporal_files()</span>:
                <p>
                    Оскільки в ході виконання тестів іноді створюються тимчасові файли, які
                    розміщуються в тимчасовому каталозі -- то необхідно очистити
                    цей тимчасовий каталог.
                    <br>

                    Це ми виконуємо за допомогою функції
                    <span class="function-name">TestUtils::cleanTempDir()</span>
                    трейту
                    <a href="{{route('documentation.show', ['path' => "tests.unit.testutils"])}}">
                        TestUtils
                    </a>
                </p>
            </li>
        </ul>

    </div>
</div>