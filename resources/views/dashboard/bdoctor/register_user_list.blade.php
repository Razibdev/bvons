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
                        url: "{{url('/dashboard/bvon-doctor/doctor-member-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = 'doctor-register-user-list';
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
                <h3 class="block-title">View Doctor Service Memeber <small> <a href="{{route('bvon.add.doctor')}}" class="add_merchant">Add Memeber</a></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Name</th>
                        <th>Referral By</th>
                        <th >Phone</th>
                        <th >Address</th>
                        <th >Occupation</th>
                        <th>Member Details</th>
                        <th>Register Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <td class="text-center">{{$member->id}}</td>
                            <td class="text-center">{{$member->name}}</td>
                            <td><a href="{{ route('bf.user.details', ['user' => $member->user_id]) }}">{{$member->referral_id}}</a></td>
                            <td>{{$member->phone}}</td>
                            <td>{{$member->address}}</td>
                            <td>{{$member->occupation}}</td>
                            <td><a href="{{url('dashboard/bvon-doctor/doctor-register-sub-member-user-list/'.$member->id)}}">Details</a></td>
                            <td>{{$member->created_at->format('m/d/Y')}}</td>
                            <td><a class="deleteDoctorInfo" href="javascript:void(0)" data-id="{{$member->id}}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
