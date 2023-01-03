@extends('documentation.base')
@php
    $pathToImages = "images/documentation/models/mod/";
@endphp

@section('content')
    <h1>ModReview</h1>

    <p>
        Дана модель є представленням рев'ю (огляду, відгуку) до певної
        фан-модифікації
        <a href="{{ route('documentation.show', ['path' => "models.mod"]) }}">
            (Mod)
        </a>
        &nbsp до гри S.T.A.L.K.E.R.
        <br><br>

    {{----------------- COMMON DESCRIPTION OF THE MODEL -----------------}}
    @include ('documentation.show.models.includes._mod_review_common_description')

    {{----------------------- MODEL PROPERTIES --------------------------}}
    @include ('documentation.show.models.includes._mod_review_properties')
@endsection