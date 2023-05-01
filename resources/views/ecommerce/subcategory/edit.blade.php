@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection



@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">SubCategory</h2>
    <div class="row">

        <div class="col-md-8">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">SubCategory Add</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>



                <div class="block-content">
                    <form action="{{route('subcategory.update', ['subcategory' => $sub_category->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="example-nf-email">SubCategory Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="url"  placeholder="Enter Category Name" required value="{{$sub_category->sub_category_name}}">
                        </div>

                        <div class="form-group">
                            <label for="example-nf-email">SubCategory Url</label>
                            <input type="text" class="form-control product_quantity" data-id="{{$sub_category->id}}" id="example-nf-email" name="sub_category_name" placeholder="Enter Category Name" required value="{{$sub_category->url}}">
                        </div>

                        <div class="form-group row">
                            <label class="col-12" for="example-select">Please select Category</label>
                            <div class="col-md-12">
                                <select class="js-example-placeholder-single js-states form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        <option @if($sub_category->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->category_name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">SubCategory Image</label>
                            <div class="col-md-12 mb-10">
                                <div id="ImdID">
                                    <img class="" src="{{asset('/storage/')}}/{{$sub_category->subcategories_image}}" alt="" height="100">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" onchange="shopEdit(this)" class="custom-file-input" id="example-file-input-custom" name="subcategories_image" data-toggle="custom-file-input">
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
                let sub_url = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-sub-category-url')}}",
                    data:{'sub_url': sub_url,  'id':id},
                    success:function(data){
                        console.log(data.message);
                        window.location="/subcategory/"+id+"/edit"
                    }
                });
            });
        });



    </script>
@endsection


