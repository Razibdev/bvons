<nav id="sidebar" >
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
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close" onclick="navClose()">
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
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
            </div>
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
        </div>

        <div class="content-side content-side-full">
            <ul class="nav-main">

                <li class="{{ request()->is('/page/post/') || request()->is('/page/post/*') || request()->is('/page/post/')|| request()->is('/page/post/')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Post</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/page/post/create') ? ' active' : '' }}" href="{{route('page.post.create')}}">Page Post Create</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/page/post/view') ? ' active' : '' }}" href="{{route('page.post.view')}}">Page Post View</a>
                        </li>
                    </ul>
                </li>


                @if(\Illuminate\Support\Facades\Auth::user()->quizze == 1)
                <li class="{{ request()->is('/quizze/') || request()->is('/quizze/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Quizze</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/quizze/add_quizze') ? ' active' : '' }}" href="{{route('quizze.add.quizze')}}">Quizze Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('/quizze/view/quizze') ? ' active' : '' }}" href="{{route('quizze.view.quizze')}}">Quizze View</a>
                        </li>
                    </ul>
                </li>

                @endif


                @if(\Illuminate\Support\Facades\Auth::user()->quizze == 1 && \Illuminate\Support\Facades\Auth::user()->quizze_exam == 1)
                    <li class="{{ request()->is('/quizze/exam') || request()->is('/quizze/exam/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Quizze Exam</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/quizze/exam/add_quizze_exam') ? ' active' : '' }}" href="{{route('quizze.exam.add.quizze.exam')}}">Quizze Exam Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('/quizze/exam/view/quizze') ? ' active' : '' }}" href="{{route('quizze.view.quizze.exam')}}">Quizze Exam View</a>
                            </li>
                        </ul>
                    </li>


                    <li class="{{ request()->is('/quizze/exam/complain/') || request()->is('/quizze/exam/complain/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Complain Report</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/quizze/exam/complain/report') ? ' active' : '' }}" href="{{route('quizze.exam.complain.report')}}">Complain Report</a>
                            </li>

                        </ul>
                    </li>

                @endif






                @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                    <li class="{{ request()->is('/user/history') || request()->is('/user/history/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">History</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('/user/history/add-matrix') ? ' active' : '' }}" href="{{route('user.history.add.matrix')}}">Add Matrix</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('/user/history/view-matrix') ? ' active' : '' }}" href="{{route('user.history.view.matrix')}}">View Matrix</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('/user/history') ? ' active' : '' }}" href="{{route('user.history.machine')}}">User History Mache</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('/user/history/salary') ? ' active' : '' }}" href="{{route('user.history.salary')}}">Designation Salary</a>
                            </li>
                        </ul>
                    </li>

                @endif


                <li class="{{ request()->is('/charity/sub-admin') || request()->is('/charity/sub-admin*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Charity</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/charity/sub-admin/history') ? ' active' : '' }}" href="{{route('charity.sub.admin.history')}}">Charity Transaction</a>
                        </li>

                    </ul>
                </li>




                <li class="{{ request()->is('/bvon/blood/user/') || request()->is('/bvon/blood/user/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Blood</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/bvon/blood/user/add-status') ? ' active' : '' }}" href="{{route('bvon.blood.user.add.status')}}">Add Status</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('/bvon/blood/user/view-status') ? ' active' : '' }}" href="{{route('bvon.blood.user.view.status')}}">View Status</a>
                        </li>

                    </ul>
                </li>


                <li class="{{ request()->is('/page/boost/') || request()->is('page/boost') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Page Boost</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/page/boost/add_page_boost') ? ' active' : '' }}" href="{{route('page.boost.add.page.boost')}}">Add Page Boost</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('/bvon/blood/user/view_page_boost') ? ' active' : '' }}" href="{{route('page.boost.view.page.boost')}}">View Page Boost</a>
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
