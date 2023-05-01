@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $('#district').on('change', function () {
            var value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/fetch-thana-data-dependacy')}}",
                method:"POST",
                data:{ value:value, _token:_token},
                success:function(result)
                {
                    $('#thana').html(result);
                }
            });
        })
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Bpay Add Category</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Bpay Add Category</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.bpay.add.category')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required value="{{old('category_name')}}">
                    </div>


                    <div class="form-group">
                        <label for="logo">Category Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control" >
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-lg btn-alt-success">Submit</button>
                    </div>
                </form>


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
