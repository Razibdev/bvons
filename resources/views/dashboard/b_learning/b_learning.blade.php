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
        <h2 class="content-heading">Dashboard</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->

                <!-- END Normal Form -->


            </div>
        </div>

        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->
@endsection
