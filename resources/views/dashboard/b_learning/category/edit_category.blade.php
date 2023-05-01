@extends('ecommerce.eco_layout.b_learning_main_layout')

@section('css_before')

@endsection

@section('js_after')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Category</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Category Edit</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{route('blearning.categories.edit', $category->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="example-nf-email">Category Name</label>
                                <input type="text" value="{{$category->name}}" class="form-control" id="example-nf-email" name="name" placeholder="Enter Category Name" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Choose type</option>
                                    <option value="S.S.C" @if($category->type == 'S.S.C') selected @endif >S.S.C</option>
                                    <option value="H.S.C" @if($category->type == 'H.S.C') selected @endif >H.S.C</option>
                                    <option value="Admission" @if($category->type == 'Admission') selected @endif >Admission</option>
                                    <option value="Job" @if($category->type == 'Job') selected @endif >Job</option>
                                    <option value="Skills" @if($category->type == 'Skills') selected @endif >Skills</option>
                                </select>
                            </div>



                            {{--<div class="form-group row">--}}
                            {{--<label class="col-12">Category Image</label>--}}
                            {{--<div class="col-md-12 mb-10">--}}
                            {{--<div id="ImdID">--}}

                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-12">--}}
                            {{--<div class="custom-file">--}}
                            {{--<input type="file" onchange="shopEdit(this)" class="custom-file-input" id="example-file-input-custom" name="categories_image" data-toggle="custom-file-input" required>--}}
                            {{--<label class="custom-file-label" for="example-file-input-custom">Choose file</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}


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
