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
        <h2 class="content-heading">Edit Doctor Information</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Bvon Edit doctor Information</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.edit.doctor', $doctor->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required value="{{$doctor->name}}">
                    </div>

                    <div class="form-group">
                        <label for="referred_id">Referred By</label>
                        <select name="referred_id" id="referred_id" required class="js-select2 form-control" required>
                            <option value="">Choose Account</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}" @if($doctor->user_id == $user->id) selected @endif>{{$user->name}} - {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone" required value="{{$doctor->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" class="form-control" placeholder="Enter Age" required  value="{{$doctor->age}}">
                    </div>

                    <div class="form-group">
                        <label for="specialist">Specialist</label>
                        <input type="text" name="specialist" id="specialist" class="form-control" placeholder="Specialist" required  value="{{$doctor->specialist}}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email address" required  value="{{$doctor->email}}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{$doctor->address}}">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender </label><br>
                        <input type="radio" name="gender"  value="Male" @if($doctor->gender === 'Male') checked @endif > Male <br>
                        <input type="radio" name="gender"  value="Female" @if($doctor->gender === 'Female') checked @endif > Female
                    </div>

                    <div class="form-group">
                        <label for="profile_pic">Profile Image</label><br>
                        <input type="file" name="profile_pic" id="profile_pic" >
                        <input type="hidden" name="current_image" value="{{$doctor->profile_pic}}">
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea name="details" id="details" cols="30" rows="6" class="form-control">{{$doctor->details}}</textarea>
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
