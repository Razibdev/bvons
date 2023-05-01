@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#all-request-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('products.all.datatables') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'thumbnail', name: 'thumbnail' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'vendor.name', name: 'vendor.name' },
                    { data: 'shop.shop_name', name: 'shop.name' },
                    { data: 'user_price', name: 'user_price' },
                    { data: 'product_permision', name: 'product_permision' },
                    { data: 'show_to_dealers', name: 'show_to_dealers' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'action', name: 'action' },
                ],
                columnDefs: [
                    { targets: 1,searchable: false, visible: true },
                    { targets: 3,searchable: false, visible: true },
                    { targets: 4,searchable: false, visible: true },
                ],
                order: [[0, 'desc']]
            });
        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">All Product</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    All Product
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="all-request-datatables" class="table table-bordered table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Thumbnail</th>
                        <th>product_name</th>
                        <th>Vendor Name</th>
                        <th>Shop Name</th>
                        <th>M.R.P</th>
                        <th>Status</th>
                        <th>Show To B-Dealer</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
