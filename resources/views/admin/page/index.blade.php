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
        <h2 class="content-heading">Page</h2>
        <div class="row">

            <div class="col-md-12">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Page Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">

                        <form action="{{route('page.add.page')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="page_name">Page Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter Product Name" value="{{ old('product_name') }}" >
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name">Category Name<span class="text-danger">*</span></label>
                                        <select name="category_name" class="form-control " id="category_name">
                                            <option value="" selected disabled>Choose Category</option>
                                            <option value="Company">Company</option>
                                            <option value="Education">Education</option>
                                            <option value="Political">Political</option>
                                            <option value="Organization">Organization</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Country">Country</option>
                                            <option value="Division">Division</option>
                                            <option value="District">District</option>
                                            <option value="Thana">Thana</option>
                                            <option value="Union">Union</option>
                                            <option value="Village/Ward">Village/Ward</option>
                                        </select>
                                    </div>




                                    <div class="form-group">
                                        <label for="admin_id">Page Admin<span class="text-danger">*</span></label>
                                        <select name="admin_id[]" id="admin_id" class="form-control js-example-basic-multiple" multiple="multiple" >
                                              @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                               @endforeach
                                        </select>
                                     </div>


                                    <div class="form-group">
                                        <label for="sub_admin_id">Page Sub Admin<span class="text-danger">*</span></label>
                                        <select name="sub_admin_id[]" id="sub_admin_id" class="form-control js-example-basic-multiple" multiple="multiple" >
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_admin_id">Page Description<span class="text-danger">*</span></label>
                                        <textarea name="page_description" class="form-control" id="page_description" cols="30" rows="6"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="media">Page Profile Image<span class="text-danger">*</span></label>
                                        <input type="file" name="media" class="form-control">
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


