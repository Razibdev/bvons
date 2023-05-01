<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
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
                    <a class="link-effect font-w700" href="{{ route('mainpage') }}">
                        <i class="si si-bubbles text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">{{ env('APP_NAME') }}</span>
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
                        <form id="logout-form" action="{{ route('vendor.logout') }}" method="POST" style="display: none;">
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
                    <a class="#" href="{{url('/b_learning_school/dashboard') }}">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>


                {{-- Vendor Start Here--}}
                @hasanyrole('vendor|administrator')
                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Vendor</span><span class="sidebar-mini-hidden">Vendor Panel</span>
                </li>
                <li class="{{ request()->is('blearning/categories') || request()->is('blearning/categories*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Categories</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('blearning/categories/create') ? ' active' : '' }}" href="{{route('blearning.categories.create')}}">Category Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/blearning/categories/view') ? ' active' : '' }}" href="{{route('blearning.categories.view')}}">Categories Show</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('blearning/course') || request()->is('blearning/course/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Course</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/blearning/course/create') ? ' active' : '' }}" href="{{route('blearning.course.create')}}">Course Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/blearning/course/view') ? ' active' : '' }}" href="{{route('blearning.course.view')}}">Course Show</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('blearning/teacher') || request()->is('blearning/teacher/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Teacher</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/blearning/teacher/create') ? ' active' : '' }}" href="{{route('blearning.teacher.create')}}">Teacher Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/blearning/teacher/view') ? ' active' : '' }}" href="{{route('blearning.teacher.view')}}">Teacher Show</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('blearning/subject') || request()->is('blearning/subject/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Subject</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/blearning/subject/create') ? ' active' : '' }}" href="{{route('blearning.subject.create')}}">Subject Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/blearning/subject/view') ? ' active' : '' }}" href="{{route('blearning.subject.view')}}">Subject Show</a>
                        </li>
                    </ul>
                </li>


                @endhasanyrole
                {{-- Vendor End Here--}}


            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->
