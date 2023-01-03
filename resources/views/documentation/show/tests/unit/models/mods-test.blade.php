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
        генеруються за допомогою факторі
        <a href="{{ route('documentation.show', ['path' => 'factory.mod-factory']) }}">
            <span class="file-name">(ModFactory)</span>
        </a> та її внутрішніх функцій,
        якими налаштовується генерована модель модифікацій.<br><br>
        Детальніше про
        <a href="{{ route('documentation.show', ['path' => 'factory.mod-factory']) }}">
            ModFactory
        </a>

    </p>
    <br><br><hr>

    {{------------------------------------ USE ----------------------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_use')

    {{---------------------------- PRIVATE TEST VARIABLES -----------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_private_vars')

    {{------------------------------- COMMON TESTS  -----------------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_common_tests')

    {{------------------------------ TEST ATTRIBUTES  ---------------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_attributes')

    {{----------------------------------- UTILS ---------------------------------------}}
    @include ('documentation.show.tests.unit.models.includes._mods_test_utils_func')

@endsection