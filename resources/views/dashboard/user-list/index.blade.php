@extends('layouts.backend')

@section('css_before')
@endsection

@section('css_after')
    <style>
        *[contenteditable]:focus {
            color: deepskyblue;
            font-size: 16px;
        }
    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('user-datatables') !!}',
                columns: [
                    { data: 'rownum', name: 'rownum' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'referral_id', name: 'referral_id'},
                    { data: 'type', name: 'type' },
                    { data: 'action', name: 'action'},
                ],
                columnDefs: [
                    { targets: 0,searchable: false, visible: true },
                ],
            });
        });

    </script>


    <script>

        $(document).ready(function(){

            $(document).on('click', '.actionActive', function () {
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
                    url: "{{url('/dashboard/bf/user/user_action_bonus')}}",
                    data:{'id':id, 'value':value},
                    success:function(data){
                        toastr.options.closeButton = true;
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'fadeIn';
                        toastr.options.hideMethod = 'fadeOut';

                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success('User Action Updated Successfully');
                        // window.location = '/dashboard/bf/user';
                    }
                });
            });
        });



        $(document).ready(function(){

            $(document).on('change', '.dbaccount', function () {
                let quantity = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/change-dbacount')}}",
                    data:{'quantity': quantity, 'id':id},
                    success:function(data){
                        console.log(data.message);
                        toastr.options.closeButton = true;
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'fadeIn';
                        toastr.options.hideMethod = 'fadeOut';

                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                        window.location = '/cart';

                    }
                });
            });
        });




        $(document).ready(function(){

            $(document).on('change', '.dbaccountBy', function () {
                let dbaccountby = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/change-dbacountby')}}",
                    data:{'dbaccountby': dbaccountby, 'id':id},
                    success:function(data){
                        console.log(data.message);
                        toastr.options.closeButton = true;
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'fadeIn';
                        toastr.options.hideMethod = 'fadeOut';

                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success(data.message);
                        window.location = '/cart';

                    }
                });
            });
        });
    </script>


    <!-- Page JS Code -->
{{--    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>--}}
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                    <small style="float: right;"><a href="{{route('bvon.user.phone.excel')}}"  class="btn btn-success">User Phone Excel</a></small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Account No</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>



            </div>
        </div>
        <!-- END Dynamic Table Full -->

    </div>
    <!-- END Page Content -->
@endsection
