{{-- THIS IS A PAGE FOR CREATION OF A NEW RECORD ABOUT SOME MODIFICATION --}}
{{-- @extends('layouts.fullscreen') --}}

{{-- @section('global') --}}
    <link rel="stylesheet" href="{{ asset('css/create-pages/create-pages.css') }}"/>
    <script type="module" src="{{ URL::asset('js/create/create-modification.js') }}"></script>

    @include('flash::message')

    {{-- ATTENTION: THERE IS A WHITE-BACKGROUND CLASS --}}
    <div class="row" >
        <h1>{{ $currentLocale }}</h1>
        <h1>{{ __('modification.create.caption') }}</h1>
        <div class="col">

            {{----------------------- THE FORM OPENING TAG ------------------------------}}
            {!! Form::open(
                [
                    'route'     => 'mods.store',
                    'class'     => 'form',
                    'id'        => 'form',
                    'enctype'   => "multipart/form-data",
                    'files'     => true,
                ])
            !!}

            {{-------- FORM FIELDS ---------}}
            @include ('mods.create._fields', ['modification' => null])

            {{-- A FORM CLOSING TAG --}}
            {!! Form::close() !!}

        </div>
    </div>

    {{-- because fucking vue.js hate native js code we need to set here type="module" --}}
    <script type="module">
    </script>
{{-- @endsection--}}