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

        .title1{
            padding: 10px;
            font-size: 21px;
        }
        .details1{
            padding-left: 10px;
            padding-bottom: 5px;
            font-size: 20px;
        }
        .input1{
            border: none;
            height: 35px;
        }

    </style>
@endpush
@section('content')
    <div class="form-validation-user">
        <div class="form-wrapper">
            <form action="{{url('/update-user-all-information')}}" method="post">{{csrf_field()}}
                <div class="form">
                    <h3>Update All Information</h3>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{Auth::user()->name}}" name="name" id="name" placeholder="Enter Your Full Name">
                    </div>

                    <div class="form-group">
                        <label for="">Work As</label>
                        <input type="text" value="{{Auth::user()->occupation}}"  name="occupation" id="occupation" placeholder="Where your are working">
                    </div>

                    <div class="form-group">
                        <label for="">Birthday</label>
                        <input type="text" value="{{Auth::user()->birthday}}" name="birthday" id="birthday" placeholder="Enter Your Date of Birthday">
                    </div>

                    <div class="form-group">
                        <label for="">Gender</label>
                        <div class="ok">
                            <input @if(Auth::user()->gender == 'Male') checked  @endif type="radio" name="gender" id="gender" value="Male">&nbsp; Male &nbsp; &nbsp; &nbsp;
                            <input @if(Auth::user()->gender == 'Female') checked  @endif  type="radio" name="gender" id="gender" value="Female">&nbsp; Female
                            <input @if(Auth::user()->gender == 'Others') checked  @endif  type="radio" name="gender" id="gender" value="Others">&nbsp; Others
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Religion</label>
                         <input value="{{Auth::user()->religion}}" type="text" name="religion" id="religion" placeholder="Enter Your Religion">
                    </div>

                    <div class="form-group">
                        <label for="">Current Address</label>
                        <input value="{{Auth::user()->lives_in}}" type="text" name="cur_address" id="cur_address" placeholder="Enter Your Current Address">
                    </div>

                    <div class="form-group">
                        <label for="">Home Address</label>
                        <input value="{{Auth::user()->hometown}}" type="text" name="home_address" id="home_address" placeholder="Enter Your Home Address">
                    </div>

                    <div class="form-group">
                        <select name="blood" id="blood">
                            <option value="O+" @if(Auth::user()->blood == "O+") selected @endif >O<sup>+</sup></option>
                            <option value="O-" @if(Auth::user()->blood == "O-") selected @endif >O<sup>-</sup> </option>
                            <option value="A+" @if(Auth::user()->blood == "A+") selected @endif >A<sup>+</sup> </option>
                            <option value="A-" @if(Auth::user()->blood == "A-") selected @endif >A<sup>-</sup> </option>
                            <option value="B+" @if(Auth::user()->blood == "B+") selected @endif >B<sup>+</sup> </option>
                            <option value="B-" @if(Auth::user()->blood == "B-") selected @endif >B<sup>-</sup> </option>
                            <option value="AB+" @if(Auth::user()->blood == "AB+") selected @endif>AB<sup>+</sup> </option>
                            <option value="AB-" @if(Auth::user()->blood == "AB-") selected @endif >AB<sup>-</sup> </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push("js")

@endpush