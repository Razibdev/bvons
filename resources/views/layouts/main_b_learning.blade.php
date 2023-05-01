<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   @stack('css')
    <link rel="stylesheet" href="{{asset('blearning/css/style.css')}}">
    <title>Responsive Navbar</title>

    <style>
        .center{
            background: transparent;
            width: 100%;
            height: auto;
            background: darkgoldenrod;
        }
        .containers{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);


        }
        .containers{
            display: none;
            background: #fff;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
        }

        #login:checked ~ .container{
            display: block;
        }

        .containers > .close-btn{
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 18px;
            cursor: pointer;
            color: #343A40;
        }

        .containers > .close-btn:hover{
            color: #3498db;
        }

        .containers > .text{
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            color: #343A40;
        }
        .containers > form{
            margin-top: -20px;

        }

        .containers > form > .data{
            height: 45px;
            width: 100%;
            margin: 30px 0;
        }
        .containers > form > .data > label{
            color: #343A40;
            font-size: 20px;
        }

        .containers > form > .data > input{
            height: 100%;
            width: 100%;
            padding-left: 10px;
            font-size: 17px;
            border: 1px solid silver;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .containers > form > .data > input:focus{
            border-color: #1c91df;
            border-bottom-width: 2px;
        }

        .containers > form > .forgot-pass{
            margin-top: -8px;
        }
        .containers > form > .forgot-pass a{
            color: #3498db;
            text-decoration: none;
        }

        .containers > form > .btn{
            margin: 30px 0;
            height: 45px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .containers >form > .btn > .inner{
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            z-index: -1;
            background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8ea, #9f01ea );
            transition: all 0.4s;
        }

        .containers > form > .btn:hover > .inner{
            left: 0;
        }

        .containers > form > .btn > button{
            height: 100%;
            width: 100%;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .containers > form > .signup-link{
            text-align: center;
            color: #343A40;
        }

        .containers > form > .signup-link > a{
            color: #3498db;
            text-decoration: none;
        }

        .containers > form > .signup-link > a:hover{
            text-decoration: underline;
        }

        .containers > form > .signin-link{
            text-align: center;
            color: #343A40;
        }

        .containers > form > .signin-link > a{
            color: #3498db;
            text-decoration: none;
        }


    </style>
</head>

<body>


@include('layouts.b_layout.blearning_header')


@yield('content')



@include('layouts.b_layout.blearning_footer')


<div class="center">
    <div class="containers" id="login-forms">
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
    <div class="containers" id="signup-form" style="z-index: 5000000">
        <label for="" class="close-btn fas fa-times" onclick="closeBtn()"></label>
        <div class="text">Signu Up Form</div>
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


<script src="{{asset('blearning/js/jquery.js')}}"></script>
@stack('js')
<script src="{{asset('blearning/js/main.js')}}"></script>
<script>
    $(".show-login").click(function() {
        $("#login-forms").toggle();
    });


    function closeBtn() {
        $("#login-forms").css("display","none");
        $("#signup-form").css("display","none");
    }

    $('.signup-link').click(function(){
        $("#signup-form").toggle();
        $("#login-form").toggle();
    });

    $(".signin-link").click(function(){
        $("#login-form").toggle();
        $("#signup-form").toggle();
    });
</script>
</body>

</html>