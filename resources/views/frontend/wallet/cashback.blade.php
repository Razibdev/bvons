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
                <div class="row" style="margin-bottom: 10px;font-size: 28px; font-weight: bold;">
                    <div class="com-md-5">
                        <p>Cashback Wallet</p>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-5">
                        <h3>TK 5808.00</h3>
                        <p>Available Balance</p>
                    </div>
                    <div class="col-md-5 col-md-offset-2" style="position: fixed;margin: auto;width: 428px;right: 5px;">
                        <h3>TK 5808.00</h3>
                        <p>Pending Deduction</p>
                    </div>
                </div>
                    <div class="row" style="margin-bottom: 10px;">

                        <div class="col-md-12">
                            <div class="shadow p-3 mb-5 bg-white rounded" style="margin-top: 5px;">

                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fas fa-plus-circle " style="font-size: 27px; margin-right: 5px; color: #294dd0;"></i>
                                    </div>
                                    <div class="col-md-7">
                                        <p  style="font-size: 16px;"> nulla placeat quis! Molestiae, officia!</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p style="font-size: 16px;"> 05000</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="shadow p-3 mb-5 bg-white rounded" style="margin-top: 5px;">

                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fas fa-plus-circle " style="font-size: 27px; margin-right: 5px; color: #294dd0;"></i>
                                    </div>
                                    <div class="col-md-7">
                                        <p  style="font-size: 16px;"> nulla placeat quis! Molestiae, officia!</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p style="font-size: 16px;"> 05000</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="shadow p-3 mb-5 bg-white rounded" style="margin-top: 5px;">

                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fas fa-plus-circle " style="font-size: 27px; margin-right: 5px; color: #294dd0;"></i>
                                    </div>
                                    <div class="col-md-7">
                                        <p  style="font-size: 16px;"> nulla placeat quis! Molestiae, officia!</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p style="font-size: 16px;"> 05000</p>
                                    </div>
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