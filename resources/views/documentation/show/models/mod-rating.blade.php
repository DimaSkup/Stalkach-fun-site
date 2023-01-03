@extends('documentation.base')

@section('content')
    <h1>ModRating</h1>

    <p>
        Дана модель є представленням оцінки (rating) до певної
        фан-модифікації
        <a href="{{ route('documentation.show', ['path' => "models.mod"]) }}">
            (Mod)
        </a>
        &nbsp до гри S.T.A.L.K.E.R.<br>
        Разом з
        <a href="{{ route('documentation.show', ['path' => "models.mod-review"]) }}">
            ModReview
        </a>
        утворює повний відгук про модифікацію.
        <br><br><br>

    {{-------------- COMMON DESCRIPTION --------------}}
    <div>
        <h3>Являє собою сукупність оцінок різних аспектів модифікації:</h3>
        <ul>
            <li>
                <span class="variable-name">story</span><br>
                Оцінка сюжету.
            </li>
            <li>
                <span class="variable-name">graphics</span><br>
                Оцінка графічної складової.
            </li>
            <li>
                <span class="variable-name">difficulty</span><br>
                Оцінка загальної складності.
            </li>
            <li>
                <span class="variable-name">optimization</span><br>
                Оцінка оптимізації (fps, забагованість і тд.)
            </li>
            <li>
                <span class="variable-name">atmosphere</span><br>
                Оцінка атмосферності.
            </li>
            <li>
                <span class="variable-name">main</span><br>
                Загальна оцінка - будується на основі попередніх.
            </li>
        </ul>
        <span class="file-name">Примітка</span>
        : імена оцінок співпадаються з іменами відповідних полів у базі даних.

        <br><br><hr>
    </div>


    {{-------------- RELATIONS --------------}}

    <div>
        <h3>Відношення (Relations): </h3>

        <ul>
            <li>
                <span class="variable-name">modReview()</span><br>
                Має відношення до моделі
                <a href="{{ route('documentation.show', ['path' => "models.mod-review"]) }}">
                    ModReview
                </a>
                <br>
                Дана функція повертає відповідний об'єкт класу ModReview
            </li>
        </ul>

        <br><br><hr>
    </div>


    {{-------------- ACCESSORS (GETTERS) --------------}}
    <div>
        <h3>Геттери (accessors, getters):</h3>
        <ul>
            <li>
                <span class="variable-name">getGradesAttribute()</span><br>
                Повертає асоціативний array [тип_оцінки => значення_оцінки].
            </li>
        </ul>
        <br><br><hr>
    </div>
@endsection