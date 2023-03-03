{{--
    EDITING SOME USER
--}}

@extends('layouts.theme')

@section('content')
    {{--
    <link rel="stylesheet" href="{{ asset('css/create-pages/create-pages.css') }}"/>
    <script type="module" src="{{ URL::asset('js/create/create-modification.js') }}"></script>
    --}}

    {{-- ATTENTION: THERE IS A WHITE-BACKGROUND CLASS --}}
    <section class="modification-edit-page white-background">
        <h1>{{ __('updating of the user') }}</h1>

        {{-------------------- THE EDITING FORM --------------------------}}
        {!! Form::model($user,
            [
                'method'    => 'put',
                'route'     => ['user.update', $user->id],
                'class'     => 'form',
                'id'        => 'form',
                'enctype'   => 'multipart/form-data',
                'files'     => true,
                'data-form-type' => 'edit',
            ])
        !!}

        {{-------- FORM FIELDS ---------}}
        @include ('auth.includes._register_input_fields', ['user' => $user])

        {{-------------------- THE FORM CLOSING TAG ----------------------}}
        {!! Form::close() !!}
    </section>

    {{-- because fucking vue.js hate native js code we need to set type="module" --}}
    <script type="module">
    </script>
@endsection

