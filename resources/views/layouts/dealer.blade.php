<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }} - @yield('title', 'Dashboard')</title>

    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
@include('layouts.inc.favicons')

<!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    {{--    <link rel="stylesheet" id="css-main" href="{{ asset('css/app.css') }}">--}}
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/ku.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}">
    <style>
        .sidebar{
            display: none;
        }
        .phpdebugbar.phpdebugbar-minimized{
            display: none;
        }
    </style>

    {{--<style>--}}
        {{--body {--}}
            {{--font-family: "Lato", sans-serif;--}}
        {{--}--}}

        {{--.sidebar {--}}
            {{--height: 100%;--}}
            {{--width: 0;--}}
            {{--position: fixed;--}}
            {{--z-index: 1;--}}
            {{--top: 0;--}}
            {{--left: 0;--}}
            {{--background-color: #111;--}}
            {{--overflow-x: hidden;--}}
            {{--transition: 0.5s;--}}
            {{--padding-top: 60px;--}}
        {{--}--}}

        {{--.sidebar a {--}}
            {{--padding: 8px 8px 8px 32px;--}}
            {{--text-decoration: none;--}}
            {{--font-size: 25px;--}}
            {{--color: #818181;--}}
            {{--display: block;--}}
            {{--transition: 0.3s;--}}
        {{--}--}}

        {{--.sidebar a:hover {--}}
            {{--color: #f1f1f1;--}}
        {{--}--}}

        {{--.sidebar .closebtn {--}}
            {{--position: absolute;--}}
            {{--top: 0;--}}
            {{--right: 25px;--}}
            {{--font-size: 36px;--}}
            {{--margin-left: 50px;--}}
        {{--}--}}

        {{--.openbtn {--}}
            {{--font-size: 20px;--}}
            {{--cursor: pointer;--}}
            {{--background-color: #111;--}}
            {{--color: white;--}}
            {{--padding: 10px 15px;--}}
            {{--border: none;--}}
        {{--}--}}

        {{--.openbtn:hover {--}}
            {{--background-color: #444;--}}
        {{--}--}}

        {{--#main {--}}
            {{--transition: margin-left .5s;--}}
            {{--padding: 16px;--}}
        {{--}--}}

        {{--/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */--}}
        {{--@media screen and (max-height: 450px) {--}}
            {{--.sidebar {padding-top: 15px;}--}}
            {{--.sidebar a {font-size: 18px;}--}}
        {{--}--}}
    {{--</style>--}}


@yield('css_after')

<!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<!-- Page Container -->
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed sidebar-inverse">


@include('layouts.inc.dealer-header-top')

@include('layouts.inc.dealer-sidebar')


<!-- Main Container -->
    <main id="main-container">
        @include('layouts.inc.alert')
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Codebase Core JS -->
<script src="{{ asset('js/codebase.app.js') }}"></script>
@stack('js')



<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "150px";
        document.getElementById("close-now").style.display = "block";

        document.getElementById("mySidebar").style.display = "inline";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("close-now").style.display = "none";
    }
</script>


</body>
</html>
