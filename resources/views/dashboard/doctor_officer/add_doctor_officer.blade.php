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
        <h2 class="content-heading">Add Bvon Doctor Officer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Add Bvon Doctor Officer</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.doctor.add.officer')}}" method="post" enctype="multipart/form-data">
                    @csrf




                    <div class="form-group">
                        <label for="district">District Officer</label>
                        <select name="district" id="district"  class="js-select2 form-control" required>
                            <option value="">Choose District Officer</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}" @if(!empty($user->upaofficer) || !empty($user->fieldofficer)) disabled @endif >{{$user->name}} {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="upazilla">Upazilla Officer</label>
                        <select name="upazilla" id="upazilla"  class="js-select2 form-control">
                            <option value="">Choose Upazilla Officer</option>
                            @foreach($usersu as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}" @if(!empty($user->disofficer) ||  !empty($user->fieldofficer)) disabled @endif>{{$user->name}} {{$user->referral_id}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="field">Field Officer</label>
                        <select name="field" id="field"  class="js-select2 form-control">
                            <option value="">Choose Field Officer</option>
                            @foreach($usersf as $user)
                                <option value="{{$user->id}}-{{$user->referral_id}}" @if(!empty($user->disofficer) || !empty($user->upaofficer) || !empty($user->fieldofficer)) disabled @endif>{{$user->name}} {{$user->referral_id}}</option>
                            @endforeach
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
