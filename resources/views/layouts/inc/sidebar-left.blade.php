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
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">BF</span><span class="sidebar-mini-hidden">Bvon Users</span>
                </li>
                <li class="{{ request()->is('dashboard/bf/user') || request()->is('dashboard/bf/user/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/bf/user') ? ' active' : '' }}" href="{{ route('bf.user') }}">All User</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bf/user/create') ? ' active' : '' }}" href="{{ route('bf.user.create') }}">Create New User</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bf/user') ? ' active' : '' }}" href="{{ route('bf.user') }}">User Cashback Wallet</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bf/user/assign_job') ? ' active' : '' }}" href="{{ route('bf.user.assign_job') }}">Assign Job</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bf/user/job_list') ? ' active' : '' }}" href="{{ route('bf.user.job-list') }}">User Job List</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('dashboard/user_verification') || request()->is('dashboard/user_verification/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-check"></i><span class="sidebar-mini-hide">User Verification</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/user_verification/bp_request') ? ' active' : '' }}" href="{{route('user_verification.bp_request')}}">All Request</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_verification/bp_request/pending') ? ' active' : '' }}" href="{{route('user_verification.bp_request_pending')}}">Pending</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_verification/bp_request/accepted') ? ' active' : '' }}" href="{{route('user_verification.bp_request_accepted')}}">Accepted</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_verification/bp_request/rejected') ? ' active' : '' }}" href="{{route('user_verification.bp_request_rejected')}}">Rejected</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('dashboard/user_withdrawal') || request()->is('dashboard/user_withdrawal/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-credit-card"></i><span class="sidebar-mini-hide">User Withdrawal</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal') ? ' active' : '' }}" href="{{route('user_withdrawal')}}">All Request</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/pending') ? ' active' : '' }}" href="{{route('user_withdrawal.pending')}}">Pending</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/accepted') ? ' active' : '' }}" href="{{route('user_withdrawal.accepted')}}">Accepted</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/rejected') ? ' active' : '' }}" href="{{route('user_withdrawal.rejected')}}">Rejected</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/account_activation') ? ' active' : '' }}" href="{{route('user_withdrawal.account.activation')}}">Account Activation</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/shopping_voucher') ? ' active' : '' }}" href="{{route('user_withdrawal.shopping.voucher')}}">Shopping Voucher</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/user_withdrawal/shopping_wallet') ? ' active' : '' }}" href="{{route('user_withdrawal.shopping.wallet')}}">Shopping Balance</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('dashboard/admin_setting') || request()->is('dashboard/admin_setting/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Admin Setting</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/setting') ? ' active' : '' }}" href="{{route('admin.setting.index')}}">Setting</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/pin-generate') ? ' active' : '' }}" href="{{route('admin.setting.pin')}}">Pin Generate</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/use-pin-generate') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/use-pin-generate')}}">Used Pin Generate</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/doctor-member-pin-generate') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/doctor-member-pin-generate')}}">Doctor Member Pin Generate</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/doctor-member-pin-generate-use') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/doctor-member-pin-generate-use')}}">Used Doctor Member Pin</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/get-commission') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/get-commission')}}">Package Budget Distribution </a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/get-id-cart') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/get-id-cart')}}">Id Card Pending</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/get-id-cart-giving') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/get-id-cart-giving')}}">Id Card Already Given</a>
                        </li>


                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/monthly-salary') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/monthly-salary')}}">Monthly Salary </a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/monthly-salary-history') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/monthly-salary-history')}}">Salary History</a>
                        </li>


                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/doctor-service-renew-pincode') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/doctor-service-renew-pincode')}}">Doctor Renew Pin Generate</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/admin_setting/doctor-service-used-renew-pincode') ? ' active' : '' }}" href="{{url('dashboard/admin_setting/doctor-service-used-renew-pincode')}}">Doctor Used Renew Pin</a>
                        </li>



                    </ul>
                </li>




                <li class="{{ request()->is('dashboard/report') || request()->is('dashboard/report/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fad fa-file-chart-pie"></i><span class="sidebar-mini-hide">Reports</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/report') ? ' active' : '' }}" href="{{ route('report.index') }}">Report</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Area/Zone</span>
                </li>
                <li class="{{ request()->is('dashboard/') || request()->is('dashboard/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Area/Zone</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/area') ? ' active' : '' }}" href="{{ route('user.area') }}">All Area List</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/district_thana/create') ? ' active' : '' }}" href="{{ route('b-dealer.distrinct_thana.create') }}">Create Zone/District/Thana/Village</a>
                        </li>
                    </ul>
                </li>



                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">BF</span><span class="sidebar-mini-hidden">Bvon Bcourier</span>
                </li>
                <li class="{{ request()->is('bcourier/delivery_boy') || request()->is('bcourier/delivery_boy/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fad fa-file-chart-pie"></i><span class="sidebar-mini-hide">Bcourier</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('bcourier/delivery_boy') ? ' active' : '' }}" href="{{ route('bco.delivery_boy.index') }}">Delivery Boy</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('bcourier/parcel_type') || request()->is('bcourier/parcel_type/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fad fa-file-chart-pie"></i><span class="sidebar-mini-hide">Parcel Type</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('bcourier/parcel_type') ? ' active' : '' }}" href="{{ route('bco.percel_type.index') }}">Parcel Type</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('bcourier/parcel_type/create') ? ' active' : '' }}" href="{{ route('bco.percel_type.create') }}">Add Parcel Type</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('bcourier/parcel') || request()->is('bcourier/parcel/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fad fa-file-chart-pie"></i><span class="sidebar-mini-hide">Parcel</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('bcourier/parcel') ? ' active' : '' }}" href="{{ route('bco.percel.index') }}">All Parcel</a>
                        </li>
                    </ul>
                </li>


                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">B-Dealer</span>
                </li>
                <li class="{{ request()->is('b_dealer') || request()->is('b_dealer/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">B-Dealer</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('b_dealer/active') ? ' active' : '' }}" href="{{ route('b-dealer.active') }}">B-Dealer Active</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/create') ? ' active' : '' }}" href="{{ route('b-dealer.create') }}">Create New B-Dealer</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/request') ? ' active' : '' }}" href="{{ route('b-dealer.request') }}">B-Dealer Request</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('b_dealer/orders') || request()->is('b_dealer/orders/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">B-Dealer Order</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'all' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'all'])}}">All Orders</a>
                        </li>
                        <li>

                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'pending' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'pending'])}}">Pending Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'processing' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'processing'])}}">Processing Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'shipped' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'shipped'])}}">Shipped Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'complete' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'complete'])}}">Complete Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('b_dealer/orders') && request()->query('status') === 'cancel' ? ' active' : '' }}" href="{{route('bdealer.orders', ['status' => 'cancel'])}}">Cancel Orders</a>
                        </li>
                    </ul>
                </li>




                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Vendor/Merchant</span>
                </li>
                <li class="{{ request()->is('dashboard/vendor_merchant') || request()->is('dashboard/vendor_merchant/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Vendor/Merchant</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/vendor_merchant/merchant/add-account') ? ' active' : '' }}" href="{{ route('merchant.add.account') }}">Create Merchant Account</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/vendor_merchant/merchant/') ? ' active' : '' }}" href="{{ route('merchant.view') }}">View Merchant Account</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Bvon/Doctor</span>
                </li>
                <li class="{{ request()->is('dashboard/bvon-doctor') || request()->is('dashboard/bvon-doctor/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Bvon Doctor</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/add-doctor') ? ' active' : '' }}" href="{{ route('bvon.add.doctor') }}">Add Doctor</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/view-doctor/') ? ' active' : '' }}" href="{{ route('bvon.doctor.view') }}">View Doctor</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/doctor-register-user-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.register.user.list') }}">Register User List</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/doctor-patient-prescription-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.patient.prescription.list') }}">Patient Prescription List</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/bvon-doctor-chamber-created') ? ' active' : '' }}" href="{{ route('bvon.doctor.chamber.create') }}">New Bvon Doctor Chamber</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/bvon-doctor-chamber-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.chamber.list') }}">Bvon Doctor Chamber List</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/bvon-doctor-add-service-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.add.service.list') }}">Bvon Doctor Add Service</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/bvon-doctor-service-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.service.list') }}">Bvon Doctor Service List</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/bvon-doctor-field-officer-work-list') ? ' active' : '' }}" href="{{ route('bvon.doctor.officer.work.list') }}">BD Field Officer Work List</a>
                        </li>


                    </ul>
                </li>



                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Bvon/Doctor/Officer</span>
                </li>
                <li class="{{ request()->is('dashboard/bvon-doctor') || request()->is('dashboard/bvon-doctor/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide"> Doctor Officer</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/add-doctor-officer') ? ' active' : '' }}" href="{{ route('bvon.doctor.add.officer') }}">Add Doctor officer</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/view-doctor-officer') ? ' active' : '' }}" href="{{ route('bvon.doctor.view.officer') }}">View Doctor</a>
                        </li>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-doctor/district-doctor-officer') ? ' active' : '' }}" href="{{ route('bvon.doctor.district.officer') }}">View District Officer</a>
                            <a class="{{ request()->is('dashboard/bvon-doctor/upazilla-doctor-officer') ? ' active' : '' }}" href="{{ route('bvon.doctor.upazilla.officer') }}">View Upazilla Officer</a>
                            <a class="{{ request()->is('dashboard/bvon-doctor/field-doctor-officer') ? ' active' : '' }}" href="{{ route('bvon.doctor.field.officer') }}">View Field Officer</a>
                        </li>

                    </ul>
                </li>











                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Quizze Section</span>
                </li>
                <li class="{{ request()->is('dashboard/bvon-quizze') || request()->is('dashboard/bvon-quizze/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide"> Quizze Teacher</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-quizze/add-quizze-teacher') ? ' active' : '' }}" href="{{ route('bvon.quizze.add.teacher') }}">Add Quizze Teacher</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-quizze/view-quizze-teacher') ? ' active' : '' }}" href="{{ route('bvon.quizze.view.teacher') }}">View Quizze Teacher</a>
                        </li>


                    </ul>
                </li>


                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">B Pay</span>
                </li>
                <li class="{{ request()->is('dashboard/bvon-pay') || request()->is('dashboard/bvon-pay/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">B Pay</span></a>
                    <ul>

                        <li>
                            <a class="{{ request()->is('dashboard/bvon-pay/bpay-add-category') ? ' active' : '' }}" href="{{ route('bvon.bpay.add.category') }}">Add Category</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-pay/bpay-view-categories') ? ' active' : '' }}" href="{{ route('bvon.bpay.view.category') }}">View Categories</a>
                        </li>


                        <li>
                            <a class="{{ request()->is('dashboard/bvon-pay/add-marchant-shop') ? ' active' : '' }}" href="{{ route('bvon.bpay.add.marchant.shop') }}">Add Marchant Shop</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('dashboard/bvon-pay/view-marchant-shop') ? ' active' : '' }}" href="{{ route('bvon.bpay.view.marchant.shop') }}">View Marchant Shop List</a>
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
