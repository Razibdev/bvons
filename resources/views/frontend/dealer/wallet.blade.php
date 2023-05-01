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

        .order-title{
            padding: 15px;
            font-size: 30px;
            font-weight: 400;
        }
        .recent-tarnsaction{
            padding: 10px;
            font-size: 25px;
            font-weight: 300;
        }
        .purchase{
            padding: 5px;
            background: red;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <main class="main-wrapper">
        <div class="product_area_common mt-50 overflow-hidden">
            <div class="container">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <h3 class="order-title">Dealers wallet</h3>
                    </div>

                    <div class="col-md-8">
                        <div class="shadow-sm p-3 mb-5 bg-white rounded" style="width: 300px;">
                            <h3>Total Balance</h3>
                            <p>TK 59745</p>
                        </div>

                    </div>
                    <div class="col-md-4">
                            <div class="shadow-sm p-3 mb-5 bg-white rounded" >
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Recharge</h4>
                                        <p>TK 100k</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Purchase</h4>
                                        <p>45k</p>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Sell</h4>
                                        <p>0</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <h3 class="recent-tarnsaction">Recent Transaction</h3>
                    </div>


                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded ">
                            <div class="row mx-md-n6">
                                <div class="col px-md-10"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <h5>Serial: bVon-D584558EDFR</h5>
                                        <p style="padding: 4px;">4 hours <span class="purchase">Purchase</span></p>
                                    </div></div>
                                <div class="col px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="row mx-md-n6">
                                <div class="col px-md-10"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <h5>Serial: bVon-D584558EDFR</h5>
                                        <p style="padding: 4px;">4 hours <span class="purchase">Purchase</span></p>
                                    </div></div>
                                <div class="col px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="row mx-md-n6">
                                <div class="col px-md-10"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <h5>Serial: bVon-D584558EDFR</h5>
                                        <p style="padding: 4px;">4 hours <span class="purchase">Purchase</span></p>
                                    </div></div>
                                <div class="col px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="row mx-md-n6">
                                <div class="col px-md-10"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <h5>Serial: bVon-D584558EDFR</h5>
                                        <p style="padding: 4px;">4 hours <span class="purchase">Purchase</span></p>
                                    </div></div>
                                <div class="col px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="row mx-md-n6">
                                <div class="col px-md-10"><div class="p-3">
                                        <h4>Dealer wallet has been debited for Order</h4>
                                        <h5>Serial: bVon-D584558EDFR</h5>
                                        <p style="padding: 4px;">4 hours <span class="purchase">Purchase</span></p>
                                    </div></div>
                                <div class="col px-md-1"><div class="p-3" style="float: right; color: red;">TK 2050</div></div>
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