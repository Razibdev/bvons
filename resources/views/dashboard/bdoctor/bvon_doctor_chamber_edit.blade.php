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

    <script>
        $(document).ready(function(){
            $(document).on('click', '.deleteDoctorInfo', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('/dashboard/bvon-doctor/bvon-doctor-chamber-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = '/dashboard/bvon-doctor/bvon-doctor-chamber-list';
                        }
                    });
                }
            });
        });
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Edit Bvon Chamber</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Edit Bvon Chamber</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.doctor.chamber.edit', $doctorChamber->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="chamber_name">Chamber Name</label>
                        <input type="text" name="chamber_name" id="chamber_name" class="form-control" placeholder="Enter Chamber Name" required value="{{$doctorChamber->chamber_name}}">
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <select name="district" id="district" required class="js-select2 form-control">
                            <option value="">Choose Account</option>
                            @foreach($district as $dis)
                                <option value="{{$dis->id}}" @if($doctorChamber->district_id == $dis->id) selected @endif >{{$dis->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="thana">Thana</label>
                        <select name="thana" id="thana" class="js-select2 form-control" >
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
