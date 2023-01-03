@extends('documentation.base')

@section('content')
   <h1>
       ModReviewsTest: перевірка моделі
       <a href="{{ route('documentation.show', ['path' => 'models.mod-review']) }}" class="file-name">
           ModReview
       </a>
   </h1>

   <p>
       Перевіряємо коректність поведінки рев'ю (оглядів) на модифікації:
       відношень/геттерів/сеттерів.<br>
       Будь-яка фіча цієї моделі (в тестах), будь то
       текст, кількість лайків, чи зовнішні відношення --
       генеруються за допомогою факторі

       <a href="{{ route('documentation.show', ['path' => 'factory.mod-review-factory']) }}">
           <span class="file-name">(ModReviewFactory)</span>
       </a>
       та її внутрішніх функцій,
       якими налаштовується генерована модель рев'ю.<br><br>
       Детальніше про
       <a href="{{ route('documentation.show', ['path' => 'factory.mod-review-factory']) }}">
           ModReviewFactory
       </a>

   </p>
   <br><br><hr>

   {{------------------------------------ USE ----------------------------------------}}
   @include ('documentation.show.tests.unit.models.includes._mod_review_test_use')

   {{----------------------------- ATTRIBUTES TESTS  ---------------------------------}}
   @include ('documentation.show.tests.unit.models.includes._mod_review_test_attributes')
@endsection