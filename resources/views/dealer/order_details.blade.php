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

@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product').DataTable();
        });

        $(document).ready(function () {
            $('.notable').on('click', function () {
               alert('This Product out of your stock');
            });
        });


    </script>


@endpush


@section('content')
    <!-- Page Content -->

    <div class="content">
        <div class="row">
        <div class="col-md-8">
            <!-- Products -->
            <h2 class="content-heading">
                Order Serial: <strong>{{ $order->order_serial }}</strong> <br>
                Order Placed: <strong>{{ $order->created_at->format('d/m/y - h:m a') }}</strong> <br>
                Total Ordered Products: <strong>{{ $order->manyOrders()->count()  }}</strong>
            </h2>
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive" style="overflow-x: auto">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
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
                            @foreach ($order->manyOrders as $order_detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a href="{{ route('products.details', ["id" => $order_detail->product_id]) }}" target="_blank">{{$order_detail->products->product_name}}</a></td>
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

                        <h2 class="content-heading">Payment Details ({{ $order->manyOrders()->count() }})</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-center">order_type</th>
                                <th class="text-center">transaction_id</th>
                                <th>amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order->payments as $payment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$payment->order_type}}</td>
                                    <td>{{$payment->transaction_id}}</td>
                                    <td>{{$payment->amount}}</td>

                                </tr>

                            @endforeach
                            {{--<tr>
                                <td colspan="5" class="text-right font-w600">Total Paid:</td>
                                <td class="text-right">$245,00</td>
                            </tr>--}}
                            <tr class="table-success" style="border-top: 2px solid #222;">
                                <td colspan="3" class="text-right font-w600 text-uppercase">@if($order->order_status === 'complete' && $order->payment_status === 'paid') Total Paid: @else Total Due: @endif</td>
                                <td class="text-right font-w600">{{ $order->payments()->pluck('amount')->sum() }}</td>
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
                <!-- Shipping Address -->
                <div class="col-md-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Shipping Address</h3>
                        </div>
                        <div class="block-content">
                            <address>
                                <?php
                                $address = json_decode($order->address);
                                ?>

                                <table class="table table-bordered w-100">
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <a href="{{ route('bf.user.details', ["user" => $order->user->id]) }}">{{ $order->user->name }}</a>
                                        </td>
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
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Referred By</h3>
                        </div>
                        <div class="block-content">
                            <address>

                                <table class="table table-bordered w-100">
                                    @if($order->user->referred_by)
                                        @php
                                            $referred_user = App\User::validateReferralId($order->user->referred_by)
                                        @endphp
                                        <tr>
                                            <th>Name</th>
                                            <td>
                                                <a href="{{ route('bf.user.details', ["user" => $referred_user->id]) }}">{{ $referred_user->name }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $referred_user->phone }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </address>
                        </div>
                    </div>
                </div>



                <!-- END Shipping Address -->
            </div>
            <!-- END Addresses -->
        </div>
    </div>

        <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-10">
                <form action="" method="post" class="d-inline m-2">

                    @if($values == 1)
                    <button class="btn btn-rounded text-secondary @if($order->order_status == 'pending') btn-success @else btn-secondary @endif" disabled type="submit">Pending Order</button>
                        @else
                        <a href="#" class="notable">Pending</a>
                        @endif

                </form>
                <i class="fa fa-angle-right"></i>

                <form action="{{ url('/dealer/orders/change_status/process/'.$order->id) }}" method="post" class="d-inline m-2">
                    @csrf
                    @method('patch')
                    @if($values == 1)
                    <button
                            class="btn btn-rounded @if($order->order_status == 'processing') btn-success @else btn-secondary @endif"
                            type="submit"
                            @if( $order->order_status == 'processing' || $order->order_status == 'shipped' || $order->order_status == 'complete' || $order->order_status == 'cancel' ) disabled @endif
                    >
                        Processing Order
                    </button>
                        @else
                        <a href="#" class="notable">Processing Order</a>
                    @endif

                </form>
                <i class="fa fa-angle-right"></i>

                <form action="{{url('/dealer/orders/change_status/'.$order->id) }}" method="post" class="d-inline m-2">
                    @csrf
                    @method('patch')
                    @if($values == 1)
                    <button
                            class="btn btn-rounded @if($order->order_status == 'shipped') btn-success @else btn-secondary @endif" type="submit"
                            @if( $order->order_status == 'shipped' || $order->order_status == 'complete' || $order->order_status == 'cancel' ) disabled @endif
                    >
                        Shipped Order
                    </button>
                        @else

                        <a href="#" class="notable">Shipped Order</a>
                    @endif

                </form>
                <i class="fa fa-angle-right"></i>

                <form action="{{ route('dealer.orders.complete', ["order_id" => $order->id]) }}" method="post" class="d-inline m-2">
                    @csrf

                    @if($values == 1)
                    <button
                            class="btn btn-rounded @if($order->order_status == 'complete') btn-success @else btn-secondary @endif"
                            type="submit"
                            @if( $order->order_status == 'complete' || $order->order_status == 'cancel' ) disabled @endif
                    >
                        Complete Order
                    </button>

                    @else
                        <a href="#" class="notable">Complete Order</a>
                    @endif
                </form>
                <i class="fa fa-angle-right"></i>
                <form action="{{ url('/dealer/orders/change_status/cancel/'.$order->id)}}" method="post" class="d-inline m-2">
                    @csrf
                    @method('patch')
                    <button
                            class="btn btn-rounded @if($order->order_status == 'cancel') btn-danger @else btn-outline-danger @endif"
                            type="submit"
                            @if( $order->order_status == 'complete' || $order->order_status == 'cancel' ) disabled @endif
                    >
                        Cancel Order
                    </button>
                </form>
            </div>

        </div>
    </div>

    </div>
    <!-- END Page Content -->
@endsection


