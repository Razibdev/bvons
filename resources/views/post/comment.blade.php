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

    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>

        $(".form-edit-comment-now").click(function () {
            let id = $(this).data('id');
            $('.wrapper').css('display','none');
            $('#wrapper-comment-'+id).toggle();

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
            <h2 class="font-w700 text-black mb-10">Social Comment List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">SI</th>
                        <th>Post Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Author</th>
                        <th style="width: 15%;">Comment</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $comment)

                        <tr>
                            <td class="avatar">
                                {{$comment->id}}
                            </td>
                            <!-- <td class="text-center">1</td> -->
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted"> @if(isset($comment->post->body)) {{$comment->post->body}} @endif</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$comment->user->name}}</em>
                            </td>

                            <td>
                                <em class="text-muted">{{$comment->body}}</em>
                            </td>


                            <td>
                                <a class="btn btn-success form-edit-comment-now" data-id="{{$comment->id}}"  href="#">Edit</a>
                                <form action="{{ route('comment.destroy',$comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                            <div class="form-wrapper">
                                <div class="wrapper" id="wrapper-comment-{{$comment->id}}">
                                    <form action="{{url('/social-edit-comment/'.$comment->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                        <div class="form-group now">
                                            <h3>Edit Post</h3>
                                            <a href="#" onclick="myfunctionnow()"><span>X</span></a>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="body" cols="30" rows="3" required>{{$comment->body}}</textarea>
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
    <!-- END Page Content -->
@endsection
