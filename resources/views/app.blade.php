<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- SUMMERNOTE -->
        {{--    TODO Replace to component    --}}
        <script src="{{ asset('plugins/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote-0.8.18-dist/summernote-lite.min.js') }}"></script>


        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
