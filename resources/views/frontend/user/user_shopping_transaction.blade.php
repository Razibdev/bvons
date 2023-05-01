@extends('layouts.front_layout.front_layout')
@push('css')

@endpush
@section('content')

    <div class="main-transaction">
        <div class="transaction">
            <div class="tran-title">
                <div class="tran-first">
                    <div class="tran-title-single" style="width: 33% !important;">
                        <h3>Tk <?php echo number_format((float)Illuminate\Support\Facades\Auth::user()->shoppingVoucherBalance(), 2) ?> </h3>
                        <h5>Available Balance</h5>
                    </div>

                    <div class="tran-title-single" style="width: 33% !important;">
                        <h3>Tk <?php echo number_format((float)Illuminate\Support\Facades\Auth::user()->shoppingWalletBalance(), 2) ?> </h3>
                        <h5>Shopping Wallet Bvon Balance</h5>
                        <h5 style="margin-left: 20px;"><i style="font-size: 30px; cursor: pointer; color: #ffffff;" class="far fa-credit-card shopping-voucher-payment"></i></h5>
                    </div>

                    <div class="tran-title-single" style="text-align: center; width: 33% !important; ">
                        <h3 style="color:#fff !important;">Shopping Voucher Convert to E-wallet </h3>
                        <h5><i style="cursor: pointer; font-size: 25px;" class="fas fa-money-check shopping-voucher-convert"></i></h5>
                    </div>
                </div>

            </div>
            <div class="tran-body" id="transaction-now-filter-ok">
                <h3>Recent Shopping Transaction</h3>
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


    <div class="sendBalance">
        <div class="send-wrapper" id="conver_balance">
            <form action="{{url('/send-shopping-balance')}}" method="post"> {{csrf_field()}}
                <div class="form-group">
                    <input required type="text" name="amount" placeholder="Enter Amount more than 100">
                    <br><br>
                    <input type="password" name="password" placeholder="Enter Password">
                    <br><br>
                    <button type="submit" >Send</button>
                </div>
            </form>
        </div>
    </div>


    <div class="sendBalance">
        <div class="send-wrapper" id="balance_payment">
            <form action="{{url('/payment-shopping-balance')}}" method="post"> {{csrf_field()}}

                <div class="form-group">
                    <select name="username" class="js-example-basic-single" id="username" required>
                        <option value="">Choose User Name</option>
                        @foreach($merchantUsers as $merchant)
                            <option value="{{$merchant->user_id}}">{{$merchant->merchant_name}} - {{$merchant->merchant_account}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input required type="text" name="amount" placeholder="Enter Amount more than 100">
                    <br><br>
                    <input type="password" name="password" placeholder="Enter Password">
                    <br><br>
                    <button type="submit" >Send</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('js')
    <script>

        $('.shopping-voucher-convert').on('click', function () {
            $('#conver_balance').toggle();
        });

        $('.shopping-voucher-payment').on('click', function () {
            $('#balance_payment').toggle();

        });

    </script>
@endpush