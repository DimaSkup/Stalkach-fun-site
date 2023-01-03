{{-- THIS IS A PAGE FOR EDITING OF A RECORD ABOUT SOME MODIFICATION --}}

@extends('layouts.theme')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/create-pages/create-pages.css') }}"/>
    <script type="module" src="{{ URL::asset('js/create/create-modification.js') }}"></script>

    {{-- ATTENTION: THERE IS A WHITE-BACKGROUND CLASS --}}
    <section class="modification-edit-page white-background">
        <h1>{{ __('updating of the modification') }}</h1>

        {{-------------------- THE EDITING FORM --------------------------}}
        {!! Form::model($modification,
            [
                'method'    => 'put',
                'route'     => ['mods.update', $modification->slug],
                'class'     => 'form',
                'id'        => 'form',
                'enctype'   => 'multipart/form-data',
                'files'     => true,
                'data-form-type' => 'edit',
            ])
        !!}

        {{-------- FORM FIELDS ---------}}
        @include ('mods.create._fields', ['modification' => $modification])

        {{-------------------- THE FORM CLOSING TAG ----------------------}}
        {!! Form::close() !!}
    </section>

    {{-- because fucking vue.js hate native js code we need to set type="module" --}}
    <script type="module">
    </script>
@endsection

