@extends('layouts.fullscreen')

@section('global')
    <div id="error-500">
        <div class="error__container">
            <div class="error__layer back"></div>
            <div class="error__layer text">
                <h2>500</h2>
                <p>Internal Server Error</p>
            </div>
            <div class="error__layer ashes">
                @include('landing._particles')
            </div>
        </div>
    </div>
@endsection