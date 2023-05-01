<!-- Sidebar -->
<!--
    Helper classes

    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
-->

@if(auth()->check())


    <div id="mySidebar" class="sidebar" style="background: gray">
        <nav id="close-now">
            <!-- Sidebar Content -->
            <div class="dealer-sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close" onclick="closeNav()">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="link-effect font-w700" href="/">
                                <i class="si si-bubbles text-primary"></i>
                                <span class="font-size-xl text-dual-primary-dark">{{env('APP_NAME')}}</span>
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" href="javascript:void(0)">
                            <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                        </a>
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                            </li>
                            <li class="list-inline-item">
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                    <i class="si si-drop"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="si si-logout"></i>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">

                        @if(Auth::user()->dealer_referral_id != '' || Auth::user()->dealer_referral_id != null)
                        <li>
                            <a class="{{ request()->is('dealer/account') ? ' active' : '' }}" href="{{ url('/dealer/account') }}">
                                <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible">BF</span><span class="sidebar-mini-hidden">Dealer Orders</span>
                        </li>
                        <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Orders</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('dealer/account/order') ? ' active' : '' }}" href="{{ url('dealer/account/order') }}">All Orders</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('dealer/account/order/pending') ? ' active' : '' }}" href="{{url('/dealer/account/order/pending') }}">Pending Orders</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('/dealer/account/order/cancel') ? ' active' : '' }}" href="{{ url('/dealer/account/order/cancel')  }}">Cancel Orders</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('/dealer/account/order/complete') ? ' active' : '' }}" href="{{ url('/dealer/account/order/complete') }}">Complete</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('/dealer/account/order/processing') ? ' active' : '' }}" href="{{ url('/dealer/account/order/processing') }}">Processing</a>
                                </li>

                                <li>
                                    <a class="{{ request()->is('/dealer/account/order/processing') ? ' active' : '' }}" href="{{ url('/dealer/account/order/processing') }}">Shipping</a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">Dealer Stock</span>
                        </li>

                        <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Stock</span></a>
                            <ul>
                                <li>
                                    <a class="{{ request()->is('/dealer/account/product/stock') ? ' active' : '' }}" href="{{ url('/dealer/account/product/stock') }}">All Stocks</a>
                                </li>

                            </ul>
                        </li>


                            <li class="nav-main-heading">
                                <span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">Employee Arena</span>
                            </li>

                            <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Employee Arena</span></a>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('/dealer/account/employee-arena') ? ' active' : '' }}" href="{{ url('/dealer/account/employee-arena') }}">Employee Area</a>
                                    </li>

                                </ul>
                            </li>



                    @endif

                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </nav>
            <!-- END Side Navigation -->

    </div>






    <nav id="sidebar">
        <!-- Sidebar Content -->
        <div class="dealer-sidebar-content">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow px-15">
                <!-- Mini Mode -->
                <div class="content-header-section sidebar-mini-visible-b">
                    <!-- Logo -->
                    <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                    <!-- END Logo -->
                </div>
                <!-- END Mini Mode -->

                <!-- Normal Mode -->
                <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Sidebar -->

                    <!-- Logo -->
                    <div class="content-header-item">
                        <a class="link-effect font-w700" href="/">
                            <i class="si si-bubbles text-primary"></i>
                            <span class="font-size-xl text-dual-primary-dark">{{env('APP_NAME')}}</span>
                        </a>
                    </div>
                    <!-- END Logo -->
                </div>
                <!-- END Normal Mode -->
            </div>
            <!-- END Side Header -->

            <!-- Side User -->
            <div class="content-side content-side-full content-side-user px-10 align-parent">
                <!-- Visible only in mini mode -->
                <div class="sidebar-mini-visible-b align-v animated fadeIn">
                    <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                </div>
                <!-- END Visible only in mini mode -->

                <!-- Visible only in normal mode -->
                <div class="sidebar-mini-hidden-b text-center">
                    <a class="img-link" href="javascript:void(0)">
                        <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                    </a>
                    <ul class="list-inline mt-10">
                        <li class="list-inline-item">
                            <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="list-inline-item">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                <i class="si si-drop"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="si si-logout"></i>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- END Visible only in normal mode -->
            </div>
            <!-- END Side User -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li>
                        <a class="{{ request()->is('dealer/account') ? ' active' : '' }}" href="{{ url('/dealer/account') }}">
                            <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">BF</span><span class="sidebar-mini-hidden">Dealer Orders</span>
                    </li>
                    <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Orders</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('dealer/account/order') ? ' active' : '' }}" href="{{ url('dealer/account/order') }}">All Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('dealer/account/order/pending') ? ' active' : '' }}" href="{{url('/dealer/account/order/pending') }}">Pending Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('/dealer/account/order/cancel') ? ' active' : '' }}" href="{{ url('/dealer/account/order/cancel')  }}">Cancel Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('/dealer/account/order/complete') ? ' active' : '' }}" href="{{ url('/dealer/account/order/complete') }}">Complete</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('/dealer/account/order/processing') ? ' active' : '' }}" href="{{ url('/dealer/account/order/processing') }}">Processing</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('/dealer/account/order/processing') ? ' active' : '' }}" href="{{ url('/dealer/account/order/processing') }}">Shipping</a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">Dealer Stock</span>
                    </li>

                    <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Stock</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/dealer/account/product/stock') ? ' active' : '' }}" href="{{ url('/dealer/account/product/stock') }}">All Stocks</a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">Employee Arena</span>
                    </li>

                    <li class="{{ request()->is('dealer/account') || request()->is('dealer/account*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Employee Arena</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/dealer/account/employee-arena') ? ' active' : '' }}" href="{{ url('/dealer/account/employee-arena') }}">Employee Area</a>
                            </li>

                        </ul>
                    </li>



                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">Team</span><span class="sidebar-mini-hidden">Down Line</span>
                    </li>

                    <li class="{{ request()->is('dealer/account/team-arena/') || request()->is('dealer/account/team-arena/')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Team Down Line </span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/dealer/account/team-arena/') ? ' active' : '' }}" href="{{ url('/dealer/account/team-arena/') }}">Team Down Line</a>
                            </li>

                        </ul>
                    </li>


                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- Sidebar Content -->
    </nav>
    <!-- END Sidebar -->
@endif



