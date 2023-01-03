@extends('documentation.base')

{{----- DOCUMENTATION MAIN PAGE -----}}
@section('content')
    <h1>Документація по API для фан-сайту по сталкачу</h1>

    <div>
        <ul>
            <li>
                <a href="{{route('documentation.show', ['path' => 'models.index'])}}">Моделі</a>
            </li>
            <li>
                <a href="{{route('documentation.show', ['path' => 'controllers.index'])}}">Контролери</a>
            </li>
            <li>
                <a href="{{route('documentation.show', ['path' => 'seeds.index'])}}">Сіди</a>
            </li>
            <li>
                <a href="{{route('documentation.show', ['path' => 'factory.index'])}}">FUCKторі</a>
            </li>
            <li>
                <a href="{{route('documentation.show', ['path' => 'services.index'])}}">Сервіси</a>
            </li>
            <li>
                <a href="{{route('documentation.show', ['path' => 'tests.index'])}}">Тести</a>
            </li>
        </ul>
    </div>
@endsection