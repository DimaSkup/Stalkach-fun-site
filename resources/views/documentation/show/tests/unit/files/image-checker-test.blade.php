@extends('documentation.base')

@section('content')
    <h1>Unit-тести: перевірка функціоналу роботи з валідатора зображень.</h1>

    <div>
        {{---------- VARIABLES LIST ----------}}
        <div>
            <h3>Список приватних змінних: </h3>
            <ul>
                <li>
                    <span class="function-name">string $correctLinkToRemoteImage</span>
                    <p>посилання на файл з корректним зображенням в інеті</p>
                </li>
                <li>
                    <span class="function-name">string $wrongLinkToRemoteImage</span>
                    <p>некорректне посилання на файл з зображенням в інеті</p>
                </li>
            </ul>
        </div>
        <br><br><hr>


        {{---------- FUNCTIONS LIST ----------}}
        <div>
            <h3>Список функцій-тестів:</h3>

            <ul>
                <li>
                    <span class="function-name">test_check_method_with_correct_data()</span>
                    <p>
                        Перевірка роботи валідатора зображень, якщо на вхід ми отримуємо
                        валідні дані. Є 2 можливі варіанти вхідного параметру: файл або посилання.
                    </p>
                </li>
                <li>
                    <span class="function-name">test_check_method_with_wrong_image_object()</span>
                    <p>
                       Якщо на всіх подаємо файл з невалідним зображенням, то
                       валідатор повинен викинути виключення (exception).
                    </p>
                </li>
                <li>
                    <span class="function-name">test_check_method_with_wrong_link_to_image()</span>
                    <p>
                        Якщо на всіх подаємо посилання на невалідне зображення, то
                        валідатор повинен викинути виключення (exception).
                    </p>
                </li>
            </ul>
        </div>

    </div>
@endsection