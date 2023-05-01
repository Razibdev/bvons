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
            $(document).on('click', '.deleteBpayCategory', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('dashboard/bvon-pay/delete-bpay-category')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = '/dashboard/bvon-pay/bpay-view-categories';
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
                <h3 class="block-title">View Bpay Category <small> <a href="{{route('bvon.bpay.add.category')}}" class="add_merchant">Add Bpay Category</a></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="text-center">{{$category->id}}</td>
                            <td><img src="{{asset('bpay/category/'.$category->category_image)}}" style="width: 100px; height: 100px;" alt=""></td>
                            <td class="text-center">{{$category->category_name}}</td>
                            <td> <a href="{{route('bvon.bpay.edit.category', $category->id)}}" >Edit</a> &nbsp; <a class="deleteBpayCategory" href="javascript:void(0)" data-id="{{$category->id}}">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
