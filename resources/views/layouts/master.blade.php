<!doctype html>
<html class="theme-OnceAMatadorAlwaysAMatador" id="mainBody" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="//cdn.metalab.csun.edu/metaphor/css/metaphor.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        @if ( $errors->count() > 0 )
            ...An error occured...
            @foreach( $errors->all() as $message )
                ...{{ $message }}...
            @endforeach
        @endif

        <div id="app">
            <nav-bar app-name="{{ config('app.name') }}"></nav-bar>
            <div class="main main--metalab section">
                <div class="container">
                    @yield('content')
                </div>
                <csun-footer app-name="{{ config('app.name') }}"></csun-footer>
                <meta-footer></meta-footer>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
