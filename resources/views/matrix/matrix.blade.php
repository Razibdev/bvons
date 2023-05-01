@extends('ecommerce.eco_layout.main')

@section('css_before')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">Matrix</h2>
        <div class="row">

            <div class="col-md-8">
                <!-- Normal Form -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Matrix Commission</h3>

                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <form method="POST" action="{{ route('matrix.user.commission') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="example-nf-email">Parent User</label>
                                <select name="parent_name" class="form-control js-example-basic-singles">
                                    <option value="">Choose user</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->referral_id}}">{{$user->name}}-{{$user->referral_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-nf-email">User Name</label>
                                <select name="user_name" class="form-control js-example-basic-single">
                                    <option value="" selected disabled>Choose user</option>
                                    @foreach($userm as $user)
                                        <option @if(isset($user->matrices->user_id)) @if($user->id == $user->matrices->user_id) hidden disabled  @endif @endif value="{{$user->id}}-{{$user->referral_id}}"> @if(isset($user->matrices->user_id)) {{$user->matrices->user_id}} @endif  {{$user->name}}-{{$user->referral_id}}</option>
                                    @endforeach
                                </select>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('.js-example-basic-singles').select2();
        });


        function shopEdit(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImdID').html(`<img src="${e.target.result}">`);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        $(document).ready(function(){
            $(document).on('change', '.product_quantity', function () {
                let band_url = $(this).val();
                let id = $(this).data('id');
                $.ajax({
                    dataType:'json',
                    type:"GET",
                    url: "{{url('/update-brand-url')}}",
                    data:{'band_url': band_url,  'id':id},
                    success:function(data){
                        console.log(data.message);
                        window.location="/brands/"+id+"/edit"
                    }
                });
            });
        });
    </script>
@endsection

