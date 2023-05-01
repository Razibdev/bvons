@extends('layouts.dealer')

@section('css_before')
@endsection

@section('css_after')
    <style>
        *[contenteditable]:focus {
            color: deepskyblue;
            font-size: 16px;
        }
    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product').DataTable();
        });


    </script>


@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                </h3>
            </div>
            <div class="block-content block-content-full" style="overflow-x: auto;">
                <table class="table table-bordered" id="dealer-product">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ORDER SERIAL</th>
                        <th>ORDER AMOUNT</th>
                        <th>ORDER STATUS</th>
                        <th>ORDER PLACED</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_serial}}</td>
                        <td>{{$order->order_amount}}</td>
                        <td>{{$order->order_status}}</td>
                        <td>{{$order->created_at}}</td>
                        <td><a href="{{url('/dealer/account/order/details/'.$order->id)}}" >View Details</a></td>
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
