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
                        <h3>Tk <?php echo number_format((float)Illuminate\Support\Facades\Auth::user()->merchantBalance(), 2) ?> </h3>
                        <h5>Available Balance</h5>
                    </div>

                    <div class="tran-title-single">
                        <h3><button class="sell_merchant_amount" style="width: 175px;height: 40px;border: none;border-radius: 10px;cursor: pointer;">Sell Merchant Amount</button> </h3>
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




  

    <div class="sendBalance">
        <div class="send-wrapper">
            <form action="{{url('/sell-merchant-balance')}}" method="post"> {{csrf_field()}}
                <div class="form-group">
                    <select name="username" class="js-example-basic-single" id="username" required>
                        <option value="">Choose User Name</option>
                       @foreach($users as $user)
                            <option value="{{$user->id}}-{{$user->referral_id}}">{{$user->name}} - {{$user->referral_id}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input required type="text" name="amount" id="amount" placeholder="Enter Amount">
                    <br><br>

                    <input required type="password" name="password" placeholder="Enter Password here.....">
                    <br><br>

                    <button type="submit" >Sell</button>
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

        $('.sell_merchant_amount').on('click', function () {
            $('.send-wrapper').toggle();
        });

    </script>
@endpush