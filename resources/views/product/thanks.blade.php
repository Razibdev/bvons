@extends('layouts.front_layout.front_layout')

@section('content')
    <div class="order-details-wrapper">
        <div class="cart">
            <div class="cart-body">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Srial Number</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->order_serial}}</td>
                            <td>{{$order->order_amount}}</td>
                            <td>@if($order->order_status == 'cancel') Cancelled @else {{$order->order_status}} @endif </td>
                            <td>{{$order->payment_status}}</td>
                            <td><a href="#" @if($order->order_status != 'complete' || $order->order_status != 'cancel') data-id="{{$order->order_id}}" class="order-cancel-guser" @endif > Cancel</a> &nbsp; <button type="button"  class="order_details" data-id="{{$order->order_id}}">Order Details</button></td>
                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
            <div class="center">
                <div class="panel">
                    <div class="panel-title">
                        <h3>Order Details</h3>
                        <p><i class="fas fa-times crossButton" onclick="crossButton();"></i></p>
                    </div>
                    <div class="panel-body">
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Quanity</th>
                                <th>Date & Time</th>
                                <th>Price</th>
                            </tr>
                            </thead>

                            <tbody id="table-row">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('js')

    <script>


        $(document).on('click', '.order_details', function () {
            var id = $(this).data("id");
            $.ajax({
                dataType:'json',
                type:"GET",
                url: "{{url('/order_details_page_now')}}",
                data:{ 'id':id},
                success:function(data){

                    var letus = $(window).scrollTop() + $(window).height() - 700;
                    var nowokk = letus+"px";

                    $('.panel').css("margin-top", nowokk);
                    $('.panel').toggle();

                    console.log(data);
                        var hmlt = '';
                        var i = -1;
                        var total = 0;

                    $.each(data, function(index, element) {
                        var arr = element.formatted_date.split("|");
                        while( i < index){
                            hmlt += '<tr><td>' + element.id + '</td> <td>' + element.product_name + '</td> <td>' + element.size + '</td> <td>' + element.product_quantity + '</td> <td>' +arr[0]+'<br>' +arr[1]  + '</td> <td>'+element.product_price+ '</td> </tr>';
                            i++;
                            total += element.product_quantity * element.product_price;
                        }


                    });
                    hmlt += '<tr><td style="text-align: right;" colspan="5">Total Price</td> <td>'+total+'</td></tr>';
                    $('#table-row').html(hmlt)

                }
            });

        });


        $('.collapse').on('show.bs.collapse', function() {
            $(this).parent().removeClass("zeroPadding");
        });

        $('.collapse').on('hide.bs.collapse', function() {
            $(this).parent().addClass("zeroPadding");
        });

        $(document).on('click', '.order-cancel-guser', function () {

            let id = $(this).data('id');

            $.ajax({
                dataType:'json',
                type:"GET",
                url: "{{url('/update-dealer-product-status-gcart')}}",
                data:{ 'id':id},
                success:function(data){
                    window.location = '/thanks';

                }
            });
        });
    </script>
@endpush






