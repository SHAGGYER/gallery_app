<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gallery App</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />

    </head>
    <body>
        <div id="app"></div>

        <script>
            var BASE_URL = '{{ URL::to('/') }}';
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
