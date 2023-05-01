<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ env('APP_NAME') }} - @yield('title', 'Home')</title>

    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    @include('layouts.inc.favicons')

    <!-- Fonts and Styles -->
    @yield('css_before')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" href="{{asset("js/plugins/slick/slick.css")}}">
    <link rel="stylesheet" href="{{asset("js/plugins/slick/slick-theme.css")}}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.css') }}">
    <link rel="stylesheet" id="css-ku" href="{{ asset('css/ku.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/corporate.css') }}">
    <link rel="stylesheet" id="css-frontend" href="{{ asset('css/frontend/main.css') }}">

    @yield('css_after')

    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>

</head>
<body id="page-container" class="enable-page-overlay side-scroll bg-white">
    {{-- header top start --}}
    <div class="header__top py-10 d-none d-sm-block">
        <div class="container d-flex justify-content-between">
            <div class="d-flex">
                <div class="d-flex align-items-center mr-20">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.2875 3.75C12.02 3.89292 12.6933 4.25119 13.221 4.77895C13.7488 5.30671 14.1071 5.97995 14.25 6.7125L11.2875 3.75ZM11.2875 0.75C12.8094 0.919077 14.2287 1.60063 15.3122 2.68276C16.3957 3.76488 17.079 5.18326 17.25 6.705L11.2875 0.75ZM16.5 12.69V14.94C16.5008 15.1489 16.458 15.3556 16.3744 15.547C16.2907 15.7384 16.168 15.9102 16.014 16.0514C15.8601 16.1926 15.6784 16.3001 15.4805 16.367C15.2827 16.4339 15.073 16.4588 14.865 16.44C12.5571 16.1892 10.3402 15.4006 8.39248 14.1375C6.58035 12.986 5.04398 11.4496 3.89248 9.6375C2.62496 7.6809 1.83616 5.45325 1.58998 3.135C1.57124 2.9276 1.59589 2.71857 1.66236 2.52122C1.72882 2.32387 1.83566 2.14252 1.97605 1.98872C2.11645 1.83491 2.28733 1.71203 2.47782 1.62789C2.66831 1.54375 2.87424 1.5002 3.08248 1.5H5.33248C5.69646 1.49642 6.04932 1.62531 6.3253 1.86265C6.60128 2.09999 6.78154 2.42959 6.83248 2.79C6.92745 3.51005 7.10357 4.21705 7.35748 4.8975C7.45839 5.16594 7.48023 5.45769 7.42041 5.73816C7.36059 6.01863 7.22163 6.27608 7.01998 6.48L6.06748 7.4325C7.13515 9.31016 8.68982 10.8648 10.5675 11.9325L11.52 10.98C11.7239 10.7784 11.9813 10.6394 12.2618 10.5796C12.5423 10.5198 12.834 10.5416 13.1025 10.6425C13.7829 10.8964 14.4899 11.0725 15.21 11.1675C15.5743 11.2189 15.907 11.4024 16.1449 11.6831C16.3827 11.9638 16.5091 12.3222 16.5 12.69Z"
                            stroke="#1F1B33"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                    <a class="ml-2" href="tel:+8801788999966">+8801788999966</a>
                </div>
                <div class="d-flex align-items-center">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.00001 3H15C15.825 3 16.5 3.675 16.5 4.5V13.5C16.5 14.325 15.825 15 15 15H3.00001C2.17501 15 1.50001 14.325 1.50001 13.5V4.5C1.50001 3.675 2.17501 3 3.00001 3Z"
                            stroke="#1F1B33"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path d="M16.5 4.5L9.00001 9.75L1.50001 4.5" stroke="#1F1B33" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <a href="mailto:bvononline@gmail.com" class="ml-2">bvononline@gmail.com</a>
                </div>
            </div>
            <div class="d-flex">
                <a class="d-flex align-items-center" href="https://bvon.page.link/home">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.5 1.5H4.5C3.67157 1.5 3 2.17157 3 3V15C3 15.8284 3.67157 16.5 4.5 16.5H13.5C14.3284 16.5 15 15.8284 15 15V3C15 2.17157 14.3284 1.5 13.5 1.5Z"
                            stroke="#1F1B33"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path d="M9 13.5H9.0075" stroke="#1F1B33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="ml-2">Save big on our app!</span>
                </a>
            </div>

        </div>
    </div>
    {{-- header top end --}}

    {{-- header bottom start --}}
    <div class="header__bottom sticky-top bg-white overflow-hidden">
        <div class="header__bottom-common header__bottom-top container d-flex align-items-center py-30">
            <div class="header__bottom-common__inner header__bottom-top__left font-size-h3 font-w700">
                <a href="/">
                    <img class="logo" src="{{ asset('css/frontend/img/logo.png') }}" alt="">
                </a>
            </div>
            <div class="header__bottom-common__inner header__bottom-top__middle search">
                <div class="input-group">
                    <input type="text" class="form-control search" name="" placeholder="Search For...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="header__bottom-common__inner header__bottom-top__right ml-50 d-none d-md-block">
                <div class="d-flex justify-content-between font-w700">
                    <svg class="cursor-pointer" stroke="currentColor" fill="none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <svg class="cursor-pointer" stroke="currentColor" fill="none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <svg class="cursor-pointer" stroke="currentColor" fill="none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <svg class="cursor-pointer" stroke="currentColor" fill="none" stroke-width="3" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
        </div>
        <div class="header__bottom-common header__bottom-bottom bg-dark d-none d-sm-none d-md-block">
            <div class="container d-flex align-items-center">
                <div class="header__bottom-common__inner header__bottom-bottom__left text-white text-uppercase p-15 border-box">
                    <div class="d-flex justify-content-between align-items-center cursor-pointer">
                        <svg data-toggle="layout" data-action="side_overlay_toggle" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="2em" width="2em" xmlns="http://www.w3.org/2000/svg"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
                        <span class="font-size-h5 font-w700">Categories</span>
                        <svg id="hideCatMenu" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </div>
                <div class="header__bottom-common__inner header__bottom-bottom__middle">
                    <ul class="nav d-flex align-items-center ml-20">
                        <li class="px-4"><a href="download-app-first" class="font-w600 text-white font-size-14">All Shop</a></li>
                        <li class="px-4"><a href="download-app-first" class="font-w600 text-white font-size-14">Gift Card</a></li>
                        <li class="px-4"><a href="download-app-first" class="font-w600 text-white font-size-14">Campaigns</a></li>
                        <li class="pl-4"><a href="download-app-first" class="font-w600 text-white font-size-14">Express</a></li>
                    </ul>
                </div>
                <div class="header__bottom-common__inner header__bottom-bottom__right">
                    <ul class="nav d-flex align-items-center">
                        <li class="px-4"><a href="{{ route('admin.login') }}" class="text-white font-size-14">Admin</a></li>
                        <li class="px-4"><a href="{{ route('vendor.login') }}" class="text-white font-size-14">Merchant Zone</a></li>
                        <li class="px-4"><a href="download-app-first" class="text-white font-size-14">News Feed</a></li>
                        <li class="pl-4"><a href="download-app-first" class="text-white font-size-14">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- header bottom end --}}

    {{-- main wrapper start --}}
    <main class="main-wrapper">
        {{-- Navigation plus slider start --}}
        <div class="navigation__plus_slider">
            <div class="container d-flex">
                <div class="navigation__left mr-20 d-none d-sm-none d-md-block d-xl-block">
                    <!-- Side Content -->
                    <div class="content-side content-side-full py-0" data-toggle="slimscroll" data-height="500px" data-color="#1F1B33" data-opacity="1">
                        <!-- Side Navigation -->
                        <ul class="nav-main" >
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                                <ul>
                                    <li><a class="" href="#">All User</a></li>
                                    <li><a class="" href="download-app-first">User Cashback Wallet</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-check"></i><span class="sidebar-mini-hide">User Verification</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">User Withdrawal</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Admin Setting</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">Setting</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All User</a></li>
                                    <li><a class="" href="download-app-first">User Cashback Wallet</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-check"></i><span class="sidebar-mini-hide">User Verification</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">User Withdrawal</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Admin Setting</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">Setting</a></li>
                                </ul>
                            </li>

                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All User</a></li>
                                    <li><a class="" href="download-app-first">User Cashback Wallet</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-check"></i><span class="sidebar-mini-hide">User Verification</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">User Withdrawal</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">All Request</a></li>
                                    <li><a class="" href="download-app-first">Pending</a></li>
                                    <li><a class="" href="download-app-first">Accepted</a></li>
                                    <li><a class="" href="download-app-first">Rejected</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Admin Setting</span></a>
                                <ul>
                                    <li><a class="" href="download-app-first">Setting</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END Side Navigation -->
                    </div>
                    <!-- END Side Content -->
                </div>
                <div class="slider__right overflow-hidden">
                    <div class="slider__right-top__slider my-20">
                        <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white slick-dotted-dashed" data-dots="true" data-arrows="false">
                            <div><a href="download-app-first"><img class="img-fluid" src="{{asset("media/photos/ev_slider/ev_slide1.jpg")}}" alt=""></a></div>
                            <div><a href="download-app-first"><img class="img-fluid" src="{{asset("media/photos/ev_slider/ev_slide2.jpg")}}" alt=""></a></div>
                            <div><a href="download-app-first"><img class="img-fluid" src="{{asset("media/photos/ev_slider/ev_slide3.jpg")}}" alt=""></a></div>
                            <div><a href="download-app-first"><img class="img-fluid" src="{{asset("media/photos/ev_slider/ev_slide4.jpg")}}" alt=""></a></div>
                            <div><a href="download-app-first"><img class="img-fluid" src="{{asset("media/photos/ev_slider/ev_slide5.jpg")}}" alt=""></a></div>
                        </div>
                    </div>
                    <div class="slider__right-bottom__slider">
                        <div class="js-slider slick-nav-top" data-slick='{"slidesToShow": 2, "slidesToScroll": 2}' data-dots="false" data-arrows="true">
                            <div class="slider__right-bottom__slider__single">
                                <a href="download-app-first">
                                    <div class="slider__right-bottom__slider__single__data slider__right-bottom__slider__single__data-1">
                                        <div class="d-flex p-20 justify-content-center flex-column">
                                            <h2 class="my-5 text-white core-font-bold">Hot Deal</h2>
                                            <p class="m-0 text-white">HOT DEAL Upto 37% Discount & 70% Cashback</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="slider__right-bottom__slider__single">
                                <a href="download-app-first">
                                    <div class="slider__right-bottom__slider__single__data slider__right-bottom__slider__single__data-2">
                                        <div class="d-flex p-20 justify-content-center flex-column">
                                            <h2 class="my-5 text-white core-font-bold">Hot Deal</h2>
                                            <p class="m-0 text-white">HOT DEAL Upto 37% Discount & 70% Cashback</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="slider__right-bottom__slider__single" style="">
                                <a href="download-app-first">
                                    <div class="slider__right-bottom__slider__single__data slider__right-bottom__slider__single__data-3">
                                        <div class="d-flex p-20 justify-content-center flex-column">
                                            <h2 class="my-5 text-white core-font-bold">Hot Deal</h2>
                                            <p class="m-0 text-white">HOT DEAL Upto 37% Discount & 70% Cashback</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Navigation plus slider end --}}

        {{-- Express shop start --}}
        <div class="express__shop mt-50 overflow-hidden">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="left">
                        <h4 class="mb-2">Our Shops</h4>
                    </div>
                    <div class="right ml-auto mr-50">
                        <a href="download-app-first">
                            <h5 class="mb-2">See All</h5>
                        </a>
                    </div>
                </div>
                <div class="express__slider">
                    <div id="shop__slider" class="slick-nav-top slick-nav-express" data-slick='{"slidesToShow": 5, "slidesToScroll": 5, "draggable" : true, "loop": true}' data-dots="false" data-arrows="true">
                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/1.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/2.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/3.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/4.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>

                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/5.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/6.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">

                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/7.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/8.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/9.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/10.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/11.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/12.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/13.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/14.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/15.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/16.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/17.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/18.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>


                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/19.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/17.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/18.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>

                        <div class="d-flex flex-column">
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/19.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/17.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                            <a class="express_slider-single mb-30" href="download-app-first">
                                <div class="express_slider-single_content d-flex justify-content-center align-items-center p-10">
                                    <img src="{{ asset('media/photos/ev_slider/express/18.png') }}" alt="">
                                    <h5>Shop Name Here</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Express shop end --}}

        {{-- Product Shop by Brands start--}}
            <div class="product_area_common mt-50 overflow-hidden">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-50">
                        <div class="left">
                            <h1 class="mb-2 core-font-bold">Brands</h1>
                        </div>
                     {{--   <div class="right ml-auto">
                            <div class="input-group">
                                <input type="text" class="form-control bg-white search p-20" name="" placeholder="Search For...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-dark">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>--}}
                    </div>

                    <div class="infinity__product__list__common">
                        <div class="d-flex justify-content-start flex-wrap" style="margin-left: -15px;">
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/1.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/2.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/3.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/4.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/5.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/6.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/7.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/8.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/9.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/10.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/11.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/12.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/13.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/14.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/15.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('/media/photos/ev_slider/ev_brands/14.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>

                            {{--          <div class="infinity__product__list__common-single">
                                <div class="img-container iplcs__title">
                                    3000 + Brands Available in Bvon
                                </div>
                                <button class="btn btn-primary">View All <i class="fa fa-arrow-right"></i></button>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        {{-- Product Shop by Brands end --}}

        {{-- Product Shop by Stores start--}}
            <div class="product_area_common mt-50 pb-50 overflow-hidden">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center mb-50">
                        <div class="left">
                            <h1 class="mb-2 core-font-bold">Products</h1>
                        </div>
                        {{--           <div class="right ml-auto d-flex">
                            <div class="input-group  mr-10">
                                <input type="text" class="form-control bg-white search p-20" name="" placeholder="Search For...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-dark">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <button class="btn btn-dark">
                                <i class="fa fa-map-marker"></i>
                            </button>
                        </div>--}}
                    </div>

                    <div class="infinity__product__list__common">
                        <div class="d-flex justify-content-start flex-wrap scrolling-pagination" style="margin-left: -15px;">

                            @if($g_products->count())
                                @foreach($g_products as $product)
                                    <div class="infinity__product__list__common-single">
                                        <a href="download-app-first">
                                            <div class="img-container">
                                                <img src="{{asset('/storage/')}}/@if($product->media()->count()){{$product->media()->first()->product_image}}@endif" alt="">
                                            </div>
                                            <p class="mt-30 iplcs__title">{{ $product->product_name }}</p>
                                        </a>
                                    </div>
                                @endforeach
                                {{ $g_products->links() }}
                            @endif

                            {{-- <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/2.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/3.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/4.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/5.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/6.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/7.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/8.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/9.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/10.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/11.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/12.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/13.png') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/14.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/14.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>
                            <div class="infinity__product__list__common-single">
                                <a href="download-app-first">
                                    <div class="img-container">
                                        <img src="{{ asset('media/photos/ev_slider/ev_store/14.jpg') }}" alt="">
                                    </div>
                                    <p class="mt-30 iplcs__title">Title One Title One</p>
                                </a>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        {{-- Product Shop by Stores end --}}


    </main>
    {{-- main wrapper end --}}

    {{--Footer top start--}}
    <footer class="footer__top bg-light py-100">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-5 mb-md-0">
                    <h4 class="text-dark core-font-bold">Download</h4>
                    <a href="https://bvon.page.link/home">
                        <img src="{{asset('media/photos/ev_slider/evaly_download.png')}}" alt="">
                    </a>
                </div>
                <div class="col-md-3 mb-5 mb-md-0">
                    <h4 class="text-dark core-font-bold">Menu</h4>
                    <ul class="nav navbar-nav d-flex flex-column">
                        <li class="mb-2 font-size-16"><a href="{{ route('privacy-policy') }}" class="text-dark" target="_blank">Privacy Policy</a></li>
                        <li class="mb-2 font-size-16"><a href="download-app-first" class="text-dark">Cookie Policy</a></li>
                        <li class="mb-2 font-size-16"><a href="download-app-first" class="text-dark">Purchasing Policy</a></li>
                        <li class="mb-2 font-size-16"><a href="download-app-first" class="text-dark">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5 mb-md-0">
                    <h4 class="text-dark core-font-bold">Contact Us</h4>
                    <div class="text-black-50 font-size-16">
                        <p class="mb-2">House #12 (2nd Floor), Road #2, Sector #6 <br>Uttara, Dhaka-1230.</p>
                        <p class="mb-2">Email: bvononline@gmail.com</p>
                        <p class="mb-2">Contact no: +8801788999966</p>

                    </div>
                </div>
                <div class="col-md-3 mb-5 mb-md-0">
                    <h4 class="text-dark core-font-bold">Get In Touch</h4>
                    <div class="d-flex">
                        <a target="_blank" href="https://www.facebook.com/bVonOnlineShop" class="mr-20 text-dark"><i class="fab fa-facebook fa-2x"></i></a>
                        <a target="_blank"  href="https://www.instagram.com/bvononlineshop/" class="mr-20 text-dark"><i class="fab fa-instagram fa-2x"></i></a>
                        <a target="_blank"  href="https://www.youtube.com/channel/UCQjReg4CBYH27uINcgY2MMw?view_as=subscriber" class="mr-20 text-dark"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    {{--Footer top end--}}

    {{--Footer bottom start--}}
    <footer class="footer__bottom bg-dark">
        <div class="container">
            <p class="text-center m-0 py-10 text-white-50">&copy; 2019-{{date('Y')}} Bvon. All rights reserved.</p>
        </div>
    </footer>
    {{--Footer bottom end--}}

    {{-- Side Overlay --}}
    <aside id="side-overlay">

        <!-- Side Header -->
        <div class="content-header content-header-fullrow my-30 px-20">

            <div class="content-header-section align-parent">
                <button type="button"
                        class="btn btn-circle btn-dual-secondary align-v-r"
                        data-toggle="layout"
                        data-action="side_overlay_close"
                        style="top: -43px;background: #ddd;right: auto;left: 50%;transform: translateX(-50%);"
                >
                    <i class="fa fa-times text-danger"></i>
                </button>
                <button class="btn btn-outline-primary btn-block p-15">Login</button>
            </div>
        </div>
        <!-- END Side Header -->

        <hr class="sperator">

        <!-- Side Content -->
        <div class="content-side content-side-full py-0">
            <!-- Side Navigation -->
            <ul class="nav-main">
                <li class="">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                    <ul>
                        <li><a class="" href="download-app-first">All User</a></li>
                        <li><a class="" href="download-app-first">User Cashback Wallet</a></li>
                    </ul>
                </li>

                <li class="">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-check"></i><span class="sidebar-mini-hide">User Verification</span></a>
                    <ul>
                        <li><a class="" href="download-app-first">All Request</a></li>
                        <li><a class="" href="download-app-first">Pending</a></li>
                        <li><a class="" href="download-app-first">Accepted</a></li>
                        <li><a class="" href="download-app-first">Rejected</a></li>
                    </ul>
                </li>

                <li class="">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">User Withdrawal</span></a>
                    <ul>
                        <li><a class="" href="download-app-first">All Request</a></li>
                        <li><a class="" href="download-app-first">Pending</a></li>
                        <li><a class="" href="download-app-first">Accepted</a></li>
                        <li><a class="" href="download-app-first">Rejected</a></li>
                    </ul>
                </li>

                <li class="">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Admin Setting</span></a>
                    <ul>
                        <li><a class="" href="download-app-first">Setting</a></li>
                    </ul>
                </li>


            </ul>
            <!-- END Side Navigation -->
        </div>
        <!-- END Side Content -->
    </aside>
    {{-- END Side Overlay --}}

    {{-- Startup popup start --}}
    <div id="startupPopUp" class="startup__popup-overlay">
        <div class="startup__inner position-relative">
            <div class="startup__popup-close d-flex justify-content-end cursor-pointer position-absolute">
                <i popup="startupPopUp" class="fal fa-times text-white"></i>
            </div>
            <div class="startup__popup-content">
                <div class="">
                    <h3 class="core-font text-center bg-primary p-20 text-white">Our website is Under Construction</h3>
                    <div class="row d-flex align-items-center">
                        <div class="col-md-12">
                            <h3 class="core-font text-center m-10 text-dark">We will be lanunched in....</h3>
                            <div class="js-countdown mb-10"></div>
                        </div>
                        <div class="col-sm-6 pl-50">
                            <h1 class="core-font-bold">Please Download Our App to Shop</h1>
                            <a href="https://bvon.page.link/home">
                                <img class="app__download pb-20" src="{{ asset('media/photos/ev_slider/evaly_download.png') }}" alt="">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <img class="" src="{{ asset('css/frontend/img/underConstruction.png') }}" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Startup popup end --}}

{{--    <div class="oval__menu">
        <i id="activeOvalMenu" class="fad fa-ellipsis-v-alt text-white cursor-pointer"></i>
        <div class="oval__menu-content text-white p-100">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, atque culpa deserunt, dolor dolorum enim eveniet fugit impedit ipsam obcaecati officia officiis quae quia quidem sapiente sed ut velit voluptates.
        </div>
    </div>--}}



    <script src="{{ asset('js/codebase.app.js') }}"></script>
    @yield('js_after')
    <script src="{{asset("js/plugins/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
    <script src="{{asset("js/plugins/jquery-countdown/jquery.countdown.min.js")}}"></script>
    <script src="{{asset("js/plugins/slick/slick.min.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
    <script type="text/javascript">

        $('#hideCatMenu').click(function(){
            $('.navigation__left').toggleClass('navigation__left__toggle');
            if($('.navigation__left').hasClass('navigation__left__toggle')) {
                $('.slider__right').css({
                    flexBasis : '100%'
                })
            } else {
                $('.slider__right').css({
                    flexBasis : 'calc(80% - 20px)'
                })
            }
        });
        $('[popup]').on('click',function(){
            let id = $(this).attr('popup');
            $(`#${id}`).hide();
            let event = new Event("popupClose");
            let el = document.getElementById(id);
            el.dispatchEvent(event);
        });
        if(Cookies.get('startup-popup-close') != 'hide') {
            $('#startupPopUp').css('display', 'flex');
        }
        $('#startupPopUp').on('popupClose', function(){
            Cookies.set('startup-popup-close', 'hide', { expires: 1 });
        })
        $('#activeOvalMenu').on('click',function () {
            $('.oval__menu').toggleClass('oval__menu-active');
        })
        $('body').on('click','a[href="download-app-first"]', function(e){
            e.preventDefault();
            $("#startupPopUp").css('display', 'flex');
        });
        $('#shop__slider').slick({
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                }
            ]
        });


        $('ul.pagination').hide();
        $(function() {
            $('.scrolling-pagination').jscroll({
                autoTrigger: true,
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scrolling-pagination',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });


        // Countdown.js, for more examples you can check out https://github.com/hilios/jQuery.countdown
        class OpComingSoon {
            /*
             * Init Countdown
             *
             */
            static initCounter() {
                jQuery('.js-countdown').countdown((new Date().getFullYear()) + '/04/01', e => {
                    jQuery(e.currentTarget).html(e.strftime('<div class="row items-push text-center">'
                        + '<div class="col-6 col-sm-3"><div class="font-size-h1 font-w700 text-dark">%-D</div><div class="font-size-xs font-w700 text-primary">DAYS</div></div>'
                        + '<div class="col-6 col-sm-3"><div class="font-size-h1 font-w700 text-dark">%H</div><div class="font-size-xs font-w700 text-primary">HOURS</div></div>'
                        + '<div class="col-6 col-sm-3"><div class="font-size-h1 font-w700 text-dark">%M</div><div class="font-size-xs font-w700 text-primary">MINUTES</div></div>'
                        + '<div class="col-6 col-sm-3"><div class="font-size-h1 font-w700 text-dark">%S</div><div class="font-size-xs font-w700 text-primary">SECONDS</div></div>'
                        + '</div>'
                    ));
                });
            }

            /*
             * Init functionality
             *
             */
            static init() {
                this.initCounter();
            }
        }

        // Initialize when page loads
        jQuery(() => { OpComingSoon.init(); });
    </script>
</body>
</html>
