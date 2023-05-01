@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection



@section('content')

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Design -->
    <h2 class="content-heading">Slider</h2>
    <div class="row">

        <div class="col-md-8">
            <!-- Normal Form -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Slider Add</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>



                <div class="block-content">
                    <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                            <label for="example-nf-email">Slider Name</label>
                            <input type="text" class="form-control" id="example-nf-email" name="sliders_name" placeholder="Enter Slider Name">
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Slider Type</label>
                            <div class="col-md-12">
                                <select class="js-example-placeholder-single js-states form-control" name="sliders_type">
                                    <option value="Cashback">Cashback</option>
                                    <option value="Discount">Discount</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Add Percentage(%)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="example-nf-email" name="percentage" placeholder="Add Percentage" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-12">Slider Image</label>
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="example-file-input-custom" name="sliders_image" data-toggle="custom-file-input">
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

@endsection
