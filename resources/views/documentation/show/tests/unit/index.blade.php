@extends('documentation.base')

@section('content')
    <h2>Unit-tests:</h2>
    <ul>
        <p>Розташування: підкаталог <b>Unit/</b></p>
        <p>Поділяється на тестування окремих складових наступних модулів:</p>
        <li>
            <a href="{{
	                route('documentation.show', ['path' => "$path.files.index" ])}}">
                Files
            </a>
            (dir) -- робота з файловою системою та файлами зокрема
        </li>

        <li>
            <a href="{{
	                route('documentation.show', ['path' => "$path.models.index" ])}}">
                Models</a>
            (dir) -- тестування корректності роботи окремих
            <a href="{{$modelsDoc}}">моделей</a>
        </li>

        <li>
            <a href="{{
	                route('documentation.show', ['path' => "$path.testutils" ])}}">
                TestUtils</a>
            (file) -- утиліти для тестів
        </li>
    </ul>
@endsection