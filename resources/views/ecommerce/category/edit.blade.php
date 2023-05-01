@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection



@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Category</h2>
    <div class="row">

        <div class="col-md-8">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Category Add</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('category.update', ["category" => $ecoCategory->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="example-nf-email">Category Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="category_name" placeholder="Enter Category Name" required value="{{$ecoCategory->category_name}}">
                        </div>

                        <div class="form-group">
                            <label for="category_url">Category url</label>
                            <input type="text" class="form-control product_quantity" id="category_url" data-id="{{$ecoCategory->id}}" name="quantity" placeholder="Enter Category Url" value="{{$ecoCategory->url}}">
                        </div>

                        <div class="form-group row">
                            <label class="col-12">Category Image</label>
                            <div class="col-md-12 mb-10">
                                <div id="ImdID">
                                    <img class="" src="{{asset('/storage/')}}/{{$ecoCategory->categories_image}}" alt="" height="100">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" onchange="shopEdit(this)" class="custom-file-input" id="example-file-input-custom" name="categories_image" data-toggle="custom-file-input">
                                    <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                </div>
                            </div>
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
                let category_url = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-category-url')}}",
                    data:{'category_url': category_url,  'id':id},
                    success:function(data){
                        console.log(data.message);
                        window.location="/category/"+id+"/edit"
                    }
                });
            });
        });


    </script>
@endsection
