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
    <script>
        $(document).ready(function(){
            $('#stock-table').on('click', '.add_button', function(){
                var idwehave = $(this).val();
                var quantity = $('#'+idwehave).val();
                if(quantity==''){
                    alert("Please add quantity");
                }
                else {
                    var link = "{{ url('/new/product/add/') }}";
                    let newLink = `${link}/${idwehave}/${quantity}`;
                    window.location.href = newLink;
                }
            });
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Shop List</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="stock-table" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                        <th class="text-center" style="width: 80px;">#SL</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Input</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i= 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_quantity}}</td>
                            <td><span class="name"><input type="text" name="" id="{{$product->id}}"></span></td>
                      <td>  <span class="name"><button type="submit" name="button" class="btn btn-warning add_button" value="{{$product->id}}">Add</button></span> </td>

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
