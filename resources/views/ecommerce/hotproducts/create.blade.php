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
      $('body').on('click', '.add_button', function(){
       var idwehave = $(this).val();
        var quantity = $('#'+idwehave).val();
       console.log(idwehave);
       if(quantity==''){
         alert("Empty data!!");
       }
       else{
            var link = 'hotproducts/coin/'+idwehave+'/'+quantity;
             window.location.href = link;
         // alert(link);
       }
      });
    });
    </script>;
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Hot Product List Add</h2>
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
                            <th style="width: 15%;">Action</th>
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
                                <em class="text-muted">{{$product->shops->shop_name}}</em>
                            </td>
                            <td>  <span class="name"><input type="text" name="" id="{{$product->id}}" value="{{ $product->product_promote }}"> </span> </td>
                            <td>  <span class="name"><button type="submit" name="button" class="btn btn-warning add_button" value="{{$product->id}}">Update</button></span>
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
