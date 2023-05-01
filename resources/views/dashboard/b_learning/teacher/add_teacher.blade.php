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

    </script>


@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Teacher</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Teacher Add</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form action="{{route('blearning.teacher.create')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="subject">Subject Name</label>
                                <select name="subject" id="subject" class="form-control">
                                    <option value="">Choose Teacher</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="teacher_name">Teacher Name</label>
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name" placeholder="Enter Course Name" required>
                            </div>

                            <div class="form-group">
                                <label for="u_name">University Name</label>
                                <input type="text" class="form-control" id="u_name" name="u_name" placeholder="Enter Live Class Number" required>
                            </div>

                            <div class="form-group row">
                                <label class="col-12">Teacher Image</label>
                                <div class="col-md-12 mb-10">
                                    <div id="ImdID">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custom-file">
                                        <input type="file" onchange="shopEdit(this)" class="custom-file-input" id="example-file-input-custom" name="profile_image" data-toggle="custom-file-input">
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
