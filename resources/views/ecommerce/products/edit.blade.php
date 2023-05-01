@extends('ecommerce.eco_layout.main')

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/simplemde/simplemde.min.css')}}">

@endsection
@section('css_after')
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <style>
        .inputFileWithColor {
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            position: relative;
            max-width: 250px;
            height: 250px;
            overflow: hidden;
        }
        .inputFileWithColor input[type="color"] {
            background: transparent;
            border: 0;
            width: 30px;
            height: 30px;
            padding: 0;
            box-sizing: border-box;
        }
        .inputFileWithColor img.img-preview {
            position: absolute;
            top: 0;
            height: 90%;
            left: 50%;
            transform: translateX(-50%);
        }
        .inputFileWithColor div.bottom-section {
            position: absolute;
            bottom: 0;
            background: #ddd;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: stretch;
            padding: 5px;
            box-sizing: border-box;
            left: 0;
            border-top: 2px solid #222;
        }
        .inputFileWithColor:first-child:before {
            content: 'thumbnail';
            position: absolute;
            top: 0;
            z-index: 999;
            padding: 5px;
            border: 1px solid #1d1b1b;
            color: #efecec;
            right: 10px;
            top: 8px;
            font-size: 10px;
            text-transform: uppercase;
            border-radius: 3px;
            background: rgba(0,0,0,.4);
            letter-spacing: 1.5px;
        }
        .tox-notifications-container, .tox-statusbar__branding {
            display: none !important;
        }
    </style>
@endsection

@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Product Edit</h2>
    <div class="row">

        <div class="col-md-12">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Product Add</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form id="product-add-form" action="{{route('products.update',$products->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                         @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-nf-email">Product Name</label>
                                    <input type="text" class="form-control"  name="product_name" placeholder="Enter Product Name" value="{{$products->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">Premium Price</label>
                                    <input type="text" class="form-control" name="premium_price" placeholder="Enter Product Price" value="{{$products->premium_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">User Price</label>
                                    <input type="text" class="form-control" name="user_price" placeholder="Enter User Price" value="{{$products->user_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">Product Quantity</label>
                                    <input type="text" class="form-control"  name="product_quantity" placeholder="Enter Product Quantity" value="{{$products->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">Product Model</label>
                                    <input type="text" class="form-control"  name="product_model" placeholder="Enter Product Model" value="{{$products->product_model}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="example-select">Shop</label>
                                    <select class="js-example-placeholder-single js-states form-control" name="shop_id">
                                        <option value="{{$products->shop_id}}" selected="selected">{{$products->shops->shop_name}}</option>
                                        @foreach ($shops as $shop)
                                        <option value="{{$shop->id}}">{{$shop->shop_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="" for="example-select">Category Name</label>
                                    <select class="js-example-placeholder-single js-states form-control" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if($products->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="" for="example-select">SubCategory</label>
                                    <select class="js-example-placeholder-single js-states form-control" name="subcategory_id" id="subcategory_id">
                                        @foreach ($subcategories as $sub_category)
                                            <option value="{{$sub_category->id}}" @if($products->subcategory_id == $sub_category->id) selected @endif>{{ $sub_category->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="" for="example-select">Product Brand</label>
                                    <div class="">
                                        <select id="brand_id" class="js-example-placeholder-single js-states form-control" name="brand_id">
                                            @foreach ($allbrands as $brand)
                                                <option value="{{$brand->id}}" @if($products->brand_id == $brand->id) selected @endif>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>




                                <div class="form-group card">
                                    <div class="form-group card-body">
                                        <label for="example-nf-email">Size:</label>
                                        @php
                                            $sizes = explode(',', $products->product_size);
                                        @endphp
                                        <div id="myId" class="row">
                                            @foreach($sizes as $size)
                                                <div class="col-md-6">
                                                    <input type="checkbox" name="size[]" value="{{$size}}" checked> {{$size}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group card-body">
                                        <label for="example-nf-email">New Size:(If you need Size added) </label>
                                        <input type="text" class="form-control" id="all_size" name="all_size" placeholder="Enter Name" value="">
                                        <input type="hidden" class="form-control" id="subcategories_id" name="subcategories_id" value="">
                                        <button type="button" class="btn btn-primary mt-10" id="saveBtn" value="create">Add</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">*</span></label>
                                    <textarea id="pro-des" class="form-control" name="description" id="description" cols="40" rows="30" >{{$products->description}}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-alt-primary w-100">Submit</button>
                                </div>
                            </div>
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
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>
    <script src="{{ asset('js/ku-modules/input.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#pro-des',
            plugins: ["table", "code"],

        });
    </script>
    <script>
        jQuery(function(){ Codebase.helpers(['summernote', 'ckeditor', 'simplemde']); });
    </script>

    <script>
        $("#product-add-form").validate({
            submitHandler: function(form) {
                form.submit()
            },
            rules: {
                product_name : {
                    required : true,
                    minlength: 3,
                    maxlength: 40
                },
                product_model : {
                    required : true,
                    minlength: 3,
                    maxlength: 40
                },
                user_price: {
                    required: true,
                    number: true
                },
                product_quantity: {
                    required: true,
                    number: true
                },
                shop_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
            }
        });



    </script>
    <script>
        $('select[name="shop_id"]').select2({
            placeholder: "Please Select a Shop",
            allowClear: true
        });

        $('select[name="brand_id"]').select2({
            placeholder: "Please Select a Brand",
            allowClear: true
        });
        $('select[name="category_id"]').select2({
            placeholder: "Please Select a Category",
            allowClear: true
        });
        $('select[name="subcategory_id"]').select2({
            placeholder: "Please Select One Sub Category",
            allowClear: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on("change", function() {
                var category_id = $(this).val();
                var mysub;
                if (category_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{url('/get/subcat/')}}/" + category_id,
                        dataType: 'json',
                        success: function(data) {
                            let output = '<option disabled>Please Select One</option>';
                            $.each(data, function(key, value) {
                                output += '<option value="' + value.id + '">' + value.sub_category_name + '</option>';
                            });
                            $("#subcategory_id").html(output);
                        }


                    });

                } else {
                    alert('danger');
                }
            });

            $('select[name="subcategory_id"]').on("change", function() {
                var subcategory_id = $(this).val();
                var mysub;
                if (subcategory_id) {
                    console.log(subcategory_id);
                    $("#subcategories_id").val(subcategory_id);
                    $.ajax({
                        type: "GET",
                        url: "{{url('/get/size/')}}/" + subcategory_id,
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.size);
                            let mySize = '';
                            var sub;
                            $.each(data.size, function(key, value) {
                                mySize += `<div class="col-md-6"><input type="checkbox" value="${value.all_size}" name="size[]"> ${value.all_size}</div>`;
                                sub = value.subcategories_id;
                            });
                            $("#myId").html(mySize);
                            let brands = '<option value="" >Please Select One</option>';
                            $.each(data["brands"], function(key, value) {
                                brands += '<option value="' + value.id + '">' + value.name + '</option>';
                                // mysub = value.sub_category_name;
                            });
                            $("#brand_id").html(brands);
                        }
                    });
                }
            });
        });




        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                let size = $("#all_size").val();
                let cat_id = $("#subcategories_id").val();
                console.log("cat_id", cat_id);
                console.log("size", size);

                $.ajax({
                    data: {
                        size: size,
                        cat_id: cat_id
                    },
                    url: "{{ route('size.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $("#myId").append(`<div class="col-md-6"><input type="checkbox" value="${data.size}" name="size[]"> ${data.size}</div>`)
                        $("#all_size").val("");
                        sub = "";
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });


        });
    </script>
@endsection
