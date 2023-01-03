<!DOCTYPE html>
<html>
<head>
    <title>{{ $path ?? "Документація" }}</title>
    <link rel="stylesheet" href="{{ asset('css/documentation.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/create-pages/create-pages.css') }}"/>
    <script src="{{ asset('js/documentation/documentation.js') }}"></script>
</head>
<body>
    @include('includes.breadcrumbs')
    <br><br>
    <a id="top"></a>

    @yield('content')

    <a class="scroll-up-parent" href="#top">
        <button>UP</button>
    </a>
</body>
</html>