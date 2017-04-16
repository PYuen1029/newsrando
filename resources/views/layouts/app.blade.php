<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($page_title) ? $page_title . '- News Randomizer' : 'News Randomizer' }}</title>
    

    <!-- Styles -->
    <!-- Begin Application-specific Styles -->
    <link rel="stylesheet" href="bower_components/html5-boilerplate/dist/css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="bower_components/materialize/dist/css/materialize.min.css">
    <!-- Begin page-specific styles -->
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/materialize/dist/js/materialize.min.js"></script>    
    @yield('js');
</body>
</html>
