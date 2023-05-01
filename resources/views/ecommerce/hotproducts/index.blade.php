@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

   
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Hot Product List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Product Name</th>
                            <th class="d-none d-sm-table-cell">Shop Name</th>
                            <th class="d-none d-sm-table-cell">Coin</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                       
                        <tr>
                            <td class="text-center">1</td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$product->product_name}}</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$product->shop_name}}</em>
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$product->coin}}</em>
                            </td>
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
