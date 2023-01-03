@extends('layouts.fullscreen')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" >
@endsection

@section('global')
    <div id="auth">
        <div class="auth__container">
            <div class="auth__layer scene">
                <video preload autoplay muted playsinline poster="{{ asset('images/auth/poster.jpg') }}" id="bg-scene">
                    <source src="{{ asset('video/pda.mp4') }}" type="video/mp4">
                    <source src="{{ asset('video/pda.webm') }}" type="video/webm">
                    <source src="{{ asset('video/pda.ogv') }}" type="video/ogg">
                </video>
            </div>
            <div class="auth__layer blur"></div>
            <div class="auth__layer pda">
                <img class="device" src="{{ asset('images/auth/pda.png') }}">
                <img class="indicator" src="{{ asset('images/auth/lamp.jpg') }}">
            </div>
            <div class="auth__layer pda-bg">
                <div class="glitch">
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                </div>
{{--                            <h2 class="title">Css Gltich Effect</h2>--}}
            </div>
            <div class="auth__layer interface">
                <div class="glitch">
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                    <div class="glitch__img"></div>
                </div>

                <div class="interface-bg">
                    {{-- this is a login form--}}
                    {!! Form::open(
                        [
                            'route'     => 'login',
                            'method'    => 'post',
                            'class' => 'interface-form'
                        ],
                        [])
                    !!}
                    @csrf

                    {{-- an input email field --}}
                    <div class="">
                        {!! Form::label('email', __('E-Mail'), ['class' => 'typewriter']) !!}

                        {!! Form::email('email', null,
                           [
                               'class'         => 'input',
                               'placeholder'   => 'example@mail.com',
                           ])
                        !!}

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- an input password field --}}
                    <div class="">
                        {!! Form::label('password', __('Password'), ['class' => 'typewriter']) !!}

                        {!! Form::password('password',
                            [
                                'class'         => 'input',
                                'placeholder'   => '**********',
                            ])
                       !!}

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    {{-- a submit button --}}
                    {!! Form::submit(__('Login'),
                        [
                            'class'     => "btn mt-20",
                        ])
                    !!}

                    {{-- the end of the login form --}}
                    {!! Form::close() !!}
                </div>
                {{--
                <div class="interface-bg">
                    <form class="interface-form">
                        <label class="typewriter" for="email">Email</label>
                        <input class="input" type="text" name="email" placeholder="example@mail.com" />

                        <label class="typewriter" for="password">Password</label>
                        <input class="input" type="password" name="password" placeholder="**********" />

                        <button class="btn mt-20" type="button">Log In</button>
                    </form>
                </div>
                --}}
            </div>
        </div>
    </div>
@endsection

@section('js')
{{--    <script>--}}
{{--        var video = document.querySelector('video');--}}
{{--        var promise = video.play();--}}

{{--        if (promise !== undefined) {--}}
{{--            promise.then(_ => {--}}
{{--                // Autoplay started!--}}
{{--            }).catch(error => {--}}
{{--                // Autoplay not allowed!--}}
{{--                // Mute video and try to play again--}}
{{--                video.muted = true;--}}
{{--                video.play();--}}

{{--                // Show something in the UI that the video is muted--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
@endsection
