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
                    <a class="#" href="{{route('mainpage') }}">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
                    </a>
                </li>


{{-- Vendor Start Here--}}
                @hasanyrole('vendor|administrator')
                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">Vendor</span><span class="sidebar-mini-hidden">Vendor Panel</span>
                </li>
                <li class="{{ request()->is('products') || request()->is('products/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Products</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('products/create') ? ' active' : '' }}" href="{{route('products.create')}}">Products Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('products') ? ' active' : '' }}" href="{{route('products.index')}}">Products Show</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('shops') || request()->is('shops/*') && !request()->is('shops/admin/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Shops</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('shops/create') ? ' active' : '' }}" href="{{route('shops.create')}}">Shop Add</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('shops') ? ' active' : '' }}" href="{{route('shops.index')}}">Shop Show</a>
                        </li>
                    </ul>
                </li>

                <li class="{{ request()->is('users/orders/') || request()->is('users/orders/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Order</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('users/orders/all') ? ' active' : '' }}" href="{{route('orders.index')}}">All Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('users/orders/pending') ? ' active' : '' }}" href="{{route('orders.pending')}}">Pending Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('users/orders/processing') ? ' active' : '' }}" href="{{route('orders.processing')}}">Processing Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('users/orders/shipped') ? ' active' : '' }}" href="{{route('orders.shipped')}}">Shipped Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('users/orders/complete') ? ' active' : '' }}" href="{{route('orders.complete')}}">Complete Orders</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('users/orders/cancel') ? ' active' : '' }}" href="{{route('orders.cancel')}}">Cancel Orders</a>
                        </li>

                    </ul>
                </li>



                <li class="{{ request()->is('low/stock/products') || request()->is('stock/products')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Stock</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('low/stock/products') ? ' active' : '' }}" href="{{route('low_stock')}}">Low Stock</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('stock/products') ? ' active' : '' }}" href="{{route('all_stock')}}">Stock</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('/dealer/product-stock') || request()->is('/dealer/product-stock')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Dealer Stock</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/dealer/product-stock') ? ' active' : '' }}" href="{{url('/dealer/product-stock')}}">Add Dealer Stock</a>
                        </li>
                    </ul>
                </li>



                @endhasanyrole
{{-- Vendor End Here--}}



{{-- Admin Start Here --}}
                @hasanyrole('administrator')





                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">Admin</span><span class="sidebar-mini-hidden">Admin</span>
                    </li>
                    <li class="{{ request()->is('vendor') || request()->is('vendor/*') && !request()->is('vendor/orders/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Vendors</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('vendor/list') ? ' active' : '' }}" href="{{route('register.vendor.list')}}">All Vendor</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('vendor/register') ? ' active' : '' }}" href="{{route('register.vendor.show')}}">Create New Vendor</a>
                            </li>
                            </ul>
                    </li>
                    <li class="{{ request()->is('shops/admin') || request()->is('shops/admin/*') || request()->is('shops/*/edit')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Shop</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('shops/admin/all') ? ' active' : '' }}" href="{{route('shops.all')}}">All</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('shops/admin/pending') ? ' active' : '' }}" href="{{route('shops.pending')}}">Pending</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('shops/admin/accepted') ? ' active' : '' }}" href="{{route('shops.accepted')}}">Accepted</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('category') || request()->is('category/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Category</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('category/create') ? ' active' : '' }}" href="{{route('category.create')}}">Category Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('category') ? ' active' : '' }}" href="{{route('category.index')}}">Category Show</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('subcategory') || request()->is('subcategory/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Sub Category</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('subcategory/create') ? ' active' : '' }}" href="{{route('subcategory.create')}}">Sub Category Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('subcategory') ? ' active' : '' }}" href="{{route('subcategory.index')}}">Sub Category Show</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('brands') || request()->is('brands/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Brands</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('brands/create') ? ' active' : '' }}" href="{{route('brands.create')}}">Brands Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('brands') ? ' active' : '' }}" href="{{route('brands.index')}}">Brands Show</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('products') || request()->is('products/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Products</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('products/all') ? ' active' : '' }}" href="{{route('products.all')}}">All Products</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('products/trashed') ? ' active' : '' }}" href="{{route('products.trashed')}}">Products Restore</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('products/pending') ? ' active' : '' }}" href="{{route('products.pending')}}">Pending</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('products/show_product_to_dealer') ? ' active' : '' }}" href="{{route('products.show-product-to-dealer')}}">Add Products To B-Dealer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('vendor/orders') || request()->is('vendor/orders/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Order</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('vendor/orders/admin') ? ' active' : '' }}" href="{{route('vendor.orders.admin')}}">All Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('vendor/orders/admin/pending') ? ' active' : '' }}" href="{{route('vendor.orders.admin.pending')}}">Pending Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('vendor/orders/admin/cancel') ? ' active' : '' }}" href="{{route('vendor.orders.admin.cancel')}}">Cancel Orders</a>
                            </li>

                            <li>
                                <a class="{{ request()->is('vendor/orders/admin/complete') ? ' active' : '' }}" href="{{route('vendor.orders.admin.complete-list')}}">Complete Orders</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('vendor/orders/admin/processing') ? ' active' : '' }}" href="{{route('vendor.orders.admin.processing')}}">Processing Orders</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('vendor/orders/admin/shipped') ? ' active' : '' }}" href="{{route('vendor.orders.admin.shipped')}}">Shipped Orders</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('hotproducts') || request()->is('hotproducts/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Hot Products</span></a>
                        <ul>
                         <li>
                                <a class="{{ request()->is('hotproducts') ? ' active' : '' }}" href="{{route('hotproducts.index')}}">Hot Product Add</a>
                            </li>
                             <li>
                                <a class="{{ request()->is('hotproducts/show') ? ' active' : '' }}" href="{{route('hotproducts.show')}}">Hot Product Show</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('slider') || request()->is('slider/*') || request()->is('sliderDetails')|| request()->is('sliderDetails/*')  ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Slider</span></a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('slider/create') ? ' active' : '' }}" href="{{route('slider.create')}}">Slider Add</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('slider') ? ' active' : '' }}" href="{{route('slider.index')}}">Slider Show</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('sliderDetails') ? ' active' : '' }}" href="{{route('sliderDetails.index')}}">Product Show</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('sliderDetails/create') ? ' active' : '' }}" href="{{route('sliderDetails.create')}}">Product Create</a>
                            </li>
                        </ul>
                    </li>



                <li class="{{ request()->is('social') || request()->is('social/*') || request()->is('social')|| request()->is('social/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Social</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('social/post') ? ' active' : '' }}" href="{{route('social.post')}}">Post</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('social/post-hide') ? ' active' : '' }}" href="{{route('social.post.hide')}}">Hide Product</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('social/comment') ? ' active' : '' }}" href="{{route('social.comment')}}">Comment</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('sliderDetails/create') ? ' active' : '' }}" href="{{route('sliderDetails.create')}}">Share</a>
                        </li>
                    </ul>
                </li>



                <li class="{{ request()->is('page') || request()->is('page/*') || request()->is('page')|| request()->is('page/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Page</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('page/create') ? ' active' : '' }}" href="{{route('page.create')}}">Page Create</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('page/page-view') ? ' active' : '' }}" href="{{route('page.page.view')}}">Page View</a>
                        </li>
                    </ul>
                </li>



                <li class="{{ request()->is('/b_learning_school') || request()->is('/b_learning_school/*') || request()->is('/b_learning_school/')|| request()->is('/b_learning_school/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Blearning</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/b_learning_school/dashboard') ? ' active' : '' }}" href="{{route('blearning.dashboard')}}">View Blearning</a>
                        </li>

                    </ul>
                </li>


                <li class="{{ request()->is('/matrix') || request()->is('/matrix/*') || request()->is('/matrix/')|| request()->is('/matrix/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Matrix</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/matrix/user') ? ' active' : '' }}" href="{{route('matrix.user.commission')}}">Add Matrix</a>
                            <a class="{{ request()->is('/matrix/user/view') ? ' active' : '' }}" href="{{route('matrix.user.view')}}">View Matrix</a>
                            <a class="{{ request()->is('/matrix/user/view/position') ? ' active' : '' }}" href="{{route('matrix.user.view.position')}}">View Matrix Position</a>
                            <a class="{{ request()->is('/matrix/user/line') ? ' active' : '' }}" href="{{route('matrix.user.line')}}">Downline Matrix</a>
                        </li>

                    </ul>
                </li>



                <li class="{{ request()->is('/quizze') || request()->is('/quizze/*') || request()->is('/quizze/')|| request()->is('/quizze/*')  ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Quizze User</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/quizze/add-user') ? ' active' : '' }}" href="{{route('quizze.add.user')}}">Add User for Quizze</a>
                            <a class="{{ request()->is('/quizze/user/view') ? ' active' : '' }}" href="{{route('quizze.user.view')}}">View Quizze User</a>
                        </li>

                    </ul>
                </li>



                <li class="{{ request()->is('/quizze/question') || request()->is('/quizze/question') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Quizze Question</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/quizze/question/add-question') ? ' active' : '' }}" href="{{route('quizze.question.add.question')}}">Add Quizze Question</a>
                            <a class="{{ request()->is('/quizze/question/question') ? ' active' : '' }}" href="{{route('quizze.question.question')}}">View Quizze Question</a>
                            <a class="{{ request()->is('/quizze/question/add-exam') ? ' active' : '' }}" href="{{route('quizze.question.add.exam')}}">Add Quizze Exam</a>
                            <a class="{{ request()->is('/quizze/question/exam') ? ' active' : '' }}" href="{{route('quizze.question.exam')}}">View Quizze Exam</a>
                            <a class="{{ request()->is('/quizze/question/exam/complain/report') ? ' active' : '' }}" href="{{route('quizze.question.exam.complain.report')}}">All Complain</a>
                        </li>

                    </ul>
                </li>

                <li class="{{ request()->is('/boost-type/') || request()->is('/boost-type/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Boost Type</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/boost-type/add-type') ? ' active' : '' }}" href="{{route('boost.type.add.type')}}">Add Boost Type</a>
                            <a class="{{ request()->is('/boost-type/view-type') ? ' active' : '' }}" href="{{route('boost.type.view.type')}}">View Boost Type</a>
                        </li>
                    </ul>
                </li>


                <li class="{{ request()->is('/boost-history/') || request()->is('/boost-history/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Boost History</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/boost-history/view-all-history') ? ' active' : '' }}" href="{{route('boost.history.view.all.history')}}">View Boost History</a>
                        </li>
                    </ul>
                </li>


                @endhasanyrole



                <li class="{{ request()->is('/charity/') || request()->is('/charity/*') ? ' open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-action-redo"></i><span class="sidebar-mini-hide">Charity</span></a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('/charity/add-event') ? ' active' : '' }}" href="{{route('charity.add.event')}}">Add Event</a>
                            <a class="{{ request()->is('/charity/view-event') ? ' active' : '' }}" href="{{route('charity.view.event')}}">View All Event</a>
                           </li>
                    </ul>
                </li>





{{-- Admin End Here --}}
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->
