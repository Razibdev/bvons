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
        <h2 class="content-heading">Post</h2>
        <div class="row">

            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Page Name</th>
                                <th>Category Name</th>
                                <th>Page Description</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($pagea as $page)
                                <tr>
                                    <td>{{$page->id}}</td>
                                    <td>{{$page->page_name}}</td>
                                    <td>{{$page->category_name}}</td>
                                    <td>{{\Illuminate\Support\Str::substr($page->page_description, 0, 100)}}</td>
                                    <td><img src="{{asset('/media/page/'.$page->image)}}" width="100" height="75" alt=""></td>
                                    <td>
                                        @php
                                            $admin_id = explode(",", $page->admin_id);

                                            for ($i = 0; $i<count($admin_id); $i++){
                                                if($admin_id[$i] == Illuminate\Support\Facades\Auth::id()){
                                                    $enable = 1;
                                                    break;
                                                }else{
                                                    $enable = 0;
                                                    continue;
                                                }
                                            }
                                        @endphp
                                        @if($enable == 1)
                                            <div class="input-group">
                                            <a href="{{route('page.page.post.view', $page->id)}}">View Post</a>&nbsp;&nbsp;&nbsp;
                                            <a href="{{route('page.page.post.user.edit', $page->id)}}">Edit</a>&nbsp;
                                        &nbsp; &nbsp;<form
                                                action="{{route('page.page.post.user.delete', $page->id)}}" method="post"> {{csrf_field()}}
                                            <button style="border: none;" type="submit">Delete</button>
                                        </form></div></td>
                                        @else
                                        <a href="{{route('page.page.post.user.edit', $page->id)}}">View Post</a>
                                    @endif

                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->
@endsection


