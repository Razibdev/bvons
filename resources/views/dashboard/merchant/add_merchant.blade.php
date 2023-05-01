@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Create New Merchant</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Merchant New User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('merchant.add.account')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="referred_id">Referred By</label>
                        <select name="referred_id" id="referred_id" required class="js-select2 form-control" required>
                            <option value="">Choose Account</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}">{{$user->name}} - {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required value="{{old('address')}}">
                    </div>

                    <div class="form-group">
                        <label for="merchant_name">Merchant Name</label>
                        <input type="text" name="merchant_name" id="merchant_name" class="form-control" placeholder="Enter Merchant Name" required  value="{{old('merchant_name')}}">
                    </div>

                    <div class="form-group">
                        <label for="type"> Shop Type</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="Business Type" required  value="{{old('type')}}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address" required  value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <label for="payment_charge">Payment Charge</label>
                        <input type="text" name="payment_charge" id="payment_charge" class="form-control" placeholder="Payment Charge" required  value="{{old('payment_charge')}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-alt-success">Submit</button>
                    </div>
                </form>


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
