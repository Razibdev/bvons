@extends('ecommerce.eco_layout.main')

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
        <h2 class="font-w700 text-black mb-10">Cancel List</h2>
    </div>

    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Amount</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Quantity</th>
                        <th style="width: 15%;">Payment</th>
                        <th style="width: 15%;">Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                    <tr>
                        <td class="text-center">1</td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->order_amount}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->order_status}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">

                                @php
                                if($order->payment_status==1){
                                echo "Pending";
                                }
                                else{
                                echo "Paid";
                                }
                                @endphp
                            </em>
                        </td>

                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">
                                <a class="btn btn-success" href="{{ route('orders.show',$order->id) }}">Details</a>

                            </em>
                        </td>
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
