@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('js_after')
<script>
function mediaEdit(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#ImdID').html(`<img src="${e.target.result}"/>`);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
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
                    <form action="{{ route('media.update',$media->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="example-nf-email">Product Name</label>
                                    <!-- <span style="background-color:{{$media->product_color}}">Color</span> -->
                                    <input type="color" class="form-control"  name="product_color"  value="{{$media->product_color}}">
                                </div>
                            </div>

                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="example-nf-email">Product Image</label>
                                    <div>
                                            <p>New Image</p>
                                            <div id="ImdID"></div>

                                        </div>
                                    <div>
                                    <p>OLd Image</p>
                                        <img class="rounded-circle" src="{{asset('/storage/')}}/{{$media->product_image	}}" alt="" height="100">
                                    </div>
                                    <input type="file" class="form-control"  name="product_image" onchange="mediaEdit(this)">
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
