@extends('ecommerce.eco_layout.b_learning_main_layout')

@section('css_before')

@endsection

@section('js_after')

    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content_description' );
    </script>
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

    </script>


@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Subject</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Subject Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{route('blearning.subject.edit', $subject->id)}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="course_id">Course</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">Choose Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}" @if($subject->course_id == $course->id) selected @endif >{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" value="{{$subject->subject_name}}" class="form-control" id="subject_name" name="subject_name" placeholder="Enter Subject Name" required>
                            </div>


                            <div class="form-group">
                                <label for="content_description">Content Description</label>
                                <textarea class="form-control" id="summary-ckeditor" name="content_description">{{$subject->subject_description}}</textarea>
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
