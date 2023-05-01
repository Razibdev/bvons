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
        $(document).ready(function () {
            $('.form-edit-now').on('click', function () {

            });
        });
        $(".form-edit-now").click(function () {
            let id = $(this).data('id');
            $('.wrapper').css('display','none');
            $('#wrapper-'+id).toggle();

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
                        <th class="text-center" style="width: 80px;">Image</th>
                        <th>Post Title</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Author name</th>
                        <th style="width: 15%;">Total Like</th>
                        <th style="width: 15%;">Total Comment</th>

                        <th style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)

                        <tr>
                            <td class="avatar">
                                <div class="round-img">
                                    @php
                                        $media = json_decode($post->media);
                                    @endphp
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
                                <em class="text-muted">{{$post->likes_count}}</em>
                            </td>

                            <td>
                                <em class="text-muted">{{$post->likes_count}}</em>
                            </td>

                            <td style="width: 100%;">

                                <form action="{{ url('/social-post-restore/'.$post->id) }}" method="POST">@csrf
                                    <button style="width: 30%; float: left;" type="submit" class="btn btn-danger">Restore</button>
                                </form>

                            </td>

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
