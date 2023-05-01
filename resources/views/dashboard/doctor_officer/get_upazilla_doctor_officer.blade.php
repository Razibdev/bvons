@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        $(document).ready(function () {
            $.ajax({
                url:"{{url('dashboard/bvon-doctor/upazilla-doctor-officer/fetch')}}",
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
        <h2 class="content-heading">Get District Doctor Officer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Get District Doctor Officer</small>
                </h3>
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
