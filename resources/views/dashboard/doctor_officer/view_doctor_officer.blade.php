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
                url:"{{url('dashboard/bvon-doctor/dynamic_dependent/fetch')}}",
                method:"POST",
                data:{ value:value, _token:_token},
                success:function(result)
                {
                    $('#upazilla').html(result);
                }
            });

            $.ajax({
                url:"{{url('dashboard/bvon-doctor/dynamic_dependent/fetch-table')}}",
                method:"POST",
                data:{ value:value, _token:_token},
                success:function(result)
                {
                    $('#userdetails').html(result);
                }
            })
        }) ;

        $('#upazilla').on('change', function () {
            var value = $(this).val();
            var _token = $('input[name="_token"]').val();
            // alert(value);

            $.ajax({
                url:"{{url('dashboard/bvon-doctor/dynamic_dependent/fetch-table-field')}}",
                method:"POST",
                data:{ value:value, _token:_token},
                success:function(result)
                {
                    $('#userdetails').html(result);
                }
            })
        });

        $(document).ready(function () {

            $.ajax({
                url:"{{url('dashboard/bvon-doctor/dynamic_dependent/fetch-table-district')}}",
                method:"get",
                success:function(result)
                {
                    $('#userdetails').html(result);
                }
            })
        })
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Add Bvon Doctor Officer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Add Bvon Doctor Officer</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="district">District Officer</label>
                            <select name="district" id="district"  class="js-select2 form-control" required>
                                <option value="">Choose District Officer</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}-{{$user->referral_id}}"  >{{$user->user->name}} {{$user->user->referral_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="upazilla">Upazilla Officer</label>
                            <select name="upazilla" id="upazilla"  class="js-select2 form-control">
                                <option value="">Choose Upazilla Officer</option>

                            </select>
                        </div>
                    </div>
                </div>


            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th >Account</th>
                        <th>phone</th>
                        <th>All Register</th>
                        <th>Current Register</th>
                        <th>Total Officer</th>
                        <th>Target</th>
                        <th>Percentage</th>
                        <th>Salary</th>
                        <th>Sign Up</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="userdetails">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
