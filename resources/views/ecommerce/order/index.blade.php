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
        <h2 class="font-w700 text-black mb-10">Order List</h2>
    </div>

    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Product Name </th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th >Quantity</th>
                        <th >Shop Name</th>
                        <th >Customer Name</th>
                        <th >Customer Phone</th>
                        <th >Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)

                    <tr>
                        <td class="text-center">1</td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->product_name}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->product_price}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted"> <p style="background-color:{{$order->color}};height:30px;width:100;border-style: solid ;"></p> </em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->size}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->product_quantity}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->shop_id}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->name}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">{{$order->phone}}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted">
                            @if($order->order_status !==4)
                                <p>Pending</p>
                            @else
                                <p>Complete</p>
                            @endif
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
