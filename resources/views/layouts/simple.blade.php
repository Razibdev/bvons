<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }}</title>

    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    @include('layouts.inc.favicons')

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/codebase.css') }}">

    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
<link rel="stylesheet" id="css-theme" href="{{ asset('/css/themes/corporate.css') }}">
@yield('css_after')

<!-- Scripts -->
    {{--<script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>--}}
</head>
<body>
<div id="page-container" class="main-content-boxed">
    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!-- Codebase Core JS -->
<script src="{{ asset('js/codebase.app.js') }}"></script>

<!-- Laravel Scaffolding JS -->
{{--<script src="{{ asset('js/laravel.app.js') }}"></script>--}}

@yield('js_after')
</body>
</html>
