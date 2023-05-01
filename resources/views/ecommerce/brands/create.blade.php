@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('js_after')
    <script>
        $('select[name="subcategory_id"]').select2({
            placeholder: "Please Select One Sub Category",
            allowClear: true
        });
    </script>
@endsection

@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Brand</h2>
    <div class="row">

        <div class="col-md-8">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Brand Add</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="example-nf-email">Brand Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="name" placeholder="Enter Brand Name">
                        </div>

                        <div class="form-group">
                            <label for="example-nf-email">Select Sub Category</label>

                            <select class="form-control" name="subcategory_id" id="subcategory_id">
                                @foreach($sub_categories as $sub_category)
                                    <option value="{{$sub_category->id}}">{{$sub_category->sub_category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Brand Image</label>
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="example-file-input-custom" name="brand_image" data-toggle="custom-file-input">
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

