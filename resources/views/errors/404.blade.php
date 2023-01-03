@extends('layouts.fullscreen')

@section('global')
    <div id="error-404">
        <div class="error__container">
            <div class="error__layer back"></div>
            <div class="error__layer text">
                <div class="text-wrapper">
                    <h2>404</h2>
                    <p>Page not found</p>
                </div>
            </div>
            <div class="error__layer fogwrapper">
                <div class="fog fog__layer01">
                    <div class="image01"></div>
                    <div class="image02"></div>
                </div>
                <div class="fog fog__layer02">
                    <div class="image01"></div>
                    <div class="image02"></div>
                </div>
                <div class="fog fog__layer03">
                    <div class="image01"></div>
                    <div class="image02"></div>
                </div>
            </div>
            <div class="error__layer front"></div>
        </div>
    </div>
@endsection