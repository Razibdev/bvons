@extends('layouts.pagemain')

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/simplemde/simplemde.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('css_after')
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <style>
        .inputFileWithColor {
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            position: relative;
            max-width: 250px;
            height: 250px;
            overflow: hidden;
        }
        .inputFileWithColor input[type="color"] {
            background: transparent;
            border: 0;
            width: 30px;
            height: 30px;
            padding: 0;
            box-sizing: border-box;
        }
        .inputFileWithColor img.img-preview {
            position: absolute;
            top: 0;
            height: 90%;
            left: 50%;
            transform: translateX(-50%);
        }
        .inputFileWithColor div.bottom-section {
            position: absolute;
            bottom: 0;
            background: #ddd;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: stretch;
            padding: 5px;
            box-sizing: border-box;
            left: 0;
            border-top: 2px solid #222;
        }
        .inputFileWithColor:first-child:before {
            content: 'thumbnail';
            position: absolute;
            top: 0;
            z-index: 999;
            padding: 5px;
            border: 1px solid #1d1b1b;
            color: #efecec;
            right: 10px;
            top: 8px;
            font-size: 10px;
            text-transform: uppercase;
            border-radius: 3px;
            background: rgba(0,0,0,.4);
            letter-spacing: 1.5px;
        }
        .tox-notifications-container, .tox-statusbar__branding {
            display: none !important;
        }
    </style>
@endsection



@section('js_after')

    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>
    <script src="{{ asset('js/ku-modules/input.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        $('#district').change(function () {
            if($(this).val != ''){
                var value = $(this).val();
                $.ajax({
                    url: '{{route('bvon.blood.user.status.dependency.thana')}}',
                    method: 'get',
                    data:{'value': value, "_token": "{{ csrf_token() }}"},
                    success:function (result) {
                        $('#thana').html(result);
                        console.log(result);
                    }
                })
            }
        });
    </script>

@endsection



@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Quizze</h2>
        <div class="row">

            <div class="col-md-12">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Quizze Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <form class="js-validation-bootstrap" enctype="multipart/form-data" action="{{route('page.boost.add.page.boost')}}" method="post" >
                            @csrf
                            <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Page Name <span style="color: red;">*</span></label>&nbsp;
                                            <select name="page_name" id="page_name" class="form-control">
                                                <option value="0" selected disabled>Choose Boost Type</option>
                                                @foreach($page as $a)
                                                    @foreach($a as $p)
                                                    <option value="{{$p->id}}">{{$p->page_name}}</option>
                                                        @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Boost Type <span style="color: red;">*</span></label>&nbsp;
                                            <select name="boost_type" id="boost_type" class="form-control">
                                                <option value="0" selected disabled>Choose Boost Type</option>
                                                @foreach($boostType as $boost)
                                                    <option value="{{$boost->id}}">{{$boost->boost_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label><br>
                                            <input type="radio" name="gender" id="" value="Male">&nbsp; Male &nbsp; &nbsp;
                                            <input type="radio" name="gender" id="" value="Female">&nbsp; Female &nbsp; &nbsp;
                                            <input type="radio" name="gender" id="" value="Both">&nbsp; Both &nbsp; &nbsp;
                                        </div>

                                        <div class="form-group">
                                            <label for="">Age <span style="color: red;">*</span></label> &nbsp;
                                            <input type="text" name="age" id="age" class="form-control" placeholder="Enter age (18-37)">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Profession</label>
                                            <select name="profession" id="profession" class="form-control">
                                                <option value="0" selected disabled>Choose Profession</option>
                                                <option value="Student">Student</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="Job Holder">Job Holder</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="device">Device</label>
                                            <select name="device" id="device" class="form-control">
                                                <option value="0" selected disabled>Choose Device</option>
                                                <option value="Mobile">Mobile</option>
                                                <option value="Laptop">Laptop</option>
                                                <option value="Desktop">Desktop</option>
                                                <option value="Tap">Tap</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="district">District</label>
                                            <select name="district" id="district" class="form-control">
                                                @foreach($district as $dis)
                                                    <option value="{{$dis->id}}">{{$dis->name}}</option>
                                                 @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="district">Thana</label>
                                            <select name="thana" id="thana" required class="form-control">
                                                <option value="0" selected disabled>Choose Thana</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="operator">Number Operator</label>
                                            <select name="operator" id="operator" class="form-control">
                                                <option value="0" selected disabled>Choose Operator</option>
                                                <option value="017">GP</option>
                                                <option value="013">Skito</option>
                                                <option value="019">Banglalink</option>
                                                <option value="018">Robi</option>
                                                <option value="016">Airtel</option>
                                                <option value="015">Teletalk</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="hobby">Hobby</label>
                                            <select name="hobby" id="hobby" class="form-control">
                                                <option value="0" selected disabled>Choose Hobby</option>
                                                <option value="Hobby one">Hobby one</option>
                                                <option value="Hobby Two">Hobby Two</option>
                                                <option value="Hobby Three">Hobby Three</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="team">Team</label> &nbsp;
                                            <input type="checkbox" name="team" id="team" value="1">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company_name">Company Type/Name</label>
                                            <select name="company_name" id="company_name" class="form-control">
                                                <option value="0" selected disabled>Choose Company Name / Type</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Pran">Pran</option>
                                                <option value="Square">Square</option>
                                                <option value="Uniliver">Uniliver</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="s_user">Special User</label>
                                            <select name="s_user" id="s_user" class="form-control">
                                                <option value="0" selected disabled>Choose Special User</option>
                                                <option value="Apple">Apple</option>
                                                <option value="KFC">KFC</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="interested">Interest</label>
                                            <select name="interest" id="interest" class="form-control">
                                                <option value="0" selected disabled >Choose Interested </option>
                                                <option value="Traveling">Traveling</option>
                                                <option value="Company">Company</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="people">People</label>
                                            <select name="people" id="people" class="form-control" >
                                                <option value="0" selected disabled >Choose People </option>
                                                <option value="already_in">Already In</option>
                                                <option value="not_in">Not In</option>
                                                <option value="both">In and Out</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="time" name="start_time" id="start_time" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="time" name="end_time" id="end_time" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="day">Day</label>
                                            <input type="number" name="day" id="day" class="form-control" placeholder="Enter day">
                                        </div>

                                        <div class="form-group">
                                            <label for="budget">Budget <span style="color:red;">*</span></label>
                                            <input type="number" min="10" name="budget" class="form-control" id="budget" placeholder="Enter Budget (minimum 10)">
                                        </div>
                                        <div class="form-group">
                                            <label for="institution">Educational Institution</label>
                                            <select name="institution" id="institution" class="form-control">
                                                <option value="0" selected disabled>Choose Institution</option>
                                                <option value="institution one">institution one</option>
                                                <option value="institution two">institution two</option>
                                                <option value="institution three">institution Three</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="audience"></label>
                                            <select name="audience" id="audience" class="form-control">
                                                <option value="0" disabled selected >Choose audience</option>
                                                <option value="100">100</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                                <option value="1500">1500</option>
                                                <option value="2000">2000</option>
                                                <option value="2500">2500</option>
                                                <option value="3000">3000</option>
                                                <option value="3500">3500</option>
                                                <option value="4000">4000</option>
                                                <option value="4500">4500</option>
                                                <option value="5000">5000</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group" style="float:right;">
                                            <button type="submit" class="btn btn-success">Buy</button>
                                        </div>
                                    </div>
                            </div>



                    </div>
                    <div>

                    </div>
                </div>
                <!-- END Normal Form -->
            </div>
        </div>

        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->
@endsection


