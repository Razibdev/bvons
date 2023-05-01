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
                url: "{{url('/bvon/blood/user/status/dependency/thana')}}",
                method: "get",
                data: {value: value, _token: _token},
                success: function (result) {
                    $('#upazilla').html(result);
                }
            });
        });
    </script>

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Bpay Add Marchant Shop</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Bpay Add Marchant Shop</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.bpay.edit.marchant.shop', $marchant->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <select name="category_name" id="category_name" class="form-control js-select2">
                            <option value="0" disabled>Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == $marchant->category_id) selected @endif >{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="username">User Name</label>
                        <select name="username" id="username" class="form-control js-select2">
                            <option value="0" disabled selected >Choose User</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($user->id == $marchant->user_id) selected @endif >{{$user->name}} - {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="organize_name">Organize Name</label>
                        <input type="text" name="organize_name" id="organize_name" class="form-control" placeholder="Enter Organize Name" required value="{{$marchant->name}}">
                    </div>

                    <div class="form-group">
                        <label for="organize_address">Organize Address</label>
                        <input type="text" name="organize_address" id="organize_address" class="form-control" placeholder="Enter Organize Address" required value="{{$marchant->address}}">
                    </div>


                    <div class="form-group">
                        <label for="mobile">Organize Marchant Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Organize Marchant Mobile" required value="{{$marchant->mobile}}">
                    </div>

                    <div class="form-group">
                        <label for="percentage">Organize Marchant Percentage</label>
                        <input type="text" name="percentage" id="percentage" class="form-control" placeholder="Enter Commision Percentage" required value="{{$marchant->percentage}}">
                    </div>


                    <div class="form-group">
                        <label for="logo">Marchant Shop Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control" >
                        <input type="hidden" name="current_image" value="{{$marchant->logo}}">
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <select name="district" id="district" class="form-control js-select2">
                            <option value="0" disabled selected >Choose District</option>
                            @foreach($districts as $district)
                                <option value="{{$district->id}}" @if($district->id == $marchant->district_id) selected @endif>{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="upazilla">Thana</label>
                        <select name="upazilla" id="upazilla"  class="js-select2 form-control">
                            <option value="">Choose Thana</option>

                        </select>
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
