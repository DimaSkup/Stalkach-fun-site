@extends('documentation.base')
@php
    $pathToImages = "images/documentation/models/mod/";
@endphp

@section('content')
    <h1>Mod</h1>
    <p>
        Дана модель є представленням певної фан-модифікації до гри S.T.A.L.K.E.R.
        <br><br>

        {{----------------- COMMON DESCRIPTION OF THE MODEL -----------------}}
        <div>
            Кожен розробник може викласти свою модифікацію на наш сайт, щоб інші гравці
            могли про неї дізнатися, скачати, дати відгук
            <a href="{{ route('documentation.show', ['path' => "models.mod-review"]) }}">
                (ModReview)
            </a>
            , оцінити її <a href="{{ route('documentation.show', ['path' => "models.mod-rating"]) }}">
                (ModRating)
            </a>,
            чи залишити коментар (Comment).
        </div>
        <hr><br><br>

        {{----------------- REQUIREMENTS -----------------}}
        @include('documentation.show.models.includes._mod_requirements')

        {{------------------- OPTIONAL -------------------}}
        @include('documentation.show.models.includes._mod_optional')

        {{--------------- NOT DEVELOPED YET --------------}}
        @include('documentation.show.models.includes._mod_not_developed_yet')

        {{------ MODEL PROPERTIES (CONSTANTS, RELATIONS, MUTATORS, ACCESSORS) -----}}
        @include('documentation.show.models.includes._mod_properties')
    </p>


    {{--
    <div onclick="window.scrollTo({top: 0, left: 0, behavior: 'smooth'})">
        <button>UP</button>
    </div>
    --}}
@endsection