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
                ajax: '{!! route('orders.pending.datatables',["req_path" => request()->path()]) !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_serial', name: 'order_serial' },
                    { data: 'user_info', name: 'user_info' },
                    { data: 'total_order', name: 'total_order' },
                    { data: 'order_status', name: 'order_status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action' },


                ],
                /*columnDefs: [
                    { targets: 1,searchable: false, visible: true },
                    { targets: 3,searchable: false, visible: true },
                    { targets: 4,searchable: false, visible: true },
                ],*/
                order: [[0, 'desc']]
            });
        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Orders</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    Your Order List
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="all-request-datatables" class="table table-bordered table-vcenter">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Order Serial</th>
                        <th>Customer Info</th>
                        <th>Order Amount</th>
                        <th>Order Status</th>
                        <th>Order Placed</th>
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
