@extends('base')

@section('body')
    <div id="app" class="fullscreen">
        @include('includes.preloader')
        @include('includes.search')

        <aside class="{{ ($disabledMenuBlur ?? false) ? 'outline' : 'blur' }}">
            @include('includes.aside')
        </aside>

        <header>
            @include('includes.header')
        </header>

        <main>
            @yield('global')
        </main>
    </div>
@endsection