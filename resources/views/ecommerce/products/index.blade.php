@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Product List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Vendor Name</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img class="ku-thumbnail" src="{{asset('/storage/')}}/@if($product->media()->count()){{$product->media()->first()->product_image}}@endif" alt=""></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->vendor->name}}</td>
                            <td>{{$product->product_quantity}}</td>
                            <td>{{$product->product_permision}}</td>
                            <td><a class="btn btn-block btn-alt-primary" href="{{ route('products.show',$product->id) }}"><i class="fa fa-info-circle"></i></a></td>
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
