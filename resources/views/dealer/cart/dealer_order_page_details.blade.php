@extends('layouts.front_layout.front_layout')


@section('css_after')
    <style>
        .out{
            display: none;
        }
        .in{
            display: inline;
        }
    </style>
@endsection

@section('content')

    <div class="order-details-wrapper">
        <div class="cart">
            <div class="cart-body">
                <table style="width: 1340px !important; overflow-x: scroll;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Proudct Details</th>
                        <th>Specification</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach($orderdetials as $detail)
                        <tr>
                            @php
                                $product_d = json_decode($detail->product_json)->product_details;
                                $order_d = json_decode($detail->product_json, true)["order_details"];
                                $specifications = $order_d["specification"];
                                $totalPrice += $detail->quantity * $order_d["price"];
                            @endphp
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('products.details', ["id" => $product_d->id]) }}">{{ $product_d->product_name }}</a>
                            </td>
                            <td>
                                <table class="table table-bordered" style="width: 600px !important;">
                                    <tr>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                    @foreach($specifications as $specification)
                                        <tr>
                                            <td>{{ $specification["size"] }}</td>
                                            <td>{{ $specification["quantity"] }}</td>
                                            <td>{{ $order_d["price"] }}</td>
                                            <td>{{ $specification["quantity"] * $order_d["price"] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                            <td>{{ $detail->quantity * $order_d["price"] }}</td>
                            <td>{{date('d-m-Y', strtotime($detail->created_at ))}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" class="text-right">Total Price</th>
                        <td>{{ $totalPrice }}</td>
                    </tr>


                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection








