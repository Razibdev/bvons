@extends('layouts.front_layout.front_layout')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')

    <div class="main-transaction">
        <div class="transaction">
            <div class="tran-title">
                <div class="tran-first">
                    <div class="tran-title-single">
                        <h3>Tk <?php echo number_format((float)Illuminate\Support\Facades\Auth::user()->balance(), 2) ?> </h3>
                        <h5>Available Balance</h5>
                    </div>

                    <div class="tran-title-single">
                        <h3>Tk <?php echo number_format((float)Illuminate\Support\Facades\Auth::user()->pendingBalance(), 2) ?> </h3>
                        <h5>Pending for Withdraw</h5>
                    </div>
                </div>

                <div class="tran-second">

                    <div class="tan-second-single">
                        <h3><i class="fas fa-money-check withdraw-re"></i></h3>
                        <h5>Withdraw</h5>
                    </div>

                    <div class="tan-second-single">
                        <h3 class="sendBalanceTransfer"><i class="fas fa-paper-plane"></i></h3>
                        <h5>Send</h5>
                    </div>

                    <div class="tan-second-single">
                        <h3 class="paymentBalanceTransfer"><i class="far fa-credit-card"></i></h3>
                        <h5>Payment</h5>
                    </div>

                    <div class="tan-second-single">
                        <h3 class="select-form-now-ok"><i class="fas fa-history"></i></h3>
                        <h5>History</h5>
                        <form action="{{url('/e-wallet')}}" id="form-transaction"  method="get"> {{csrf_field()}}

                        <select name="transaction" id="transaction_now_ok" >
                            <option value="" selected disabled>Select transaction category</option>
                            <option value="all">All</option>
                            <option value="registration bonus">Registration Bonus</option>
                            <option value="subscription_bonus"> Subscription Bonus</option>
                            <option value="withdraw">Withdraw</option>

                            <option value="">Refunds</option>
                            <option value="product_purchase_bonus">Product Purchase Charge</option>
                            <option value="">B-courier Order Charge</option>
                            <option value="">B-courier Order Charge Refund</option>
                        </select>
                        </form>
                    </div>
                </div>

            </div>
            <div class="tran-body" id="transaction-now-filter-ok">
                <h3>Recent Transaction</h3>
                <?php $total = 0; ?>
                @foreach($transactions as $transaction)
                <div class="tran-body-single">
                    <div class="tran-same">
                        <i  @if($transaction->amount_type == "c") class="fas fa-plus-circle" @else class="fas fa-minus-circle" @endif @if($transaction->amount_type == "c") style="background-color: blue !important;" @endif ></i>
                    </div>
                    <div class="tran-same">
                        <p>{{$transaction->message}}</p>
                        <span>{{$transaction->created_at->diffForHumans()}} </span>
                    </div>
                    <div class="tran-same">
                        <p @if($transaction->amount_type == "c") style="color: blue !important;" @endif >Tk {{$transaction->amount}}</p>
                    </div>
                </div>

                    <?php

                    if($transaction->amount_type == "c"){
                        $total += $transaction->amount;
                    }
                    ?>
                @endforeach


            </div>
            <div class="tran-footer">
                <div class="tran-body-full">
                    <p>Total: {{$total}}  Tk</p>
                </div>
            </div>

        </div>
    </div>


    <div class="withdraw-main">
        <div class="withdraw-add">
            <form action="{{url('/add-payment-method')}}" method="post">{{csrf_field()}}
            <div class="group-single">
                <select name="method-add" id="method">
                    <option value="bKash">bKash</option>
                    <option value="Rocket">Rocket</option>
                    <option value="Nagad">Nagad</option>
                </select>
            </div>
            <div class="group-single">
                <input type="text" name="method_name" id="method_name" placeholder="Payment Method Name(any)">
            </div>
            <div class="group-single">
                <input type="text" name="method_number" id="method_number" placeholder="Payment Method Number">
            </div>
            <div class="group-single">
                <button type="submit" >Save</button>
            </div>
            </form>
        </div>
    </div>



    <div class="withdraw-main">
        <div class="withdraw-request">
            <form action="{{url('/withdraw-request')}}" method="post">{{csrf_field()}}

            <div class="group-single">
                <input type="text" name="amount" id="amount" placeholder="Enter Amount($300 - $5000)" required>
            </div>

            <div class="group-single">
                <select name="method" id="method" required>
                   @foreach($payments as $payment)
                        <option value="{{$payment->id}}">{{$payment->name}} &nbsp; {{$payment->details}}</option>
                    @endforeach
                </select>
            </div>

            <div class="group-single">
                <button type="submit" >Send Withdraw Request</button>
            </div>

            </form>


                <div class="group-single">
                <span>Or</span>
            </div>

            <div class="group-single">
                <a href="#" class="add-payment">Add Payment Method</a>
            </div>
        </div>
    </div>


    <div class="sendBalance">
        <div class="send-wrapper">
            <form action="{{url('/send-balance')}}" method="post"> {{csrf_field()}}
                <div class="form-group">
                    <select name="username" class="js-example-basic-single" id="username" required>
                        <option value="">Choose User Name</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}} - {{$user->referral_id}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input required type="text" name="amount" id="amount" placeholder="Enter Amount more than 100">
                    <br><br>

                    <input required type="password" name="password" id="passwordSend" placeholder="Enter Password here.....">
                    <i class="fas fa-eye" id="nowSend" style="position: absolute; right: 43px; margin-top: 15px;" onclick="mySendFunction()"></i>

                    <br><br>

                    <button type="submit" >Send</button>
                </div>
            </form>
        </div>
    </div>



    <div class="paymentBalance">
        <div class="payment-wrapper">
            <form action="{{url('/payment-balance')}}" method="post"> {{csrf_field()}}
                <div class="form-group">
                    <select name="username" class="js-example-basic-single" id="username" required>
                        <option value="">Choose User Name</option>
                        @foreach($merchantUsers as $merchant)
                            <option value="{{$merchant->user_id}}">{{$merchant->merchant_name}} - {{$merchant->merchant_account}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input required type="text" name="amount" id="amount" placeholder="Enter Amount more than 100">
                    <br><br>

                    <input required type="password" name="password" id="passwordPayment" placeholder="Enter Password here.....">
                    <i class="fas fa-eye" id="nowpayment" style="position: absolute; right: 43px; margin-top: 15px;" onclick="myFunction()"></i>
                    <br><br>

                    <button type="submit" >Payment</button>
                </div>
            </form>
        </div>
    </div>





 @endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function () {
            $('#transaction_now_ok').on('change', function () {
                this.form.submit();
            })
        });

        $('.sendBalanceTransfer').on('click', function () {
            $('.send-wrapper').toggle();
        });

        $('.paymentBalanceTransfer').on('click', function () {
            $('.payment-wrapper').toggle();
        });


        function myFunction() {
            var x = document.getElementById("passwordPayment");
            if (x.type === "password") {
                x.type = "text";
                $('#nowpayment').addClass("fa-eye-slash");
                $('#nowpayment').removeClass("fa-eye");

            } else {
                x.type = "password";
                $('#nowpayment').removeClass("fa-eye-slash");
                $('#nowpayment').addClass("fa-eye");

            }
        }


        function mySendFunction() {
            var x = document.getElementById("passwordSend");
            if (x.type === "password") {
                x.type = "text";
                $('#nowSend').addClass("fa-eye-slash");
                $('#nowSend').removeClass("fa-eye");

            } else {
                x.type = "password";
                $('#nowSend').removeClass("fa-eye-slash");
                $('#nowSend').addClass("fa-eye");

            }
        }


    </script>
@endpush