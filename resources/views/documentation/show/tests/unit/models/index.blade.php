@extends('documentation.base')

@section('content')
    <h1>Unit-тести: Models</h1>
    Ці тести виконують перевірку корректності роботи моделей (їх відношень, мутаторів, аксессорів, і т.д.)
    <div>
        <p>Список тестів:</p>
        <ul>
            <li>
                <a href="{{ route('documentation.show', ['path' => "tests.unit.models.mod-reviews-test"]) }}">
                    <span class="file-name">ModReviewsTest</span>
                </a>
                -- перевірка
                <a href="{{$modelsDoc}}"> моделі </a>
                ModReview
            </li>

            <li>
                <a href="{{ route('documentation.show', ['path' => "tests.unit.models.mods-test"]) }}">
                    <span class="file-name">ModTest</span>
                </a>
                -- перевірка
                <a href="{{$modelsDoc}}"> моделі </a>
                Mod
            </li>
        </ul>
    </div>
@endsection