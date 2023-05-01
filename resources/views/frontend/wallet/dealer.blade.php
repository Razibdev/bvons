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
    <div class="tab-wrapper clearfix">
        <div class="tabs clearfix">
            <div class="tab-header">

                <div class="active">
                   Dealer Service
                </div>

                <div>
                    Dealer list
                </div>

            </div>

            <div class="tab-indicator">

            </div>
            <div class="tab-body">

                <div class="active first">
                    <div class="cart-title">
                        <div class="cart-title-single">
                            <h3>0 Sold</h3>
                            <h5>of 595 items</h5>
                        </div>

                        <div class="cart-title-single">
                            <h3>Total Purchase</h3>
                            <h5>33205 BDT</h5>
                        </div>

                        <div class="cart-title-single">
                            <h3>Total Sell</h3>
                            <h5>0 BDT</h5>
                        </div>

                    </div>

                    <div class="cart-body">
                        <h3>Product Wise Sell Overview</h3>

                        <div class="cart-body-single">
                            <img src="frontend/image/10.png" alt="">
                            <h3>Product Name</h3>

                            <div class="group">
                                <div class="left">Remaining</div>
                                <div class="right">400</div>
                            </div>


                            <div class="group">
                                <div class="left">Stocked</div>
                                <div class="right">400</div>
                            </div>

                            <div class="group">
                                <div class="left">Sold</div>
                                <div class="right">0</div>
                            </div>
                        </div>



                        <div class="cart-body-single">
                            <img src="frontend/image/10.png" alt="">
                            <h3>Product Name</h3>

                            <div class="group">
                                <div class="left">Remaining</div>
                                <div class="right">400</div>
                            </div>


                            <div class="group">
                                <div class="left">Stocked</div>
                                <div class="right">400</div>
                            </div>

                            <div class="group">
                                <div class="left">Sold</div>
                                <div class="right">0</div>
                            </div>
                        </div>


                        <div class="cart-body-single">
                            <img src="frontend/image/10.png" alt="">
                            <h3>Product Name</h3>

                            <div class="group">
                                <div class="left">Remaining</div>
                                <div class="right">400</div>
                            </div>


                            <div class="group">
                                <div class="left">Stocked</div>
                                <div class="right">400</div>
                            </div>

                            <div class="group">
                                <div class="left">Sold</div>
                                <div class="right">0</div>
                            </div>
                        </div>

                        <div class="cart-body-single">
                            <img src="frontend/image/10.png" alt="">
                            <h3>Product Name</h3>

                            <div class="group">
                                <div class="left">Remaining</div>
                                <div class="right">400</div>
                            </div>


                            <div class="group">
                                <div class="left">Stocked</div>
                                <div class="right">400</div>
                            </div>

                            <div class="group">
                                <div class="left">Sold</div>
                                <div class="right">0</div>
                            </div>
                        </div>

                        <div class="cart-body-single">
                            <img src="frontend/image/10.png" alt="">
                            <h3>Product Name</h3>

                            <div class="group">
                                <div class="left">Remaining</div>
                                <div class="right">400</div>
                            </div>


                            <div class="group">
                                <div class="left">Stocked</div>
                                <div class="right">400</div>
                            </div>

                            <div class="group">
                                <div class="left">Sold</div>
                                <div class="right">0</div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="second">
                    <div class="dealer-cart-title">

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                        <div class="dealer-list-single">
                            <h3>Red Blue</h3>
                            <p>Uttara Dhaka</p>
                            <h5>Distibutor</h5>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push("js")
    <script>
        let tabHeader = document.getElementsByClassName("tab-header")[0];


        let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
        let tabBody = document.getElementsByClassName("tab-body")[0];

        const tabsPane = tabHeader.children;
        const allBox=tabBody.children;
        for(let i = 0; i < allBox.length; i++){
            tabsPane[i].addEventListener("click", function () {
                tabHeader.getElementsByClassName("active")[0].classList.remove("active");
                tabsPane[i].classList.add("active");
                var then = 100 / 2 *i;
                var sm = 100 / 6 *i;
                var indicatorValue = "calc("+then+"%)" ;
                var indicatorValuesm = "calc("+sm+"%)";

                tabBody.getElementsByClassName("active")[0].classList.remove("active");
                allBox[i].classList.add("active");


                tabIndicator.style.left ='calc('+indicatorValue+')';


                if(window.innerWidth <= '960'){
                    tabIndicator.style.left = 'calc('+indicatorValuesm+')';
                }
                var height = allBox[i].offsetHeight;
                var heights = height + 100;
                tabHeight.style.height = heights+"px";
            })
        }

        let tabHeight =document.querySelector(".tabs");
        let first = document.querySelector(".first").offsetHeight;
        firsts = first + 100;

        tabHeight.style.height = firsts+"px";
    </script>
@endpush