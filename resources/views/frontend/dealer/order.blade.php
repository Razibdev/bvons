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
    </style>
@endpush
@section('content')
    <main class="main-wrapper">
        <div class="product_area_common mt-50 overflow-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="order-title">Orders</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Processing</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-shipped" role="tab" aria-controls="nav-profile" aria-selected="false">Shipped</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-profile" aria-selected="false">Completed</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-profile" aria-selected="false">Cancel</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Amount</th>
                                            <th>Placed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>01</th>
                                            <th>2000</th>
                                            <th>Pending</th>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Processing</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-shipped" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Shipped</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Completed</th>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                            <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-hover" style="background: #ffffff; margin-top: 20px; margin-bottom: 20px;" >
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Amount</th>
                                        <th>Placed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>01</th>
                                        <th>2000</th>
                                        <th>Cancel</th>
                                    </tr>
                                    </tbody>

                                </table>
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