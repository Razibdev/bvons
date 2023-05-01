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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('/css/ku.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/corporate.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

@yield('css_before')



@yield('css_after')

<!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<!-- Page Container -->
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed sidebar-inverse">
@include('layouts.inc.sidebar-right')

@include('layouts.inc.sidebar-left')

@include('layouts.inc.header-top')

    <!-- Main Container -->
    <main id="main-container">
        @include('layouts.inc.alert')
        @yield('content')
    </main>
    <!-- END Main Container -->

<!-- Footer -->
@include('layouts.inc.footer')
<!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Codebase Core JS -->
<script src="{{ asset('js/codebase.app.js') }}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@stack('js')

@yield('js_after')
</body>
</html>
