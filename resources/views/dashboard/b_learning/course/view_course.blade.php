@extends('ecommerce.eco_layout.b_learning_main_layout')


@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">

    <style>
        td button , td a{
            border: none;
            height: 40px;
            width: 70px;
            cursor: pointer;
            background: #dddddd;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            text-align: center;
        }

        td a{
            padding-top: 10px;
            color: #000;
            text-decoration: none;
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
        $(document).on('click', '.sellnowok', function () {
            let id = $(this).data('id');
            let value;
            if($(this).is(":checked")){
                value = 1;
            }else{
                value = 0;
            }

            $.ajax({
                dataType: 'json',
                type:"get",
                url: "{{url('/dashboard/admin_setting/sell')}}",
                data:{'id':id, 'value':value},
                success:function(data){
                    window.location = '/dashboard/admin_setting/pin-generate';
                }
            });
        });
    </script>
@endsection


@section('content')

    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Course <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" >Category</th>
                        <th>Live Class</th>
                        <th class="d-none d-sm-table-cell" >Price</th>
                        <th class="d-none d-sm-table-cell" >Change Price</th>
                        <th class="d-none d-sm-table-cell" >Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="text-center">{{$course->id}}</td>
                            <td class="text-center">{{$course->course_name}}</td>
                            <td class="font-w600">
                                {{$course->category->name}}
                            </td>
                            <td>{{$course->live_class}}</td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$course->course_price}}</em>
                            </td>
                            <td>{{$course->current_price}}</td>
                            <td><img width="100" height="100" src="{{asset('/media/blearning/course/image/'.$course->id.'/'.$course->cover_image)}}" alt=""></td>
                            <td class="input-group"><a href="{{route('blearning.course.edit', $course->id)}}">Edit</a> &nbsp;&nbsp;
                                <form action="{{route('blearning.course.delete', $course->id)}}" method="post">@csrf <button type="submit">Delete</button></form></td>
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
