@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/js/plugins/select2/css/select2.min.css')}}">
    <style>
        button{
            float: right;
            border: none;
            height: 50px;
            background-color: #dddddd;
            border-radius: 10px;
        }



        .paymentBalance{
            background: transparent;
            width: 100%;
            height: auto;
            background: darkgoldenrod;
        }

        .paymentBalance .payment-wrapper{
            position:absolute;
            top: 41%;
            left: 40%;
            transform: translate(-50%, -50%);
        }

        .paymentBalance .payment-wrapper{
            left: 45%;
        }

        .paymentBalance .payment-wrapper {
            background: #ffffff;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
            display: none;
        }
        .paymentBalance .payment-wrapper .form-group{
            width: 100%;
            margin-bottom: 20px;
            text-align: center;

        }
        .paymentBalance .payment-wrapper .form-group select{
            width: 100%;
            height: 40px !important;
        }
        .paymentBalance .payment-wrapper .form-group input{
            width: 100%;
            height: 40px;
        }
        .paymentBalance .payment-wrapper .form-group button{
            width: 50%;
            height: 45px;
            border: none;
            cursor: pointer;
        }
    </style>
@endsection

@section('js_after')
    <script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/js/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(".shopping_wallet_add_minus").on("click", function () {
                $(".payment-wrapper").toggle();
            });
        })
    </script>

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Merchant Full Transaction Details  <button class="shopping_wallet_add_minus">Add or Minus Transaction</button></h2>

        {{--@if($user->check_user_is_verified())--}}

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header bg-gd-light block-header-default">
                        <h2 class="block-title">
                            <i class="fa fa-money"></i> Transaction
                        </h2>
                    </div>


                    <div class="paymentBalance">
                        <div class="payment-wrapper">
                            <form action="{{route('merchant.account.add.balance')}}" method="post"> {{csrf_field()}}
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <select name="amount_type" required>
                                        <option value="c">Add Balance</option>
                                        <option value="d">Sub Balance</option>
                                    </select>
                                    <br><br>
                                    <input required type="text" name="amount" id="amount" placeholder="Enter Amount more than 100">
                                    <br><br>
                                    <button type="submit" >Shopping Balance</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start" style="background: none">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">

                                            <tr class="bg-gd-light">
                                                <th>Date</th>
                                                <th>Transaction Type</th>
                                                <th>Message</th>
                                                <th>Amount</th>
                                            </tr>
                                            @if($transctions->count())

                                                @foreach($transctions as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->created_at->format('d/m/y h:i a') }}</td>
                                                        <td>{{ ucfirst(str_replace('_', ' ', $transaction->category)) }}</td>
                                                        <td>{{ $transaction->message }}</td>
                                                        <th style="color: {{ $transaction->amount_type == 'c' ? 'lightgreen' : 'red' }}">{{ $transaction->amount }}</th>
                                                    </tr>
                                                @endforeach
                                                <tr class="ml-auto mr-auto">
                                                    <td colspan="4">{{ $transctions->links() }}</td>
                                                </tr>
                                                <tr style="border-top: 2px solid #222;">
                                                    <th colspan="3" style="text-align: right">Total Balance</th>
                                                    <th>{{ $user->merchantBalance() }}</th>
                                                </tr>

                                            @else


                                                <tr>
                                                    <td class="text-center" colspan="3">No Data Found</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--@endif--}}
    </div>
    <!-- END Page Content -->
@endsection
