@extends('layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-body-dark bg-pattern" style="background-image: url({{asset('/media/various/bg-pattern-inverse.png')}})">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">

                    <form  method="POST" action="{{ route('register.vendor') }}">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-emerald">
                                <h3 class="block-title">Create Super Admin For Vendor Administrator</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option">
                                        <i class="si si-wrench"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <div class="invalid-feedback animated fadeInDown">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <div class="invalid-feedback animated fadeInDown">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <div class="invalid-feedback animated fadeInDown">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="administrator">
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12 text-sm-right push">
                                        <button type="submit" class="btn btn-alt-success">
                                            <i class="fa fa-plus mr-10"></i> {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- END Sign Up Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

@endsection
