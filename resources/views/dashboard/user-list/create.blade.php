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
        <h2 class="content-heading">Create New User</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Register New User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bf.user.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" required  value="{{old('phone')}}">
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
                        <label for="device_id">Device Id</label>
                        <input type="text" name="device_id" id="device_id" class="form-control" placeholder="Device Id" required  value="{{old('device_id')}}">
                    </div>

                    <div class="form-group">
                        <label for="referred_by">Referred By</label>
                        <select name="referred_by" id="referred_by" required class="js-select2 form-control" required>
                            <option value=""></option>
                            @foreach($premium_users as $premium_user)
                                <option value="{{$premium_user->referral_id}}">{{$premium_user->name}}</option>
                            @endforeach
                        </select>
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
