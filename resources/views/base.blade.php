<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('ui.main_title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    @yield('css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="gradient">
    @yield('body')
    <!--====== Javascripts & SHIT-query ======-->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('js')
</body>
</html>
