@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('title', "B-Dealer Orders")


@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#all-request-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('bdealer.orders.datatables', ["status" => $status]) !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'order_by', name: 'order_by' },
                    { data: 'order_to', name: 'order_to' },
                    { data: 'serial', name: 'serial' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action' },

                ],
                columnDefs: [
                    { targets: 7,orderable: false, visible: true },
                ],
                order: [[0, 'desc']]
            });
        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">B-Dealer Orders</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Order List
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table id="all-request-datatables" class="table table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Order By</th>
                            <th>Order To</th>
                            <th>serial</th>
                            <th>status</th>
                            <th>Order Date</th>
                            <th>Updated Date</th>
                            <th>action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
