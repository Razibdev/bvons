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

            $(document).on('click', '.deleteIdCart', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('dashboard/vendor_merchant/merchant/merchant-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = '/dashboard/vendor_merchant/merchant';
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
                <h3 class="block-title">Merchant Account <small> <a href="{{route('merchant.add.account')}}" class="add_merchant">Add Merchant</a></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Account</th>
                        <th >Email</th>
                        <th >address</th>
                        <th >Business Type</th>
                        <th >Merchant Account</th>
                        <th>Payment Charge</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($merchants as $mer)
                        <tr>
                            <td class="text-center">{{$mer->id}}</td>
                            <td><a href="{{ route('bf.user.details', ['user' => $mer->user_id]) }}">{{$mer->referral_id}}</a></td>
                            <td>
                                {{$mer->email}}
                            </td>
                            <td>
                                {{$mer->address}}

                            </td>
                            <td>{{$mer->type}}</td>
                            <td><a href="{{route('merchant.account.history', $mer->user_id)}}">{{$mer->merchant_account}}</a></td>
                            <td>{{$mer->payment_charge}}</td>
                            <td> <a href="{{route('merchant.edit.account', $mer->id)}}" >Edit</a><br> <a class="deleteIdCart" href="javascript:void(0)" data-id="{{$mer->id}}">Deleted</a></td>
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
