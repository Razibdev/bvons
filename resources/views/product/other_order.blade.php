@extends('layouts.front_layout.front_layout')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection.select2-selection--single{
            width:210px;
            height: 35px;
            margin-top: 10px;
        }
    </style>
@endpush
@section('content')

    <div class="checkout-main-page">
        <form action="{{url('/checkout')}}" method="post" >{{csrf_field()}}
            <div class="checkout">
                <?php $total_amount = 0; $sub_item = 0; ?>
                @foreach($userCart as $cart)
                    <div class="row">

                        <div class="checkout-single">
                            <img src="{{asset('/storage/'.$cart->product_image)}}" width="100" height="100"  alt="">
                        </div>

                        <div class="checkout-single">
                            <h4>{{$cart->product_name}} <span>{{$cart->size}} <span style="background:{{$cart->color}}; padding-left: 10px; padding-right: 10px; margin-left: 5px;"></span> </span></h4>
                        </div>

                        <div class="checkout-single">
                            <p>{{$cart->quantity}}</p>
                        </div>

                        <div class="checkout-single">

                           <p>{{$cart->price * $cart->quantity}}</p>

                        </div>

                        <?php

                            $total_amount = $total_amount + ($cart->price * $cart->quantity);
                            $sub_item = $sub_item + $cart->quantity;

                        ?>

                    </div>
                @endforeach
                <div class="sidebar-checkout">

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

                </div>

            </div>




            <div class="sidebar-order-checkout">

                <?php
                $shipaddress = null;
                if ($deliveryaddressCount > 0){
                    $shipaddress = json_decode($deliveryaddress->address);

                }


                $useradd = null;
                if($useraddresses->address !=''){
                    $useradd = json_decode($useraddresses->address);

                }

                ?>

                <div class="billing">
                    <h4 id="billing">BILLING ADDRESS <i class="fas fa-angle-down"></i></h4>
                    <div class="billing-fade">

                        <div class="group">
                            <label for="billing_name">Full Name</label>
                            <input type="text" name="billing_name" id="billing_name" placeholder="Enter your Name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="group">
                            <label for="billing_address">Address</label>
                            <input type="text" name="billing_address" id="billing_address" placeholder="Enter Address" @if(isset($useradd->billing_address))  value=" {{$useradd->billing_address}}" @endif required>
                        </div>

                        <div class="group">
                            <div class="group-together">
                                <label for="billing_house">House NO:</label>
                                <input type="text" name="billing_house" id="billing_house"  @if(isset($useradd->billing_house))  value="{{$useradd->billing_house}}" @endif placeholder="Enter House Number">
                            </div>
                            <div class="group-together">
                                <label for="billing_road">Road NO:</label>
                                <input type="text" name="billing_road" id="billing_road" @if(isset($useradd->billing_road))  value="{{$useradd->billing_road}}" @endif placeholder="Enter Road Number">
                            </div>
                        </div>

                        <div class="group">
                            <label for="billing_phone">Phone Number</label>
                            <input type="text" name="billing_phone" id="billing_phone" @if(isset($useradd->billing_phone))  value="{{$useradd->billing_phone}}" @endif required placeholder="Enter Pho9ne Number">
                        </div>


                        <div class="group">

                            <div class="group-to-three">
                                <label for="billing_city">City</label><br>
                                <select name="billing_city" id="billing_city">
                                    <option style="color: #444;" value="">Choose City</option>
                                    @foreach($cities as $city)
                                        <option style="color: #444;" value="{{$city->id}}"  @if(isset($useradd->billing_city))  @if($city->id == $useradd->billing_city ) selected @endif  @endif >{{$city->name}} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="group-to-three">
                                <label for="billing_thana">Thana</label><br>
                                <select name="billing_thana" id="billing_thana">
                                    <option style="color: #000;" value="">Choose Thana</option>
                                </select>
                            </div>


                            <div class="group-to-three">
                                <label for="billing_pincode">Zip</label>
                                <input type="text" name="billing_pincode" id="billing_pincode" placeholder="optional"  @if(isset($useradd->billing_zip))  value="{{$useradd->billing_zip}}" @endif >
                            </div>

                            <div class="col-md-12">
                                <label for="bill2ship" style="margin-top: 27px;">If Your Billing Address and Shipping address is Same</label>
                                <input type="checkbox" name="" id="bill2ship" style="display: inline; overflow: auto; color: #444; margin-top: -22px;margin-left: 50px;">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="shipping">
                    <h4 id="shipping">Shipping ADDRESS <i class="fas fa-angle-down"></i> </h4>
                    <div class="shipping-fade">

                        <div class="group">
                            <label for="shipping_address">Address</label>
                            <input type="text" name="shipping_address" id="shipping_address" @if(isset($shipaddress->address))  value="{{$shipaddress->address}}" @endif placeholder="Enter Address">
                        </div>

                        <div class="group">
                            <div class="group-together">
                                <label for="shipping_house">House NO:</label>
                                <input type="text" name="shipping_house" id="shipping_house"  @if(isset($shipaddress->house_no))   value="{{$shipaddress->house_no}}" @endif placeholder="Enter House Number">
                            </div>
                            <div class="group-together">
                                <label for="shipping_road">Road NO:</label>
                                <input type="text" name="shipping_road" id="shipping_road"  @if(isset($shipaddress->road_no))  value="{{$shipaddress->road_no}}" @endif placeholder="Enter Road Number"  >
                            </div>
                        </div>

                        <div class="group">
                            <label for="shipping_phone">Phone Number</label>
                            <input type="text" name="shipping_phone" id="shipping_phone" @if(isset($shipaddress->phone))  value="{{$shipaddress->phone}}" @endif placeholder="Enter Pho9ne Number">
                        </div>


                        <div class="group">

                            <div class="group-to-three">
                                <label for="shipping_city">City</label>
                                <select name="shipping_city" id="shipping_city">
                                    <option value="" style="color: #444;">Choose City</option>
                                    @foreach($cities as $city)
                                        <option style="color: #444;" value="{{$city->id}}" @if(isset($shipaddress->district))  @if($shipaddress->district == $city->id)  selected @endif  @endif >{{$city->name}}</option>

                                    @endforeach
                                </select>
                            </div>


                            <div class="group-to-three">
                                <label for="shipping_thana">Thana</label>
                                <select style="color: #000;" name="shipping_thana" id="shipping_thana">
                                    <option style="color: #000;" value="">Choose Thana</option>
                                </select>
                            </div>


                            <div class="group-to-three">
                                <label for="shipping_pincode">Zip</label>
                                <input type="text" name="shipping_pincode" id="shipping_pincode" placeholder="optional" @if(isset($shipaddress->postal_code))  value="{{$shipaddress->postal_code}}" @endif >
                            </div>
                        </div>
                    </div>
                </div>



                <div class="method">
                    <h4 id="method">Shipping Method <i class="fas fa-angle-down"></i></h4>
                    <div class="method-fade">

                        <div class="group">
                            <label for="shipping_method">Delivary Boy</label>
                            <input type="radio" name="shipping_method" id="shipping_method" value="Delivary Boy">
                        </div>


                        <div class="group">
                            <label for="shipping_method">Courier Service</label>
                            <input type="radio" name="shipping_method" id="shipping_method" value="Courier Service">
                        </div>


                    </div>
                </div>

                <div class="payment_method">
                    <h4>Payment Method </h4>
                    <div class="payment_method-fade">

                        <div class="group">
                            <label for="payment_method">Cash On Delivery</label>
                            <input type="radio" name="payment_method" id="payment_method" value="Cash On Delivery">
                        </div>


                        <div class="group">
                            <label for="payment_method">Nagad</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_method" id="payment_method" value="nagad">
                        </div>

                        <div class="payment-fade-now" id="paymentnagad">
                            <h4>Nagad</h4>
                            <h4>Receiver Account NO: 01744444444</h4>
                            <div class="group">
                                <input type="text" name="payment_number" id="payment_number" placeholder="Sender Phone Number">
                            </div>

                            <div class="group">
                                <input type="text" name="payment_transaction" id="payment_transaction" placeholder="Transaction Id">
                            </div>

                            <div class="group">
                                <input type="text" name="payment_amount" id="payment_amount" placeholder="Amount">
                            </div>
                        </div>


                        <div class="group">
                            <label for="payment_method">Bikash</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="payment_method" id="payment_method" value="bikash">
                        </div>


                        <div class="payment-fade-now" id="paymentbikash">
                            <h4>Bikash</h4>
                            <h4>Receiver Account NO: 01744444444</h4>
                            <div class="group">
                                <input type="text" name="payment_number" id="payment_number" placeholder="Sender Phone Number">
                            </div>

                            <div class="group">
                                <input type="text" name="payment_transaction" id="payment_transaction" placeholder="Transaction Id">
                            </div>

                            <div class="group">
                                <input type="text" name="payment_amount" id="payment_amount" placeholder="Amount">
                            </div>
                        </div>


                    </div>
                </div>


                <div class="checkout-now-button">
                    <div class="submit-checkout">
                        <input type="hidden" name="grand_total" value="{{$total_amount}}">
                        <input type="hidden" name="type" value="other">
                        <button type="submit">PROCEED TO CHECKOUT</button>
                    </div>
                </div>



            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>



        $(document).ready(function () {
            $('#billing_city').on('change', function () {
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/change-thana/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#billing_thana').empty();
                        $('#billing_thana').append(`<option value="0" disabled selected>Select Billing Thana*</option>`);
                        response.forEach(element => {
                            $('#billing_thana').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                    }
                });
            });
        });


        $(document).ready(function () {
            $('#shipping_city').on('change', function () {
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/change-thana/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#shipping_thana').empty();
                        $('#shipping_thana').append(`<option value="0" disabled selected>Select Shipping Thana*</option>`);
                        response.forEach(element => {
                            $('#shipping_thana').append(`<option value="${element['id']}">${element['name']}</option>`);
                    });
                    }
                });
            });
        });


        $(document).ready(function() {
            $("input[name$='payment_method']").click(function() {
                var test = $(this).val();

                $("div.desc").hide();
                $("#payment" + test).show();
            });
        });




        $('#bill2ship').on('click', function () {
            if (this.checked) {
                $('#shipping_address').val($('#billing_address').val());
                $('#shipping_city').val($('#billing_city').val());
                $('#shipping_thana').val($('#billing_thana').val());
                $('#shipping_phone').val($('#billing_phone').val());
                $('#shipping_house').val($('#billing_house').val());
                $('#shipping_road').val($('#billing_road').val());
                $('#shipping_zip').val($('#billing_zip').val());
            } else {
                $('#shipping_address').val('');
                $('#shipping_city').val('');
                $('#shipping_thana').val('');
                $('#shipping_phone').val('');
                $('#shipping_house').val('');
                $('#shipping_road').val('');
                $('#shipping_zip').val('');
            }
        });
    </script>
    <script>


        $("#billing_city").select2({

        });

        $("#billing_thana").select2({

        });

        $("#shipping_city").select2({

        });

        $("#shipping_thana").select2({

        });


    </script>
@endpush