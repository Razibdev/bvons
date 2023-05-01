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
        function productAdd(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#ImdID').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on("change", function() {
                var category_id = $(this).val();

                $("#myId").html('');
                if (category_id) {
                    // console.log(category_id);

                    $.ajax({
                        type: "GET",
                        url: "{{url('/get/subcat/')}}/" + category_id,
                        dataType: 'json',
                        success: function(data) {
                            //$("#subcategory_id").empty();
                            let output = '<option value="" >Please Select One</option>';
                            $.each(data, function(key, value) {
                                output += '<option value="' + value.id + '">' + value.sub_category_name + '</option>';
                                // mysub = value.sub_category_name;
                            });
                            $("#subcategory_id").html(output);
                            //   console.log(mysub);
                        }
                    });

                } else {
                    alert('danger');
                }
            });
            $('select[name="subcategory_id"]').on("change", function() {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    console.log(subcategory_id);
                    $("#subcategories_id").val(subcategory_id);
                    $.ajax({
                        type: "GET",
                        url: "{{url('/get/size/')}}/" + subcategory_id,
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            let mySize = '';
                            var sub;
                            $.each(data["size"], function(key, value) {
                                mySize += `<div><input type="checkbox" value="${value.all_size}" name="size[]"> ${value.all_size}</div>`;
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
                //  $(this).html('Sending..');
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
                        console.log("clicked", data);
                        console.log(data.size);
                        $("#myId").append(`<span><input type="checkbox" value="${window.convertHTML(data.size)}" name="size[]"> ${window.convertHTML(data.size)}</span>`)
                        //   $('#productForm').trigger("reset");
                        //   $('#ajaxModel').modal('hide');
                        //   table.draw();
                        //  $(this).html('Save Changes');
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



@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Product</h2>
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

                    <form id="product-add-form" class="js-validation-bootstrap" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="product_name">Product Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" value="{{ old('product_name') }}" >
                                    <input type="hidden" class="form-control" id="example-nf-email" name="vendor_id" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="form-group">
                                    <label for="product_model">Product Model<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="product_model"  name="product_model" placeholder="Enter Product Model" value="{{ old('product_model') }}" >
                                </div>




                                <div class="form-group">
                                    <label for="user_price">Price<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="user_price" name="user_price" placeholder="Enter Price" value="{{ old('premium_price') }}" >
                                </div>

                                <div class="form-group">
                                    <label for="product_quantity">Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Enter Quantity" value="{{ old('product_quantity') }}">
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="" for="example-select">Shop<span class="text-danger">*</span></label>
                                    <select id="shop_id" class="form-control" name="shop_id" >
                                        <option selected value=""></option>
                                        @foreach ($shops as $shop)
                                            <option @if(old('shop_id') == $shop->id) selected @endif value="{{$shop->id}}">{{$shop->shop_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="" for="example-select">Category Name<span class="text-danger">*</span></label>
                                    <select class="form-control" name="category_id" id="category_id" >
                                        <option selected value=""></option>
                                        @foreach ($categories as $category)
                                        <option @if(old('category_id') == $category->id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="" for="example-select">Sub Category<span class="text-danger">*</span></label>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id" >
                                        @if(old('category_id'))
                                            @foreach ($categories as $category)
                                                @if(old('category_id') == $category->id)
                                                    <option selected value=""></option>
                                                    @foreach($category->sub_categories as $sub_category)
                                                        <option @if(old('subcategory_id') == $sub_category->id) selected @endif value="{{$sub_category->id}}">{{$sub_category->sub_category_name}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @else
                                            <option selected value=""></option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="" for="example-select">Brand<span class="text-danger">*</span></label>
                                    <select class="form-control" name="brand_id" id="brand_id" >
                                        <option selected value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="example-nf-email">Size<span class="text-danger">*</span></label>
                                    <div id="myId" class=""></div>
                                </div>

                                <div class="form-group">
                                    <label for="example-nf-email">New Size:(If you need Size added) </label>
                                    <input type="text" class="form-control" id="all_size" name="all_size" placeholder="Enter Name" value="">
                                    <input type="hidden" class="form-control" id="subcategories_id" name="subcategories_id" value="">
                                    <button type="button" class="btn btn-primary" id="saveBtn" value="create">Add</button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description<span class="text-danger">*</span></label>
                                    <br>
                                    <textarea id="pro-des" class="form-control" name="description" id="description" cols="40" rows="8" >{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Add Product Images & Color</label>
                                    {{-- Color Picker Vue --}}
                                    <div id="vue-el" class="col-12">
                                        <input-file-with-color name="inputFileWithColor" v-for="singleInput in inputList" v-bind:key="singleInput.id" :id="singleInput.id" v-on:remove-list-item="removeInputList">
                                        </input-file-with-color>
                                        <div class="mt-2 text-center">
                                            <button type="button" @click="addInputList" v-if="inputList.length < 5" class="btn btn-alt-success">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button onclick="confirm('Be careful you cannot change any data once you added your product.')" type="submit" class="btn btn-alt-primary w-100">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div>

                </div>
            </div>
            <!-- END Normal Form -->
        </div>
    </div>

    <!-- END Bootstrap Design -->
</div>
<!-- END Page Content -->
@endsection


