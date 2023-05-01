@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .form-wrapper{
            background: transparent;
            width: 300px;
            height: auto;
        }

        .form-wrapper .wrapper{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            display: none;
            background: #ddd;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
        }

        .form-wrapper .wrapper .form-group{
            width: 100%;
        }

        .form-wrapper .wrapper .form-group.now{
            width: 100%;
        }

        .form-wrapper .wrapper .form-group.now h3{
            width: 50%;
            float: left;
        }

        .form-wrapper .wrapper .form-group.now a{
            width: 50%;
            float: right;
        }

        .form-wrapper .wrapper .form-group.now a span{
            float: right;
        }

        .form-wrapper .wrapper .form-group textarea{
            width: 100%;
        }
        .form-wrapper .wrapper .form-group button{
            border: none;
            width: 200px;
            height: 35px;
        }

        #addPostModal{
            height: 35px;
            width: 150px;
            border: none;
            background-color: green;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            margin-left: 50px;
        }

    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.form-edit-now').on('click', function () {

            });
        });
        $(".form-edit-now").click(function () {
            let id = $(this).data('id');
            $('.wrapper').css('display','none');
            $('#wrapper-'+id).toggle();

        });

        $("#addPostModal").click(function () {
            $('.wrapper').css('display','none');
            $('#wrapper').toggle();

        });




        function myfunctionnow() {
            $('.wrapper').css('display', 'none');
        }
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Post  <button id="addPostModal">Add Post</button></h2>

        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">Image</th>
                        <th>Post Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Author name</th>
                        <th style="width: 15%;">Total Like</th>
                        <th style="width: 15%;">Total Comment</th>
                        <th>Created At</th>

                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)

                        <tr>
                            <td class="avatar">
                                <div class="round-img">

                                    <a href="#"><img class="rounded-circle" src="@if(isset($post->media)){{asset('media/post/'.$post->user_id.'/'.$post->id.'/'.$post->media)}}@endif" alt="" height="100"></a>
                                </div>
                            </td>
                            <!-- <td class="text-center">1</td> -->
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{Str::limit($post->body,60)}}</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">@if(isset($post->user->name)) {{$post->user->name}} @endif </em>
                            </td>

                            <td>
                                <em class="text-muted">{{count($post->likes)}}</em>
                            </td>

                            <td>
                                <em class="text-muted">{{count($post->comment)}}</em>
                            </td>
                            <td>
                                <em class="text-muted">{{$post->created_at->diffForHumans()}}</em>
                            </td>

                            <td style="width: 100%;">
                                <a class="btn btn-success form-edit-now" style="width: 30%; float: left;"  href="#"  data-id="{{$post->id}}">Edit</a>
                                <form action="{{ url('/social-hide/'.$post->id) }}" method="POST">@csrf
                                    <button style="width: 30%; float: left;" type="submit" class="btn btn-danger">Hide</button>
                                </form>
                                <form action="{{ url('/social-delete/'.$post->id) }}" method="POST">@csrf
                                    <button style="width: 30%; float: left;" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>



                            <div class="form-wrapper">
                                <div class="wrapper" id="wrapper-{{$post->id}}">
                                    <form action="{{url('/social-edit/'.$post->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                        <div class="form-group now">
                                            <h3>Edit Post</h3>
                                            <a href="#" onclick="myfunctionnow()"><span>X</span></a>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="body" cols="30" rows="3">{{$post->body}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="media" >
                                            <input type="hidden" name="current_image" value="@if(isset($post->media)) {{$post->media}} @endif">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>


    <div class="form-wrapper">
        <div class="wrapper" id="wrapper">
            <form action="{{url('social/add-post')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                <div class="form-group now">
                    <h3>Add Post</h3>
                    <a href="#" onclick="myfunctionnow()"><span>X</span></a>
                </div>
                <div class="form-group">
                    <textarea name="body" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="media" >
                </div>

                <div class="form-group">
                    <input type="checkbox" name="premium" value="1" > Premium
                </div>

                <div class="form-group">
                    <input type="checkbox" name="action_page" value="1" > Action Page
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- END Page Content -->
@endsection
