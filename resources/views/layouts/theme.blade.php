@extends('base')

@section('body')
    <div id="progress-bar"></div>
    <div id="app">
        @include('includes.preloader')
        @include('includes.search')

        <aside>
            @include('includes.aside')
        </aside>

        <header>
            @include('includes.header')
        </header>

        <main>
            @include('flash::message')
            @yield('content')
            @include('includes.footer')
        </main>
    </div>
@endsection