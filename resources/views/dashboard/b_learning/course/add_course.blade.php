@extends('ecommerce.eco_layout.b_learning_main_layout')

@section('css_before')

@endsection

@section('js_after')
    <script>
        function shopEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImdID').html(`<img src="${e.target.result}">`);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }


        function shopVideo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#VideoID').html(`<video width="320" height="240" controls><source src="${e.target.result}" type="video/mp4"></video>`);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'course_description' );
    </script>

    <script>
        CKEDITOR.replace( 'course_feature' );
    </script>


@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Course</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Course Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{route('blearning.course.create')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter Course Name" required>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Choose type</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="live_class">Live Class</label>
                                <input type="text" class="form-control" id="live_class" name="live_class" placeholder="Enter Live Class Number" required>
                            </div>

                            <div class="form-group">
                                <label for="course_description">Course Description</label>
                                <textarea type="text" class="form-control" id="course_description" name="course_description" placeholder="Enter course description "></textarea>
                            </div>

                            <div class="form-group">
                                <label for="course_feature">Course Feature</label>
                                <textarea type="text" class="form-control" id="course_feature" name="course_feature" placeholder="Enter course description "></textarea>
                            </div>

                            <div class="form-group">
                                <label for="course_price">Course Price</label>
                                <input type="text" name="course_price" id="course_price" placeholder="Enter Course Price" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="current_price">Change Price</label>
                                <input type="text" name="current_price" id="current_price" placeholder="Enter Change Price" class="form-control">
                            </div>

                            <div class="form-group row">
                            <label class="col-12">Course Image</label>
                            <div class="col-md-12 mb-10">
                            <div id="ImdID">

                            </div>
                            </div>
                            <div class="col-12">
                            <div class="custom-file">
                            <input type="file" onchange="shopEdit(this)" class="custom-file-input" id="example-file-input-custom" name="course_image" data-toggle="custom-file-input">
                            <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                            </div>
                            </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-12">Course Video</label>
                                <div class="col-md-12 mb-10">
                                    <div id="VideoID">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" onchange="shopVideo(this)" class="custom-file-input" id="example-file-input-custom" name="course_video" data-toggle="custom-file-input">
                                        <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="top_course">Top Course</label>
                                <input type="checkbox" name="top_course" id="top_course" value="1">
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
