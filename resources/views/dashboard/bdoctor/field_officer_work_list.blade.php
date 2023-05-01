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
                url: "{{url('dashboard/bf/user/')}}",
                data:{'id':id, 'value':value},
                success:function(data){
                    window.location = '/dashboard/bvon-doctor/bvon-doctor-field-officer-work-list';
                }
            });
        });

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
                <h3 class="block-title">View Field Officer Work List <small> <a href="{{route('bvon.add.doctor')}}" class="add_merchant">Add Memeber</a></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Account Number</th>
                        <th >Phone</th>
                        <th>ID Card</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fieldOfficer as $member)
                        <tr>
                            <td class="text-center">{{$member->id}}</td>
                            <td><img src="{{asset('media/user/profile_pic/'.$member->officer->id.'/'.$member->officer->profile_pic)}}" width="100px" height="100px" alt=""></td>
                            <td class="text-center">{{$member->officer->name}}</td>
                            <td><a href="{{ route('bf.user.details', ['user' => $member->user_id]) }}">{{$member->officer->referral_id}}</a></td>
                            <td>{{$member->officer->phone}}</td>
                            <td><input type="checkbox" @if($member->officer->id_card ==1) checked @endif name="sell" data-id="{{$member->officer->id}}" class="sellnowok" value="1"></td>
                            <td><a href="{{ route('bvon.doctor.officer.work.history', $member->officer->referral_id) }}">View History</a>
                                <br><br> <button class="btn btn-warning">Print ID Card</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
