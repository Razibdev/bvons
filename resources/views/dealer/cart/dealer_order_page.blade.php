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
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Serial Number</th>
                        <th>PinCode</th>
                        <th>Amount</th>
                        <th>status</th>
                        <th>Delivery Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dealerOrderDetails as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->serial}}</td>
                            <td>{{$order->pin}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->delivery_address}}</td>
                            <td><a href="#" @if($order->status != 'complete' || $order->status != 'cancel')  href="#" data-id="{{$order->id}}" class="order-cancel-user" @endif > Cancel</a>  &nbsp;  &nbsp; &nbsp; &nbsp;<a href="{{url('/dealer_order_details_page_now/'.$order->id)}}">
                                    Order Details
                                </a></td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@push('js')

    <script>

        $('.collapse').on('show.bs.collapse', function() {
            $(this).parent().removeClass("zeroPadding");
        });

        $('.collapse').on('hide.bs.collapse', function() {
            $(this).parent().addClass("zeroPadding");
        });




        $(document).on('click', '.order-cancel-user', function () {

            let id = $(this).data('id');

            $.ajax({
                dataType:'json',
                type:"GET",
                url: "{{url('/update-dealer-product-status-cart')}}",
                data:{ 'id':id},
                success:function(data){
                    window.location = '/dealer_orders_page';

                }
            });
        });
    </script>
    @endpush






