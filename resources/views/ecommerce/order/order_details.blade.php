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
    <!-- Progress -->

{{--
 @if($orders->order_status==1)
    <h2 class="content-heading">
        <button type="button" class="btn btn-sm btn-secondary float-right">
            <i class="fa fa-check text-success mr-5"></i>Complete
        </button>
        <button type="button" class="btn btn-sm btn-secondary float-right mr-5">
            <i class="fa fa-times text-danger mr-5"></i>Cancel
        </button>
        Progress
    </h2>
 @else
  <!-- write logic -->
 @endif
--}}


    <div class="row">
        <div class="col-md-8">
            <!-- Products -->
            <h2 class="content-heading">
                Order Serial: <strong>{{ $order_details->first()->order_serial }}</strong> <br>
                Order Placed: <strong>{{ \Carbon\Carbon::create($order_details->first()->created_at)->format('d/m/y - h:m a') }}</strong> <br>
                Total Ordered Products: <strong>{{ $order_details->count()  }}</strong>
            </h2>
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th class="text-center">Stock</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">QTY</th>
                                <th class="text-right">PRICE</th>
                                <th class="text-right">TOTAL PRICE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total_price = 0;
                            @endphp
                            @foreach ($order_details as $order_detail)
                                <tr>
                                    <td><a class="font-w600" href="#">{{$order_detail->id}}</a></td>
                                    <td><a href="{{ route('products.show', ["product" => $order_detail->product_id]) }}" target="_blank">{{$order_detail->product_name}}</a></td>
                                    <td class="text-center"><a href="#">{{$order_detail->stock}}</a></td>
                                    <td class="text-center">{{$order_detail->size}}</td>
                                    <td class="text-center"><span style="background: {{$order_detail->color}}; display:block; width: 30px; height: 30px; margin: auto"></span></td>
                                    <td class="text-center">{{$order_detail->product_quantity}}</td>
                                    <td class="text-right">{{$order_detail->product_price}}</td>
                                    <td class="text-right">{{$order_detail->product_price * $order_detail->product_quantity}}</td>
                                </tr>
                                @php
                                    $total_price += $order_detail->product_quantity * $order_detail->product_price;
                                @endphp
                            @endforeach
                            {{--<tr>
                                <td colspan="5" class="text-right font-w600">Total Paid:</td>
                                <td class="text-right">$245,00</td>
                            </tr>--}}
                            <tr class="table-success" style="border-top: 2px solid #222;">
                                <td colspan="7" class="text-right font-w600 text-uppercase">Total Price:</td>
                                <td class="text-right font-w600">{{ $total_price }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Products -->
        </div>

        <div class="col-md-4">

            <!-- Addresses -->
            <h2 class="content-heading">Addresses</h2>
            <div class="row row-deck gutters-tiny">
                <!-- Billing Address -->
                {{--<div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Billing Address</h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-lg text-black mb-5">{{ $order_details->first()->user_name }}</div>
                            <address>
                                5110 8th Ave<br>
                                New York 11220<br>
                                United States<br><br>
                                <i class="fa fa-phone mr-5"></i> (999) 111-222222<br>
                                <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)">company@example.com</a>
                            </address>
                        </div>
                    </div>
                </div>--}}
                <!-- END Billing Address -->

                <!-- Shipping Address -->
                <div class="col-md-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Shipping Address</h3>
                        </div>
                        {{--@php echo count($order_details->first()->address); die; @endphp--}}
                        @if($order_details->first()->address != '' ||  $order_details->first()->address != NULL)
                        <div class="block-content">
                            <address>
                                <?php
                                    $address = json_decode($order_details->first()->address);
                                ?>

                                <table class="table table-bordered w-100">
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $order_details->first()->user_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $address->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td>{{ $address->district }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $address->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>P.S</th>
                                        <td>{{ $address->ps }}</td>
                                    </tr>
                                    <tr>
                                        <th>Road no</th>
                                        <td>{{ $address->road_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>House No</th>
                                        <td>{{ $address->house_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>Postal code</th>
                                        <td>{{ $address->postal_code }}</td>
                                    </tr>
                                    <tr>
                                        <th>Full Address</th>
                                        <td>{{ $address->address }}</td>
                                    </tr>
                                </table>

                            </address>
                        </div>
                            @endif
                    </div>
                </div>
                <!-- END Shipping Address -->


            </div>
            <!-- END Addresses -->
        </div>
    </div>







</div>
<!-- END Page Content -->
@endsection
