@extends('documentation.base')

@section('content')
    На проекті присутні <b>Unit-тести</b> та <b>Feature-тести</b>,
    котрі розташовані у каталозі <b>tests/</b>

    <div>
        <h4>Feature-tests:</h4>
        <ul>
            <p>Розташування: підкаталог <b>Feature/</b></p>
            <li>
                <span class="file-name"> LoginPageTest </span>
                - тестування коректності роботи логіну на сайті
            </li>
            <li>
                <span class="file-name"> ModsRoutesTest </span>
                - тестування маршрутів що стосуються контролера ModsController</li>
        </ul>

        <h4>Unit-tests:</h4>
        <ul>
            <p>Розташування: підкаталог <b>Unit/</b></p>
            <p>Поділяється на тестування окремих складових наступних модулів:</p>
            <li>
                <a href="{{
	                route('documentation.show', ['path' => "$path.unit.files.index" ])}}">
                    Files
                </a>
                (dir) -- робота з файловою системою та файлами зокрема
            </li>

            <li>
                <a href="{{
	                route('documentation.show', ['path' => "$path.unit.models.index" ])}}">
                Models</a>
                (dir) -- тестування корректності роботи окремих
                <a href="{{$modelsDoc}}">моделей</a>
            </li>

            <li>
                <a href="{{
	                route('documentation.show', ['path' => "$path.unit.testutils" ])}}">
                TestUtils</a>
                (file) -- утиліти для тестів
            </li>
        </ul>
    </div>
@endsection