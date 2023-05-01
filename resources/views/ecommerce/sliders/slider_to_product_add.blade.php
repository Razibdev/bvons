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
                    <form action="{{route('sliderDetails.store')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Slider Type</label>
                            <div class="col-md-12">
                                <select class="js-example-placeholder-single js-states form-control" name="slider_id">
                                        @foreach($sliders as $slider)
                                            <option value="{{$slider->id }}">{{$slider->sliders_name }}</option>
                                        @endforeach
                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12" for="example-select">Products</label>
                            <div class="col-md-12">
                                <select class="js-example-placeholder-single js-states form-control" name="product_id">
                                         @foreach($products as $product)
                                            <option value="{{$product->id }}">{{$product->product_name }}</option>
                                        @endforeach
                                  
                                    </select>
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
