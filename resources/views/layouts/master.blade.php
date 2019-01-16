<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="app-url" content="{{ url('/') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="CSUN's Profile Manager">
        <title>CSUN | {{ config('app.name') }}</title>
        <link rel="icon" href="//www.csun.edu/sites/default/themes/csun/favicon.ico" type="image/x-icon"/>
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
                <div class="container">
                    @yield('content')
                </div>
                <csun-footer app-name="{{ config('app.name') }}"></csun-footer>
        </div>
    </body>
    <script src="{{ asset('js/manifest.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
