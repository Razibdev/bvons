<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    @stack('css')
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <style>
        .select2-results__option select2-results__option--selectable{
            color: #444 !important;
        }
    </style>
</head>
<body>



@include('layouts.front_layout.front_header')







@yield('content')





<!-- footer start -->
@include('layouts.front_layout.front_footer')

<!-- footer end -->





<!-- modal create -->

<div class="center">
    <div class="container" id="login-form">
        <label for="" class="close-btn fas fa-times" onclick="closeBtn()"></label>
        <div class="text">Login Form</div>
        <form method="post" action="{{url('user_login')}}"> {{csrf_field()}}
            <div class="data">
                <label for="phonea">Phone</label>
                    <input type="text" name="phone" id="phonea" placeholder="Phone Number or User A/C" required>

            </div>
            <div class="data">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="*******" required>
                <i class="fas fa-eye" id="nowi" style="position: absolute; right: 43px;margin-top: 14px;" onclick="myFunction()"></i>
            </div>

            <div class="forgot-pass"><a href="#">Forgot Password?</a></div>

            <div class="btn">
                <div class="inner">

                </div>
                <button type="submit">Login</button>
            </div>
            <div class="signup-link"> Not a member? <a href="#">SignUp now</a></div>
        </form>
    </div>
</div>





<div class="center" >
    <div class="container" id="signup-form" style="z-index: 5000000">
        <label for="" class="close-btn fas fa-times" onclick="closeBtn()"></label>
        <div class="text">Sign Up Form</div>
        <form method="POST" action="{{url('user_register')}}"> {{csrf_field()}}
            <div class="data">
                <input type="text" name="name" id="name" placeholder="Enter Your Full Name" required>
            </div>
            <div class="data">
                <input type="text" name="phone" id="phone" placeholder="01xxxxxxxxxx(Mobile NO)" required>
            </div>
            <div class="data">
                <input type="password" name="password" id="passwordaa" placeholder="*******(Type Password)" required>
                <i class="fas fa-eye" id="renow" style="position: absolute; right: 43px; margin-top: 15px;" onclick="myFunctiona()"></i>

            </div>

            <div class="data">
                <input type="password" name="passwordCode" id="passworda" placeholder="******* (Re-Type Password)" required>
                <i class="fas fa-eye" id="renowa" style="position: absolute; right: 43px; margin-top: 15px;" onclick="myFunctionb()"></i>

            </div>

            <div class="data">
                <input type="text" name="introduce" id="introducer" placeholder="Introducer A/C NO (Optional)">
                <span id="introduce_name"></span>
            </div>


            <div class="data">
                <input type="text" name="dealer" id="dealer" placeholder="Dealer A/C NO (Optional)">
            </div>

            <div class="data">
                <input type="text" name="pincode" id="pincode" placeholder="Product Code (Optional) If you have?">
            </div>

            <div class="btn">
                <div class="inner">

                </div>
                <button type="submit">SignUp</button>
            </div>
            <div class="signin-link"> Not a member? <a href="#">SignIn now</a></div>
        </form>
    </div>
</div>


<?php
use Illuminate\Support\Facades\Auth;
use App\Model\Marchant;
if(Auth::check()){
   $merchant = Marchant::where('user_id', Auth::id())->count();
}

?>

<div class="center">
    <div class="profile">
        <div class="cart">
            <div class="cart-header">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->profile_pic != '')
                <img src="{{asset('/media/user/profile_pic/'.Auth::user()->id.'/'.\Illuminate\Support\Facades\Auth::user()->profile_pic)}}" width="100" height="100" alt="">
                        @else
                        <img src="{{ asset('css/frontend/img/logo.png') }}" width="100" height="100" alt="">
                    @endif
                <h3>{{Auth::user()->name}}</h3>
                <div class="account">
                    @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                    <h4>My A/C NO:  {{\Illuminate\Support\Facades\Auth::user()->referral_id}} <img src="{{asset('/frontend/image/download.png')}}" alt=""></h4>
                        @endif
                </div>
                    @endif

            </div>

            <div class="cart-body">

                <div class="profile-single">
                    <h5><a href="{{url('/social-profile')}}"><i class="far fa-user razib-icon"></i> My Profile</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-search razib-icon"></i> Search User</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="{{url('/e-wallet')}}"><i class="fas fa-wallet razib-icon"></i> E-wallet</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="{{url('/shopping-wallet')}}"><i class="fas fa-wallet razib-icon"></i>Shopping Wallet</a></h5>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                @if($merchant > 0)
                <div class="profile-single">
                    <h5><a href="{{url('/merchant-wallet')}}"><i class="fas fa-wallet razib-icon"></i>Merchant Wallet</a></h5>
                </div>
                @endif
                @endif
                <div class="profile-single">
                    @if(request()->is('dealer-service') || request()->is('dealer-purchase') || request()->is('page_cart') || request()->is('dealer_orders_page'))
                        <h5><a href="{{url('/dealer_orders_page')}}"><i class="fas fa-wallet razib-icon"></i> Order Details</a></h5>

                    @else
                    <h5><a href="{{url('/thanks')}}"><i class="fas fa-wallet razib-icon"></i> Order Details</a></h5>
                    @endif
                </div>


                <div class="profile-single">
                    <h5><a href="{{url('/page/post/create')}}"><i class="fas fa-vote-yea razib-icon"></i> Page Post</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-money-check razib-icon"></i> Payment Getaway</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#" id="dealer-part"><i class="fas fa-user-friends razib-icon" ></i> Dealers</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="{{url('/dealer/account/employee-arena')}}"><i class="fas fa-briefcase  razib-icon"></i> Employees Arena</a></h5>
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->type == 'GU')
                <div class="profile-single">
                    <h5><a href="{{url('/user-verification-form')}}"><i class="fas fa-briefcase  razib-icon"></i> Verification</a></h5>
                </div>
                    @endif
                @endif

                <div class="profile-single">
                    <h5><a href="#" class="changeUserName" ><i class="fas fa-user-friends razib-icon" ></i> Change Username</a></h5>
                </div>
                <div class="profile-single">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                            @if(Auth::user()->referral_id != NULL && Auth::user()->email != NULL && Auth::user()->phone != NULL)
                            <h5><a href="{{url('/user-idcart')}}"><i class="fas fa-briefcase  razib-icon"></i> Apply for ID Card </a></h5>
                            @else
                                <h5><a href="#" class="update-profile-for-idcart"><i class="fas fa-briefcase  razib-icon"></i> Apply for ID Card </a></h5>

                            @endif
                        @endif
                        @endif
                </div>
                @if(\Illuminate\Support\Facades\Auth::check())
                @if(\Illuminate\Support\Facades\Auth::user()->type == 'GU')
                <div class="profile-single">
                    <h5 id="pinsubmitnowok"><a href="#"><i class="fas fa-briefcase  razib-icon"></i> Pin Submit </a></h5>
                </div>
                @endif
                @endif


                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                <div class="profile-single">
                    <h5><a onclick="copyToClipboard('#refferalvaluecopied')" href="#"><i class="fas fa-briefcase  razib-icon"></i> Referral Url copy</a>
                        <input style="border: none; padding: 5px; font-size: 1px" type="text" id="refferalvaluecopied" name="" value="<?php echo $value = 'https://bvon.app/referral-code/'.Auth::user()->referral_id; ?>">
                    </h5>
                </div>
                    @endif
                @endif

                <div class="profile-single">
                    <h5><a  style="list-style-type: none !important;" class="text-white font-size-14" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt razib-icon"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form></h5>
                </div>


            </div>
        </div>
    </div>
</div>


<div class="center">
    <div class="pin-submit">
        <div class="cart">
            <div class="cart-sign">
                <h3>Pin Here</h3>
                <h3 onclick="closepinsubmit()">X</h3>
            </div>

            <form action="{{url('/pin-submit')}}" method="post"> {{csrf_field()}}
                <input type="text" name="introduce" placeholder="Enter Introduce A/C No. (optional)" required>
                <input type="text" name="pin" id="pin" placeholder="Enter Pin........" required>
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
</div>


@if(Auth::check())
<div class="center">
    <div class="change_user_name">
        <div class="cart">
            <div class="cart-sign">
                <h3>Create Username</h3>
                <h3 onclick="closeusernamesubmit()">X</h3>
            </div>

            <form action="{{url('/change-username-now')}}" method="post"> {{csrf_field()}}
                <input type="text" name="introduce" id="introduce"  value="{{Auth::user()->username}}" placeholder="Enter UserName" required>
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
</div>

@endif




<div class="center">
    <div class="dealer-option">
        <div class="cart">
            <div class="cart-header">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(Auth::user()->profile_pic != '')
                        <img src="{{asset('/media/user/profile_pic/'.Auth::user()->id.'/'.\Illuminate\Support\Facades\Auth::user()->profile_pic)}}" width="100" height="100" alt="">
                    @else

                        <img src="{{ asset('css/frontend/img/logo.png') }}" width="100" height="100" alt="">
                        @endif
                <h3>{{Auth::user()->name}}</h3>
                <div class="account">
                    @if(\Illuminate\Support\Facades\Auth::user()->type != 'GU')
                    <h4>Distributor NO: {{\Illuminate\Support\Facades\Auth::user()->dealer_referral_id}} <img src="{{asset('frontend/image/download.png')}}" alt=""></h4>
                        @endif
                </div>
                @endif
            </div>

            <div class="cart-body">

                <div class="profile-single">
                    <h5><a href="{{url('/dealer-purchase')}}"><i class="fas fa-shopping-cart razib-icon"></i> Purchase Product</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-calculator razib-icon"></i> My Order</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="{{url('dealer/account')}}"><i class="far fa-clock razib-icon"></i> Assign Orders</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-vote-yea razib-icon"></i> Dealer Wallet</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="#"><i class="fab fa-stack-exchange"></i> Stock Report</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="far fa-chart-bar razib-icon"></i> Sales Report</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="center">
    <div class="charity-option">
        <div class="cart">
            <div class="cart-header">
                <img src="{{asset('/media/favicons/apple-icon-precomposed.png')}}" width="100" height="100" alt="">
            </div>

            <div class="cart-body">

                <div class="profile-single">
                    <h5><a href="{{url('/social')}}" ><i class="fas fa-camera"></i> Social Media</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-shopping-cart"></i> bVon Shop</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-gift"></i> B-courier</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-map-marker-alt"></i> Blood Bank</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-car"></i> Ride Sharing</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="{{url('/b_learning_schools')}}"><i class="fas fa-laptop"></i> B-learning School</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-hamburger"></i> B-Food</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fab fa-cc-visa"></i> B-Pay</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="far fa-id-card"></i> B-Card Service</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-pencil-alt"></i> Live Tutor / Tuition</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="far fa-bell"></i> All Types Of Alert</a></h5>
                </div>





                <div class="profile-single">
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <h5><a href="{{url('/charity/user/event')}}"><i class="fas fa-file-invoice-dollar"></i> Charity</a></h5>
                     @else
                        <h5><a href="#" class="logininfast"><i class="fas fa-file-invoice-dollar"></i> Charity</a></h5>
                    @endif
                </div>


                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-stethoscope"></i> B-Doctor</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a @if(Auth::check()) href="{{url('/bvon/quizze/start')}}" @else href="#" @endif><i class="fas fa-inbox"></i> B-Quizzes</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-puzzle-piece"></i> B-Puzzel</a></h5>
                </div>


                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-gamepad"></i> B-Games</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-users"></i> Freelance Place</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-gift"></i> Career Finder</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="far fa-newspaper"></i> B-News Portal</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-shopping-basket"></i> B-Baazar</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-book"></i> Reading and Reviews</a></h5>
                </div>

                <div class="profile-single">
                    <h5><a href="#"><i class="fas fa-book-open"></i> Earning Opportunities</a></h5>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
{!! Toastr::message() !!}
@include('sweetalert::alert')
<script>

    $(document).ready(function () {
       $('#introducer').keyup(function () {
           var value = $(this).val();
           $.ajax({
               url: "{{url('/check_user_name_by_introduce_number')}}",
               method: 'get',
               data:{'value' : value},
               dataType: 'json',
               success: function (data) {
                   console.log(data.message);
                   if(data.message === 'User Not Found'){
                       $('#introduce_name').text('');
                   }
                   if(data.user.name != ''){
                       $('#introduce_name').html(data.user.name);
                   }

               }
           })
       });
    });

    $('.logininfast').on('click', function () {
        alert('Login First');
    });


    function copyToClipboard(element) {
        $(element).select();
        document.execCommand("copy");
    }

    $('.changeUserName').on('click', function () {
        $('.change_user_name').toggle();
        $('.profile').css('display', 'none');

    });


    $('.update-profile-for-idcart').click(function () {
       alert('First Update Your Profile Then apply for id cart!');
    });

        $('#pinsubmitnowok').click(function () {
            $('.pin-submit').toggle();
            $('.profile').css('display', 'none');
        });

        function closepinsubmit() {
            $('.pin-submit').css('display', 'none');
        }

    function closeusernamesubmit() {
        $('.change_user_name').css('display', 'none');
    }

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            $('#nowi').addClass("fa-eye-slash");
            $('#nowi').removeClass("fa-eye");

            $('#renow').addClass("fa-eye-slash");
            $('#renow').removeClass("fa-eye");

            $('#renowa').addClass("fa-eye-slash");
            $('#renowa').removeClass("fa-eye");
        } else {
            x.type = "password";
            $('#nowi').removeClass("fa-eye-slash");
            $('#nowi').addClass("fa-eye");

            $('#renow').removeClass("fa-eye-slash");
            $('#renow').addClass("fa-eye");

            $('#renowa').removeClass("fa-eye-slash");
            $('#renowa').addClass("fa-eye");
        }
    }

    function myFunctiona() {
        var x = document.getElementById("passwordaa");
        if (x.type === "password") {
            x.type = "text";

            $('#renow').addClass("fa-eye-slash");
            $('#renow').removeClass("fa-eye");

        } else {
            x.type = "password";
            $('#renow').removeClass("fa-eye-slash");
            $('#renow').addClass("fa-eye");

        }
    }

    function myFunctionb() {
        var x = document.getElementById("passworda");
        if (x.type === "password") {
            x.type = "text";
            $('#renowa').addClass("fa-eye-slash");
            $('#renowa').removeClass("fa-eye");
        } else {
            x.type = "password";
            $('#renowa').removeClass("fa-eye-slash");
            $('#renowa').addClass("fa-eye");

        }
    }


$(document).ready(function () {
   $('.phpdebugbar').css('display', 'none');
});




    $(document).ready(function () {
    $(".typeahead").keyup(function () {
    var query = $(this).val();

    if(query != ''){
    var _token = $('input[name="_token"]').val();
    $.ajax({
    url: "{{route('searchProduct')}}",
    method: "get",
    data:{'query':query, '_token':_token},
    success:function(data){
    $('.countryList').fadeIn();
    $('.countryList').html(data);
    }
    })
    }
    });

    $(document).on('click', 'li', function(){
    $('.typeahead').val($(this).text());
    $('.countryList').fadeOut();
    });
    });

</script>

@stack('js')



</body>
</html>