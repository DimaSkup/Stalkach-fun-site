@extends('documentation.base')

@section('content')
    <h1>ModReviewFactory</h1>

    <p>
        Є реалізацією факторі для моделі
        <a href="{{ route('documentation.show', ['path' => 'models.mod-review']) }}" class="file-name">
            ModReview
        </a>
    </p>
    <br><br><hr>

    {{------------------------------ EXAMPLES OF USING --------------------------------}}
    @include ('documentation.show.factory.includes._mod_review_factory_examples_of_using')

    {{----------------------------------- VARIABLES -----------------------------------}}
    @include ('documentation.show.factory.includes._mod_review_factory_variables')

    {{------------------------------- COMMON FUNCTIONS --------------------------------}}
    @include ('documentation.show.factory.includes._mod_review_factory_functions_common')

    {{------------------------ FUNCTIONS FOR UNIT TESTS -------------------------------}}
    @include ('documentation.show.factory.includes._mod_review_factory_functions_unit_test')

    {{------------------------ FUNCTIONS FOR FEATURE TESTS ----------------------------}}
    @include ('documentation.show.factory.includes._mod_review_factory_functions_feature_test')
@endsection