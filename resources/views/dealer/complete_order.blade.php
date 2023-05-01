@extends('layouts.dealer')

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
            $('#all-request-datatables').DataTable();
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
            <div class="block-content block-content-full" style="overflow-x: auto">
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
                    <tbody>
                    @foreach($completeOrders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->order_serial}}</td>
                            <td>
                                <table style="background: #0a0a0a; color: #ffffff;">
                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{$order->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Phone</td>
                                        <td>{{$order->user->phone}}</td>
                                    </tr>
                                </table>
                            </td>
                            <td>{{$order->order_amount}}</td>
                            <td>{{$order->order_status}}</td>
                            <td>{{ \Carbon\Carbon::parse( $order->created_at )->format('d/m/Y - h:i a') }}</td>
                            <td><a href="{{url('/dealer/account/order/complete/'.$order->id)}}">View Details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
