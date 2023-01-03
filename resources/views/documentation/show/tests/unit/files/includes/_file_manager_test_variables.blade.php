{{---------- VARIABLES LIST OF THE FILE MANAGER UNIT-TEST ----------}}

<div class="drop-down-list">
    <h2 class="title">Список приватних змінних-даних:</h2>

    <div class="drop-down-list-content hide">
        <ul>
            <li>
                <span class="function-name">FileManager $fileManager;</span>
                <p>Екземпляр класу, що реалізує інтерфейс FileManager</p>
            </li>

            <li>
                <span class="function-name">string $testDiskName;</span>
                <p>Ім'я диску, який використовується для роботи з тестовими файлами</p>
            </li>

            <li>
                <span class="function-name">string $testDirName;</span>
                <p>
                    Шлях до каталогу (або ж лише ім'я), що використовується для роботи
                    з тестовими файлами. Сюди ми їх зберігаємо та працюємо з ними.
                    <span class="file-name">Примітка:</span>
                    після виконання усіх тестів,
                    цей каталог слід очистити від тимчасових файлів
                </p>
            </li>

            <li>
                <span class="function-name">string $linkToRemoteFile;</span>
                <p>
                    Адреса до файлу в інеті. Необхідна для перевірки коректності завантаження
                    файлу з віддаленого ресурсу. В даному випадку цим файлом є зображення
                </p>
            </li>
        </ul>
        <hr><br><br>

    </div>
</div>