@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection


@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Shop</h2>
    <div class="row">

        <div class="col-md-8">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Shop Add</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form method="POST" action="{{ route('shops.update',$shop->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="example-nf-email">Shop Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="shop_name" value="{{ $shop->shop_name }}" placeholder="Enter Shop Name">
                        </div>

                        <div class="form-group">
                            <label for="example-nf-email">Shop Url</label>
                            <input type="text" class="form-control product_quantity" id="example-nf-email" data-id="{{$shop->id}}" name="url" value="{{ $shop->url }}" placeholder="Enter Shop Url">
                        </div>
                        <div class="form-group">
                            <label for="example-nf-email">Shop Address</label>
                            <input type="text" class="form-control" id="example-nf-email" name="shop_address" value="{{ $shop->shop_address }}" placeholder="Enter Shop Address">
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Shop Image</label>
                            <div class="col-md-12">
                                <div id="ImdID">
                                    <img class="" src="{{asset('/storage/')}}/{{$shop->shop_image}}" alt="" height="100">
                                </div>
                            </div>

                            <div class="col-12 mt-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" onchange="shopEdit(this)" name="shop_image" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @role('administrator')
                            <div class="form-group">
                                <label for="shop_priority">Shop Piority</label>
                                <input type="number" class="form-control" id="shop_priority" name="shop_priority" value="{{ $shop->priority }}" placeholder="Shop Piority">
                            </div>
                        @endrole


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


@section('js_after')
    <script>
        function shopEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImdID').html(`<img src="${e.target.result}">`);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function(){
            $(document).on('change', '.product_quantity', function () {
                let url = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-shop-url')}}",
                    data:{'url': url,  'id':id},
                    success:function(data){
                        console.log(data.message);
                        window.location="/shops/"+id+"/edit"
                    }
                });
            });
        });



    </script>
@endsection


