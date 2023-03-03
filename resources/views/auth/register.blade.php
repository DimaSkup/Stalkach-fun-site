@extends('layouts.theme')

@section('content')

    <div class="container" style="background-color: white;">
        <div class="row justify-content-center">
            <div class="">
                <div class="">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        {{------------- this is a register form -------------------}}
                        {!! Form::open(
                            [
                                'route'     => 'register',
                                'method'    => 'post',
                                'class' => '',
                            ],
                            [])
                        !!}

                        @include('auth.includes._register_input_fields')

                        {{----------------------- a submit button ----------------------}}
                        <div class="form-group row mb-0">
                            {!! Form::submit( __('Register'),
                                [
                                    'class' => 'btn btn-primary',
                                ])
                            !!}
                        </div>

                        {{------------------ the end of the register form --------------}}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection