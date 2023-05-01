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
        <h2 class="content-heading">New Doctor</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Bvon new doctor</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.add.doctor')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="referred_id">Select Doctor</label>
                        <select name="referred_id" id="referred_id" required class="js-select2 form-control" required>
                            <option value="">Choose Account</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}">{{$user->name}} - {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone" required value="{{old('phone')}}">
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" class="form-control" placeholder="Enter Age" required  value="{{old('age')}}">
                    </div>

                    <div class="form-group">
                        <label for="specialist">Specialist</label>
                        <input type="text" name="specialist" id="specialist" class="form-control" placeholder="Specialist" required  value="{{old('specialist')}}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address" required  value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender </label><br>
                        <input type="radio" name="gender" id="gender" value="Male" checked> Male <br>
                        <input type="radio" name="gender" id="gender" value="Female"> Female
                    </div>

                    <div class="form-group">
                        <label for="profile_pic">Profile Image</label><br>
                        <input type="file" name="profile_pic" id="profile_pic" >
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" cols="30" rows="6" class="form-control"></textarea>
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
