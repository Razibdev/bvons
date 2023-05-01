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
    </script>

@endsection



@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Blood</h2>
        <div class="row">

            <div class="col-md-12">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Blood Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <form class="js-validation-bootstrap" action="{{route('bvon.blood.user.add.status')}}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group<span class="text-danger">*</span></label>
                                        <select name="blood_group" id="blood_group" class="form-control">
                                            <option value="0" disabled selected>Choose Blood Group</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Full Address<span class="text-danger">*</span></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Full Address">
                                    </div>


                                    <div class="form-group">
                                        <label for="patient">Patient's Name<span class="text-danger">*</span></label>
                                        <input type="text" name="patient" id="patient" class="form-control" placeholder="Enter Patient's Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Contact<span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name of Contact Person">

                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter Contact Number">

                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="address">Contact 2<span class="text-default">(Optional)</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name1" id="name1" class="form-control" placeholder="Enter Name of Contact Person">

                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" name="contact1" id="contact1" class="form-control" placeholder="Enter Contact Number">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="address">Contact 3<span class="text-default">(Optional)</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name3" id="name3" class="form-control" placeholder="Enter Name of Contact Person">
                                            </div>

                                            <div class="col-md-6">
                                                <input type="text" name="contact3" id="contact3" class="form-control" placeholder="Enter Contact Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cause">Cause<span class="text-danger">*</span></label>
                                        <input type="text" name="cause" id="cause" class="form-control" placeholder="Enter Cause">
                                    </div>

                                    <div class="form-group">
                                        <label for="blood_date">Date<span class="text-danger">*</span></label>
                                        <input type="date" name="blood_date" id="blood_date" class="form-control" placeholder="Enter Date">
                                    </div>

                                    <div class="form-group">
                                        <label for="blood_time">Time<span class="text-danger">*</span></label>
                                        <input type="time" name="blood_time" id="blood_time" class="form-control" placeholder="Enter Time">
                                    </div>

                                    <div class="form-group">
                                        <label for="blood_bag">Bag<span class="text-danger">*</span></label>
                                        <input type="text" name="blood_bag" id="blood_bag" class="form-control" placeholder="Enter Bag">
                                    </div>



                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-alt-primary w-100">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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


