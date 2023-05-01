@extends('layouts.front_layout.front_layout')

@push('css')
    <style>
        .nav-item.nav-link{
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }
        .nav-item.nav-link.active{
            background: #cae8e4;
        }
        .wallet-icon{
            font-size: 25px;
        }
    </style>
@endpush
@section('content')
    <main class="main-wrapper">
        <div class="product_area_common mt-50 overflow-hidden">
            <div class="container">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-5">
                        <p>Dealer Bouns</p>
                    </div>
                    <div class="col-md-5 col-md-offset-2" style="position: fixed;margin: auto;width: 428px;right: 5px;">
                        <select name="" id="" class="form-control">
                            <option value="all">All</option>
                            <option value="registration">Registration Bonus</option>
                            <option value="subscription">Subscription</option>
                            <option value="withdraw">Withdraw</option>
                            <option value="refund">Refunds</option>
                            <option value="purchase_charge">Product Purchase Charge</option>
                            <option value="b-courier_charge">B-Courier Order Charge</option>
                            <option value="b-courier_charge_refund">B-Courier Order Charge Refund</option>
                        </select>
                    </div>
                </div>



                <div class="row" style="margin-bottom: 20px;">

                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded ">
                            <div class="row mx-md-n6">
                                <div class="col-md-2 px-md-2"><div class="p-3">
                                        <i class="fas fa-plus-circle " style="font-size: 40px; margin-right: 5px; color: #294dd0;"></i>
                                    </div></div>

                                <div class="col-md-8 px-md-2"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <p style="padding: 4px;">4 hours</p>
                                    </div></div>
                                <div class="col-md-2 px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded ">
                            <div class="row mx-md-n6">
                                <div class="col-md-2 px-md-2"><div class="p-3">
                                        <i class="fas fa-plus-circle " style="font-size: 40px; margin-right: 5px; color: #294dd0;"></i>
                                    </div></div>

                                <div class="col-md-8 px-md-2"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <p style="padding: 4px;">4 hours</p>
                                    </div></div>
                                <div class="col-md-2 px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded ">
                            <div class="row mx-md-n6">
                                <div class="col-md-2 px-md-2"><div class="p-3">
                                        <i class="fas fa-plus-circle " style="font-size: 40px; margin-right: 5px; color: #294dd0;"></i>
                                    </div></div>

                                <div class="col-md-8 px-md-2"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <p style="padding: 4px;">4 hours</p>
                                    </div></div>
                                <div class="col-md-2 px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded ">
                            <div class="row mx-md-n6">
                                <div class="col-md-2 px-md-2"><div class="p-3">
                                        <i class="fas fa-plus-circle " style="font-size: 40px; margin-right: 5px; color: #294dd0;"></i>
                                    </div></div>

                                <div class="col-md-8 px-md-2"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <p style="padding: 4px;">4 hours</p>
                                    </div></div>
                                <div class="col-md-2 px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>




                </div>



            </div>
        </div>
    </main>
@endsection

@push("js")

@endpush