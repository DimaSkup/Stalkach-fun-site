@extends('layouts.theme')

{{--@section('global')--}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="background-color: white;">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        {{-- this is a login form--}}
                        {!! Form::open(
                            [
                                'route'     => 'login',
                                'method'    => 'post',
                                'class'     => '',
                                'content-type'  => "application/json",
                            ],
                            [])
                        !!}

                        {{-- an input email field --}}
                        <div class="form-group row">
                            {!! Form::label('email', __('E-Mail Address'), ['class' => 'control-label']) !!}

                            <div class="">
                                {!! Form::email('email', null,
                                   [
                                       'class'         => 'form-control',
                                       'placeholder'   => '',
                                   ])
                                !!}
                            </div>

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- an input password field --}}
                        <div class="form-group row">
                            {!! Form::label('password', __('Password'), ['class' => 'control-label']) !!}

                            <div class="">
                                {!! Form::password('password',
                                    [
                                        'class'         => 'form-control',
                                        'placeholder'   => '',
                                    ])
                                !!}
                            </div>

                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- a "Remember me" checkbox --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', 'checked', old('remember') ? 'checked' : '',
                                        [
                                            'id'    => 'remember',
                                            'class' => 'form-check-input',
                                        ])
                                    !!}

                                    {!! Form::label('remember', __('Remember Me'), ['class' =>'form-check-label']) !!}
                                </div>
                            </div>
                        </div>

                        {{-- A link to the register page --}}
                        <div class="form-group row">
                            <a class="" style="color: black;" href="{{ route('register') }}">
                                Haven't registered yet?
                            </a>
                        </div>

                        {{-- a submit button --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit(__('Login'),
                                    [
                                        'class'     => "btn btn-primary",
                                    ])
                                !!}

                                {{-- a reset password link --}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        {{-- a link to auth through GOOGLE --}}
                        <div class="form-group row">
                            <a class="logo" href="{{ route('auth-google') }}">
                                <svg height="100mm" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 100 100" width="100mm" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><style type="text/css"><![CDATA[.fil0 {fill:none}.fil2 {fill:#2DA83E}.fil1 {fill:#4265AD}.fil4 {fill:#D93026}.fil3 {fill:#EFBC16}]]></style></defs><g id="Ebene_x0020_1"><g id="_564627256"><rect class="fil0" height="100" id="_564630712" width="100"/><g><path class="fil1" d="M50 17.1874c9.061,0 17.2629,3.674 23.2,9.6126l-7.7326 7.7326c-3.9584,-3.9587 -9.4269,-6.4073 -15.4674,-6.4073 -6.0405,0 -11.5092,2.4484 -15.4677,6.4069l-7.7341 -7.7343c5.9379,-5.9379 14.1409,-9.6105 23.2018,-9.6105z" id="_431195944"/><path class="fil2" d="M65.4664 65.4663c2.7699,-2.7705 4.8009,-6.2798 5.7703,-10.2077l-11.8615 0 0 -11.5085 11.5918 0 11.2484 0c0.3903,2.0236 0.5971,4.1124 0.5971,6.2499 0,0.2797 -0.0035,0.5586 -0.0105,0.8366l-0.0002 0.0103 -0.0002 0.0062c-0.007,0.2732 -0.0174,0.5455 -0.0311,0.8169l-0.0019 0.037c-0.0135,0.2621 -0.0301,0.5235 -0.0497,0.784l-0.0053 0.0692c-0.019,0.2459 -0.0408,0.4911 -0.0652,0.7354l-0.0124 0.1217c-0.0232,0.2232 -0.0486,0.4458 -0.0763,0.6677l-0.0243 0.1905c-0.0262,0.2015 -0.0544,0.4023 -0.0843,0.6026 -0.0126,0.0843 -0.0256,0.1684 -0.0388,0.2525l-0.0204 0.128 -0.0008 0c-1.1203,6.9545 -4.4272,13.1763 -9.1912,17.9412l-7.7335 -7.7335z" id="_568778248"/><path class="fil3" d="M34.5324 65.4679c3.9585,3.9584 9.4272,6.4068 15.4676,6.4068 6.0407,0 11.5082,-2.4495 15.4663,-6.4084l7.7335 7.7335c-5.9373,5.9384 -14.1387,9.6128 -23.1998,9.6128 -9.0609,0 -17.2639,-3.6726 -23.2018,-9.6105l7.7342 -7.7342z" id="_425781896"/><path class="fil4" d="M34.5323 34.5322c-3.9585,3.9586 -6.4069,9.4273 -6.4069,15.4678 0,6.0406 2.4484,11.5094 6.407,15.4679l-7.7343 7.7342c-5.9379,-5.9379 -9.6106,-14.1411 -9.6106,-23.2021 0,-9.061 3.6727,-17.2641 9.6106,-23.202l7.7342 7.7342z" id="_425793800"/></g></g></g></svg>
                            </a>
                        </div>

                        {{-- the end of the login form --}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection