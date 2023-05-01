@extends('ecommerce.eco_layout.main')

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
        <h2 class="content-heading">Quizze Question</h2>
        <div class="row">

            <div class="col-md-12">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Quizze Question Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">MCQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Boolean</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Written</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <form action="{{route('quizze.add.quizze.question.mcq')}}" method="post">{{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="">Question Title</label><br>
                                                    <input type="text" name="question_name" class="form-control" placeholder="Enter Question Name">
                                                    <input type="hidden" name="type" value="mcq">
                                                    <br>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <input type="text" name="option1" placeholder="Enter Option One" class="form-control" >
                                                            <br>

                                                            <input type="text" name="option3" placeholder="Enter Option Three" class="form-control" >

                                                        </div>
                                                        <br>

                                                        <div class="col-md-6">
                                                            <input type="text" name="option2" placeholder="Enter Option Two" class="form-control" >
                                                            <br>
                                                            <input type="text" name="option4" placeholder="Enter Option Four" class="form-control" >
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="answer" class="form-control" placeholder="Enter Right Answer">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="duration" class="form-control" placeholder="Enter Duration (Optional) ">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="node" class="form-control" placeholder="Enter Node (Optional) ">
                                                        </div>

                                                        <div class="col-md-12 text-right">
                                                            <br>

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <form action="{{route('quizze.add.quizze.question.boolean')}}" method="post"> {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="">Question Title</label><br>
                                                    <input type="text" name="question_name" class="form-control" placeholder="Enter Question Name">
                                                    <input type="hidden" name="type" value="boolean">
                                                    <br>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <input type="text" name="option1" placeholder="Enter Option One" class="form-control" >

                                                        </div>
                                                        <br>

                                                        <div class="col-md-6">
                                                            <input type="text" name="option2" placeholder="Enter Option Two" class="form-control" >

                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="answer" class="form-control" placeholder="Enter Right Answer">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="duration" class="form-control" placeholder="Enter Duration ">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="node" class="form-control" placeholder="Enter Node (Optional) ">
                                                        </div>

                                                        <div class="col-md-12 text-right">
                                                            <br>

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                            <form action="{{route('quizze.add.quizze.question.written')}}" method="post"> {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="">Question Title</label><br>
                                                    <input type="text" name="question_name" class="form-control" placeholder="Enter Question Name">
                                                    <input type="hidden" name="type" value="written">
                                                    <br>
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <input type="text" name="option1" placeholder="Enter Option One" class="form-control" >
                                                        </div>

                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="answer" class="form-control" placeholder="Enter Right Answer">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="duration" class="form-control" placeholder="Enter Duration ">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <br>
                                                            <input type="text" name="node" class="form-control" placeholder="Enter Node (Optional) ">
                                                        </div>

                                                        <div class="col-md-12 text-right">
                                                            <br>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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


