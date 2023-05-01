@extends('layouts.front_layout.front_layout')

@push("css")
    <link href="{{asset('frontend/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('frontend/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{asset('frontend/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('frontend/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('/frontend/css/main.css')}}">

@endpush
@section('content')
    <div style="margin-bottom: 800px"></div>
    <div class="center">
        <div class="container" id="signup-form" style="display: block">
            <div class="text">Signup Form</div>
            <form action="{{url('/referral-code/'.request()->segment(2))}}" method="post">{{csrf_field()}}
                <div class="data">
                    <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
                </div>
                <div class="data">
                    <input type="text" name="phone" id="phone" placeholder="01xxxxxxxxxx" required>
                </div>
                <div class="data">
                    <input type="password" name="password" id="passwordaa" placeholder="*******" required>
                    <i class="fas fa-eye" id="renow" style="position: absolute; right: 43px; margin-top: 15px;" onclick="myFunctiona()"></i>

                </div>



                <div class="data">
                    <input type="password" name="passwordCode" id="passworda" placeholder="*******" required>
                    <i class="fas fa-eye" id="renowa" style="position: absolute; right: 43px; margin-top: 15px;" onclick="myFunctionb()"></i>

                </div>

                <div class="data">
                    <input type="text" name="dealer" id="dealer" placeholder="Dealer A/C NO (Optional)">
                </div>

                <div class="data">
                    <input type="text" name="pincode" id="pincode" placeholder="BP Pin NO (Optional) If you have?">
                </div>

                <div class="btn">
                    <div class="inner">

                    </div>
                    <button type="submit">SignUp</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@push('js')
    <script>

    </script>

    <script src="{{url('frontend/vendor/select2/select2.min.js')}}"></script>
    <script src="{{url('frontend/vendor/datepicker/moment.min.js')}}"></script>
    <script src="{{url('frontend/vendor/datepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('frontend/js/global.js')}}"></script>
@endpush

