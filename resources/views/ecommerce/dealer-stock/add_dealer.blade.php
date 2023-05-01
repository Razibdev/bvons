@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



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


        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Dealer Stock</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Stock Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{url('/dealer/product-stock')}}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="user_id">Dealer Name</label>
                                <select class="form-control js-example-basic-multiple" name="dealer" id="user_id">
                                    @foreach($dealers as $dealer)
                                    <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                                     @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="product_id">Product Name</label>
                                <select class="js-example-basic-multiple form-control" name="product" id="product_id">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}-{{$product->product_name}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="quantity">Add Quantity</label>
                                <input type="text" class="form-control" name="quantity" id="quantity">
                            </div>

                            <div class="form-group">
                                <label for="quantity">Minus Quantity</label>
                                <input type="text" class="form-control" name="quantity_minus" id="quantity">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-alt-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Normal Form -->


            </div>
        </div>

        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->
@endsection
