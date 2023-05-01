@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('js_after')
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#ImdID').attr('src', e.target.result);
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
                    <form action="{{route('shops.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="example-nf-email">Shop Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="shop_name" placeholder="Enter Shop Name">
                            <input type="hidden" class="form-control" id="example-nf-email" name="vendor_id" value="{{ Auth::user()->id }}" placeholder="Enter Shop Name">
                        </div>
                        <div class="form-group">
                            <label for="example-nf-email">Shop Address</label>
                            <input type="text" class="form-control" id="example-nf-email" name="shop_address" placeholder="Enter Shop Address">
                        </div>
                        <div class="form-group row">
                            
                            <label class="col-12">Shop Image</label>
                            <img id="ImdID"  alt="Image" style="height:100px;max-width: 180px" />
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"  name="shop_image"  onchange="readURL(this)">
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

