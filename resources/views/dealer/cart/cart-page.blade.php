@extends('layouts.front_layout.front_layout')

@section('content')
    <div class="cart-main-wrapper">
        <div class="cart-wrapper">
            <?php $total_amount = 0; $sub_item = 0; ?>
            <div class="cart">
                @foreach($userCart as $cart)

                    <div class="row">

                        <div class="cart-single">
                            <img src="{{asset('/storage/'.$cart->product_image)}}"  alt="">
                        </div>

                        <div class="cart-single">
                            <h4>{{$cart->product_name}} <span>{{$cart->size}} <span style="background:{{$cart->color}}; padding-left: 10px; padding-right: 10px; margin-left: 5px;"></span> </span></h4>
                        </div>

                        <div class="cart-single input-group">
                            <input  type="button" value="-"
                                    class="btn button-minus" data-field="quantity" data-id="{{$cart->id}}" data-product_id="{{$cart->product_id}}">
                            <input type="text" step="1" min="0" size="1" max="" name="quantity" value="{{$cart->quantity}}"
                                   class="form-control quantity-field-{{$cart->id}} product_quantity" style="max-width: 52px;"  data-id="{{$cart->id}}" data-product_id="{{$cart->product_id}}">
                            <input  type="button" value="+"
                                    class="btn button-plus" data-field="quantity" data-id="{{$cart->id}}" data-product_id="{{$cart->product_id}}">
                        </div>

                        <div class="cart-single">
                           <p>{{$cart->price}}</p>
                        </div>

                        <div class="cart-single">
                            <a  title="Delete Product" href="javascript:void(0)" name="quantity" data-id="{{$cart->id}}"  class="confirmDelete"><i class="far fa-trash-alt"></i></a>
                        </div>



                        <?php
                            
                            $total_amount = $total_amount + ($cart->price * $cart->quantity);
                            $sub_item = $sub_item + $cart->quantity;

                        ?>


                    </div>
                @endforeach

            </div>



            <div class="sidebar">
                <form action="{{url('/dealer-checkout')}}" method="post">{{csrf_field()}}
                <div class="sidebar-single">
                    <h4>Order Summary</h4>
                </div>

                <div class="sidebar-single">
                    <h5>Subtotal (<?php echo $sub_item ?> items)
                    </h5>
                    <h5>Tk <?php echo $total_amount; ?></h5>
                </div>

                
                <div class="sidebar-single">
                    <h5>Total
                    </h5>
                    @if(!empty(Session::get('CouponAmount')))
                        <?php
                        $total_amount = $total_amount - Session::get('CouponAmount');
                        ?>
                        <h5>৳ <?php echo $total_amount; ?></h5>
                    @else
                        <h5>৳ <?php echo $total_amount; ?></h5>
                    @endif

                </div>

                <div class="sidebar-single">
                    <div class="group">
                        <label for="address">Delivery Address</label>
                        <input type="text" name="address" id="address" value="{{$delers->name}}">
                    </div>
                </div>
                <div class="sidebar-single">
                    <input type="hidden" name="grand_total" value="{{$total_amount}}">
                    <button class="btn btn-primary" type="submit">PROCEED TO CHECKOUT</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        $(document).ready(function(){
            $(document).on('change', '.product_quantity', function () {
                let quantity = $(this).val();
                let id = $(this).data('id');
                let product_id = $(this).data('product_id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-dealer-product-quantity')}}",
                    data:{'quantity': quantity, 'product_id' : product_id, 'id':id},
                    success:function(data){
                        window.location = '/page_cart';

                    }
                });
            });


            $(document).on('click', '.button-minus', function () {

                let id = $(this).data('id');
                let quantity = $('.quantity-field-'+id).val();
                let product_id = $(this).data('product_id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-dealer-product-quantity')}}",
                    data:{'quantity': quantity, 'product_id' : product_id, 'id':id},
                    success:function(data){
                        window.location = '/page_cart';

                    }
                });
            });


            $(document).on('click', '.button-plus', function () {
                let id = $(this).data('id');
                let quantity = $('.quantity-field-'+id).val();
                let product_id = $(this).data('product_id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-dealer-product-quantity')}}",
                    data:{'quantity': quantity, 'product_id' : product_id, 'id':id},
                    success:function(data){
                        window.location = '/page_cart';

                    }
                });
            });
        });






        $(function () {

            function incrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal)) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }


            }

            function decrementValue(e) {
                e.preventDefault();
                var fieldName = $(e.target).data('field');
                var parent = $(e.target).closest('div');
                var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                if (!isNaN(currentVal) && currentVal > 0) {
                    parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                } else {
                    parent.find('input[name=' + fieldName + ']').val(0);
                }

            }

            $('.input-group').on('click', '.button-plus', function (e) {
                incrementValue(e);
            });

            $('.input-group').on('click', '.button-minus', function (e) {
                decrementValue(e);
            });
        });



        $(document).ready(function () {
            $(document).on('click', '.confirmDelete', function () {

                let name = $(this).attr('name');
                let id = $(this).data('id');

                if (confirm('Are you want to delete this product')) {

                    window.location.href = "/delete-"+name+"/"+id;
                }
            });
        });
    </script>
@endpush




