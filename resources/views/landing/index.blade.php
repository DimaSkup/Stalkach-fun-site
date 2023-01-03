@extends('layouts.fullscreen')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}" >
@endsection

@section('global')
    <div class="landing">
        <div class="wrapper">
            <div class="parallax__group hero-container">
                <div class="parallax__layer back"></div>
                <div class="parallax__layer front"></div>
                <div class="parallax__layer anomaly"></div>
                <div class="parallax__layer grass"></div>
                <div class="parallax__layer ashes">@include('landing._particles')</div>
{{--                <div class="parallax__layer content">--}}
{{--                    <h1>Hello</h1>--}}
{{--                </div>--}}
            </div>
            <div class="parallax__group info-container">

            </div>
            <div class="parallax__group underground-container">
                <div class="parallax__layer under-back"></div>
                <div class="parallax__layer under-capsule"></div>
                <div class="parallax__layer under-front"></div>
                <div class="parallax__layer under-right"></div>
                <div class="parallax__layer ashes">@include('landing._particles')</div>
                <div class="parallax__layer gradient"></div>
            </div>
            <div class="parallax__group info-container">

            </div>
        </div>
    </div>
@endsection
