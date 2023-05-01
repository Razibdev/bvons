@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-body-dark bg-pattern" style="background-image: url({{asset('/media/various/bg-pattern-inverse.png')}})">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="link-effect font-w700" href="">
                            <i class="si si-fire"></i>
                            <span class="font-size-xl text-primary-dark">code</span><span class="font-size-xl">base</span>
                        </a>
                        <h1 class="h4 font-w700 mt-30 mb-10">Welcome to Your Dashboard</h1>
                        <h2 class="h5 font-w400 text-muted mb-0">It’s a great day today!</h2>
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <!-- jQuery Validation functionality is initialized with .js-validation-signin class in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form class="" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-dusk">
                                <h3 class="block-title">Please Sign In</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option">
                                        <i class="si si-wrench"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback animated fadeInDown">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <div class="invalid-feedback animated fadeInDown">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-6 d-sm-flex align-items-center push">
                                        <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                            <input class="custom-control-input" id="login-remember-me" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            {{--<input type="checkbox" class=""  name="login-remember-me">--}}
                                            <label class="custom-control-label" for="login-remember-me">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-right push">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <i class="si si-login mr-10"></i> {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content bg-body-light">
                                <div class="form-group text-center">

                                    @if (Route::has('register'))
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('register') }}">
                                            <i class="fa fa-plus mr-5"></i> {{ __('Register') }}
                                        </a>
                                    @endif
                                    @if (Route::has('password.request'))
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('password.request') }}">
                                            <i class="fa fa-warning mr-5"></i> {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
