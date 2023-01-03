@extends('layouts.fullscreen')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/new-landing.css') }}">
@endsection

@section('global')
    <div id="landing">
        <section class="hero-block">
            <div class="section-content">
                <div class="hero-block__wrapper">
                    <div class="left-side">
                        <time class="subheading" datetime="2023-12-14 20:00">December 14</time>
                        <h1>The best entry into the atmosphere of the zone</h1>
                        <p>Duis enim sapien, scelerisque non commodo sed, ultrices at arcu. Mauris facilisis rutrum eros quis tincidunt. Aenean dictum aliquet tempus. Donec auctor magna libero, non laoreet leo iaculis a.</p>
                        <div class="hero-block__buttons">
                            <a href="#" class="btn primary">@lang('ui.landing.enter_button')</a>
                            <a href="#" class="btn">@lang('ui.landing.download_mods_button')</a>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="subheading">@lang('ui.landing.video_post_title')</div>
                        <a href="#" class="video-post">
                            <div class="video-post_content">
                                <div class="play-icon">
                                    <span class="material-icons">play_arrow</span>
                                </div>
                                <div>
                                    <div class="live">@lang('ui.landing.broadcasting_title')</div>
                                </div>
                            </div>
                            <div class="bg">
                                <img src="{{ asset('img/slider2.jpg') }}">
                            </div>
                        </a>
                        <a href="#" class="video-post">
                            <div class="video-post_content">
                                <div class="play-icon">
                                    <span class="material-icons">play_arrow</span>
                                </div>
                            </div>
                            <div class="bg">
                                <img src="{{ asset('img/333.jpeg') }}">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="hero-block__footer">
                    <ul class="social">
                        <li><a class="" href="#">Instagram</a></li>
                        <li><a href="#">Telegram</a></li>
                        <li><a href="#">Youtube</a></li>
                    </ul>

                </div>
            </div>
            <div class="bg">
                <img src="{{ asset('images/land-hero-bg.jpg') }}">
            </div>
            <div class="particles">
                @include('landing._particles')
            </div>
        </section>
    </div>
@endsection
