@extends('documentation.base')

@section('content')
    <h1>Unit-тести: перевірка функціоналу роботи з файловою системою.</h1>
    Файл: <span class="file-name">Unit/Files/FileManagerTest.php</span>
    <p>
        Опис: існує загальний <i>interface</i> під іменем
        <span class="function-name">FileManager</span>
        який задає необхідний набір функціоналу для роботи з файловою системою та файлами.

        Реалізацію цього функціоналу здійснює клас
        <span class="function-name">LocalFileManager</span>,
        котрий забезпечує роботу з локальною файловою системою.

        Файли обох класів находяться по шляху:
        <span class="variable-name">app/Helpers/</span>.<br><br>

        Даний юніт-тест перевіряє роботу безпосередньо класу
        <span class="file-name">LocalFileManager</span>
    </p>
    <hr><br><br>


    <div>
        {{---------- VARIABLES LIST ----------}}
        @include ('documentation.show.tests.unit.files.includes._file_manager_test_variables')

        {{---------- FUNCTIONS LIST ----------}}
        @include ('documentation.show.tests.unit.files.includes._file_manager_test_functions_list')

    </div>
@endsection