@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .add_merchant{
            float: right;
            padding: 10px;
            background-color: seagreen;
            border-radius: 10px;
            color: #fff;
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
        $(document).ready(function(){
            $(document).on('click', '.idcart-active', function () {
                let id = $(this).data('id');
                $.ajax({
                    dataType: 'json',
                    type:"get",
                    url: "{{url('/dashboard/admin_setting/idcart-active')}}",
                    data:{'id':id},
                    success:function(data){
                        window.location = '/dashboard/admin_setting/get-id-cart';
                    }
                });
            });
        });


        $(document).ready(function(){
            $(document).on('click', '.deleteDoctorInfo', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('/dashboard/bvon-doctor/doctor-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = '/dashboard/bvon-doctor/view-doctor';
                        }
                    });
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
                <h3 class="block-title">View Doctor Officer Work History </h3>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm12">
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th >A/N</th>
                                <th>phone</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bvonRegisterHistory as $doctor)
                                <tr>
                                    <td class="text-center">{{$doctor->id}}</td>
                                    <td class="text-center">
                                        <img src="{{url('/user/profile_pic/'.$doctor->id.'/'.$doctor->profile_pic)}}" width="100px" height="100px" alt="">
                                    </td>
                                    <td class="text-center">
                                        {{$doctor->name}}
                                    </td>
                                    <td class="text-center">
                                        {{$doctor->referral_id}}
                                    </td>

                                    <td class="text-center">
                                        {{$doctor->phone}}
                                    </td>

                                    <td class="text-center">
                                        {{$doctor->created_at}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4 col-sm12">
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                            <tr>
                                <th>Total Register</th>
                                <th >Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bvonRegisterCount as $doctor)
                                <tr>
                                    <td class="text-center">
                                        {{$doctor->count}}
                                    </td>
                                    <td class="text-center">
                                        {{$doctor->created_at->format('Y-m-d')}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
