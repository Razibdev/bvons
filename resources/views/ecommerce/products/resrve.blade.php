@extends('ecommerce.eco_layout.main')

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <style>
        .inputFileWithColor {
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            position: relative;
            max-width: 175px;
            height: 200px;
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


    </style>
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
                    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-nf-email">Product Name</label>
                                    <input type="text" class="form-control" id="example-nf-email" name="product_name" placeholder="Enter Product Name">
                                    <input type="hidden" class="form-control" id="example-nf-email" name="vendor_id" value="{{ Auth::user()->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">Premium Price</label>
                                    <input type="text" class="form-control" id="example-nf-email" name="premium_price" placeholder="Enter Premium Price">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">User Price</label>
                                    <input type="text" class="form-control" id="example-nf-email" name="user_price" placeholder="Enter User Price">
                                </div>
                                <div class="form-group">
                                    <label for="example-nf-email">Quantity</label>
                                    <input type="text" class="form-control" id="example-nf-email" name="product_quantity" placeholder="Enter Quantity">
                                </div>

                             <div class="form-group">
                                    <label for="example-nf-email">Description</label>
                                    <input type="text" class="form-control" id="example-nf-email" name="description" placeholder="Enter Product description">
                            </div>
                           
                            </div>
                            <div class="col-md-6">

                                <div class="form-group row">
                                    <label class="col-12" for="example-select">Shop</label>
                                    <div class="col-md-12">
                                        <select class="js-example-placeholder-single js-states form-control" name="shop_id">
                                            <option value="0">Please select Shop</option>
                                            @foreach ($shops as $shop)
                                            <option value="{{$shop->id}}">{{$shop->shop_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12" for="example-select">Category Name</label>
                                    <div class="col-md-12">
                                        <select class="js-example-placeholder-single js-states form-control" name="category_id" id="category_id">
                                            <option selected="" disabled>Please select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            

                                <div class="form-group row">
                                    <label class="col-12" for="example-select">SubCategory</label>
                                    <div class="col-md-12">
                                        <select class="js-example-placeholder-single js-states form-control" name="subcategory_id" id="subcategory_id">
                                            <option selected="" disabled>Please select SubCategory</option>
                                        </select>
                                    </div>
                                </div>
                                    <p id="myId">hello</p>
                                <div class="form-group">
                                        <label for="example-nf-email">Size: </label>
                                        <input type="text" class="form-control" id="example-nf-email" name="product_size" placeholder="Enter Size">
                                </div>

                                {{-- Color Picker Vue --}}
                                <div class="form-group row">
                                    <label class="col-12" for="">Add Product Images</label>
                                    <div id="vue-el" class="col-12">
                                        <input-file-with-color
                                            name="inputFileWithColor"
                                            v-for="singleInput in inputList"
                                            v-bind:key="singleInput.id"
                                            :id="singleInput.id"
                                            v-on:remove-list-item="removeInputList"
                                        >
                                        </input-file-with-color>
                                        <div class="mt-2 text-center">
                                            <button type="button" @click="addInputList" v-if="inputList.length < 5" class="btn btn-alt-success">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
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
    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/ku-modules/input.js') }}"></script>
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script>
        $(document).ready(function(){
        $('select[name="category_id"]').on("change",function(){
            var category_id = $(this).val();
            if(category_id){
           // console.log(category_id);

                $.ajax({
                type:"GET",
                url:"{{url('/get/subcat/')}}/"+category_id,
                dataType:'json',
                success: function(data){
                    //  $("#subcategory_id").empty();
                    $.each(data,function(key,value){
                            $("#subcategory_id").append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');
                        });
                    }
                });

            }else{
            alert('danger');
            }
        });
    });


    //testingggggggggggggg

    //  $(document).ready(function(){
    //         $('select[name="subcategory_id"]').on("change",function(){
    //         var subcategory_id = $(this).val();

            
    //     //     if(category_id){

    //         //  console.log(subcategory_id);
    //           $("#subcategory_id").empty();

    //         // $("#myId").val("Dolly Duck");
    //     //         $.ajax({
    //     //         type:"GET",
    //     //         url:"{{url('/get/subcat/')}}/"+category_id,
    //     //         dataType:'json',
    //     //         success: function(data){
    //     //             $("#subcategory_id").empty();
    //     //             $.each(data,function(key,value){
    //     //                     $("#subcategory_id").append('<option value="'+value.id+'">'+value.sub_category_name+'</option>');
    //     //                 });

    //     //         }
                
    //     // });

    //     //     }else{
    //     //     alert('danger');
    //     //     }
    //     });
    //     });




$('select[name="subcategory_id"]' )
  .change(function () {
        var subcategory_id = $(this).val();
    var str = "vbnvg";
    // $( "select option:selected" ).each(function() {
    //   str += $( this ).text() + " ";
    // });
    $( "#myId" ).text( subcategory_id );
    // $("#subcategory_id").empty();
  })
  .change();
</script>
@endsection