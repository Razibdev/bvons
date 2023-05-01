@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Dashboard</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div>
        <div class="row">
            <div class="col-md-3 col-xl-3">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted text-center text-uppercase">total user</p>
                        <h2 class="text-uppercase text-center">100</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xl-3">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted text-center text-uppercase">total BP</p>
                        <h2 class="text-uppercase text-center">100</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xl-3">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted text-center text-uppercase">total AS</p>
                        <h2 class="text-uppercase text-center">100</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-xl-3">
                <div class="block">
                    <div class="block-content">
                        <p class="text-muted text-center text-uppercase">total MM</p>
                        <h2 class="text-uppercase text-center">100</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Recent User <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th style="width: 15%;">Registered</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i = 1; $i < 21; $i++)
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="font-w600">
                                <a href="javascript:void(0)">John Doe</a>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                client{{ $i }}<em class="text-muted">@example.com</em>
                            </td>
                            <td>
                                <em class="text-muted">{{ rand(2, 10) }} days ago</em>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>




    <!-- END Page Content -->
@endsection
