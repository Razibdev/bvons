 @extends('ecommerce.eco_layout.main')

 @section('css_before')
 <link rel="stylesheet" href="{{ asset('css/button.css') }}">
 @endsection

 @section('js_after')
     <script>
         function shopEdit(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();

                 reader.onload = function(e) {
                     $('#ImdID, #ImdID2').html(`<img src="${e.target.result}">`);
                 };
                 reader.readAsDataURL(input.files[0]);
             }
         }
     </script>
     <script>
         $("a[media]").click(function(){
             let media = JSON.parse($(this).attr('media'));

             let formUrl = "{{ url('media/update') }}".concat(`/${media.id}`);
             let imgUrl = "{{ asset('/storage/')}}".concat(`/${media.product_image}`);

             $("#edit-media-form").attr('action', formUrl);
             $("#ImdID2").html(`<img src="${imgUrl}">`);
             $('#edit-color').attr('value', media.product_color);

             if($("#edit-product-img").val()) {
                 $("#edit-product-img").val(null);
             }

         });



         $(document).ready(function() {
             $(document).on('change', '#product_url', function () {
                 let product_url = $(this).val();
                 let id = $(this).data('id');

                 $.ajax({
                     dataType: 'json',
                     type: "GET",
                     url: "{{url('/update-product-url')}}",
                     data: {'product_url': product_url, 'id': id},
                     success: function (data) {
                         window.location = '/products/' + id;

                     }
                 });
             });
         });

     </script>
 @endsection

 @section('content')



 <div class="content">
     <div class="block block-rounded block-fx-shadow">
         <div class="block">
             <div class="block-header block-header-default">
                 <h3 class="block-title">Product Details</h3>
                 @if($products->product_permision === "pending")
                 <div class="block-options">
                     <button type="button" class="btn-block-option">
                         <a href="{{ route('products.details.edit', ["id" => $products->id]) }}">
                             <i class="si si-pencil"></i>
                         </a>
                     </button>
                 </div>
                 @endif
             </div>
             <div class="block-content block-content-full">
                 <div class="row d-flex mb-20">
                     <div class="col-md-12">
                         <h5 class="mt-5 mb-5 font-weight-bold">Product Details</h5>
                     </div>
                     <div class="col-md-6">
                         <table class="table table-bordered">
                             <tr>
                                 <th>Name</th>
                                 <td>{{ $products->product_name }}</td>
                             </tr>
                             <tr>
                                 <th>Sizes</th>
                                 <td>{{ $products->product_size }}</td>
                             </tr>
                             <tr>
                                 <th>Quantity</th>
                                 <td>{{ $products->product_quantity }}</td>
                             </tr>
                             <tr>
                                 <th>Model No</th>
                                 <td>{{ $products->product_model }}</td>
                             </tr>
                             <tr>
                                 <th>Status</th>
                                 <td>{{ $products->product_permision }}</td>
                             </tr>

                             <tr>
                                 <th>Product Url</th>
                                 <td><input type="text" name="product_url" id="product_url" placeholder="product url" class="form-control" data-id="{{$products->id}}" value="{{$products->product_url}}"></td>
                             </tr>

                         </table>

                     </div>
                     <div class="col-md-6">
                         <table class="table table-bordered">
                             <tr>
                                 <th>Vendor Name</th>
                                 <td>{{ $products->vendor->name }}</td>
                             </tr>
                             <tr>
                                 <th>Shop Name</th>
                                 <td>{{ $products->shop->shop_name }}</td>
                             </tr>
                             <tr>
                                 <th>Category Name</th>
                                 <td>{{ $products->category->category_name }}</td>
                             </tr>
                             <tr>
                                 <th>Sub Category Name</th>
                                 <td>{{ $products->sub_category->sub_category_name }}</td>
                             </tr>
                             <tr>
                                 <th>Brand</th>
                                 <td>{{ $products->brands->name }}</td>
                             </tr>

                         </table>
                         {{--<p class="mt-5 m-0 font-weight-bold">Product Images</p>
                         <div class="d-flex" style="border: 1px solid #ddd;">
                             @foreach($products->media as $media)
                                 <div class="product-image d-flex flex-column">
                                     <div class=""><img class="w-100" src="{{url('/storage/')}}/{{ $media->product_image }}" alt=""></div>
                                     <div class="text-center" style="background: {{ $media->product_color }}; color: #fff;">{{ $media->product_color }}</div>
                                 </div>
                             @endforeach
                         </div>--}}

                     </div>
                 </div>
                 <div class="row mb-20">
                     <div class="col-md-12">
                         <h5 class="mt-5 mb-5 font-weight-bold">Product Images</h5>
                         @foreach($medias as $media)
                             <div class="product-images mr-10 d-inline-block">
                                 <img src="{{asset('/storage/')}}/{{$media->product_image}}" class="card-img-top" alt="..." height="100">

                                 <div class="action-area">
                                     <a class="d-inline-block" style="background-color:{{$media->product_color}};border-radius: 100%;border: 1px solid #222;"></a>
                                     {{--<a class="" media="{{$media}}" href="--}}{{-- route('media.edit',$media->id) --}}{{--" data-toggle="modal" data-target="#editModel"><i class="si si-pencil"></i> </a>

                                     @if($loop->iteration > 1)
                                         <a class="text-danger" href="{{route('media.delete',$media->id)}}"><i class="si si-trash"></i> </a>
                                     @endif--}}
                                 </div>
                             </div>
                         @endforeach
                         @if($medias->count() < 5)
                         <div class="product-images mr-10 d-inline-block d-inline-flex justify-content-center align-items-center" style="vertical-align: top">
                             <a href="#" data-toggle="modal" data-target="#myModal" class="d-flex justify-content-center align-items-center flex-column">
                                 <span class="text-secondary text-small mb-10">Add New Product Image</span>
                                 <i class="si si-plus fa-2x"></i>
                             </a>
                         </div>
                         @endif
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-12">
                         <h5 class="mt-5 mb-5 font-weight-bold p-0">Description</h5>
                         <div class="m-0 css-revert">{!! $products->description !!}</div>
                     </div>
                 </div>
             </div>
         </div>
     </div>


{{-- Add Model --}}
     <div class="row">
         <div class="col-md-12">
             <div class="modal fade" id="myModal" role="dialog">
                 <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content">
                         <div class="modal-header">
                             <h4 class="modal-title">Add Proudct Image</h4>
                         </div>
                         <div class="modal-body">
                             <form method="post" action="{{ route('media.add') }}" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                                 <div class="form-group">
                                     <label for="">Color:</label>
                                     <input class="form-control" type="color" name="color" id="color">
                                     <input class="form-control" type="hidden" name="productid" id="productid" value="{{$products->id}}">
                                 </div>
                                 <div class="form-group">
                                     <label for="pwd">Image:</label>
                                     <div id="ImdID" style="max-width: 350px; overflow: hidden;"></div>
                                     <input class="form-control" type="file" name="product_image" id="select_file" onchange="shopEdit(this)">
                                 </div>
                                 <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
                             </form>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>



{{--Edit Model--}}
     <div class="row">
         <div class="col-md-12">
             <div class="modal fade" id="editModel" role="dialog">
                 <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content">
                         <div class="modal-header">
                             <h4 class="modal-title">Edit Proudct Image</h4>
                         </div>
                         <div class="modal-body">
                             <form method="post" action="" enctype="multipart/form-data" id="edit-media-form">
                                 @csrf
                                 <div class="form-group">
                                     <label for="">Color:</label>
                                     <input class="form-control" type="color" name="product_color" id="edit-color">
                                     <input class="form-control" type="hidden" name="productid" id="productid" value="{{$products->id}}">
                                 </div>
                                 <div class="form-group">
                                     <label for="pwd">Image:</label>
                                     <div class="mb-10" id="ImdID2" style="max-width: 350px; overflow: hidden;"></div>
                                     <input id="edit-product-img" class="form-control" type="file" name="product_image" id="select_file" onchange="shopEdit(this)">
                                 </div>
                                 <input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
                             </form>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>

 </div>

 <!-- END Page Content -->



 @endsection
