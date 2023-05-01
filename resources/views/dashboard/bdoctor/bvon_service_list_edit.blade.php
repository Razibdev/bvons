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
        <h2 class="content-heading">New Bvon Service</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>New Bvon Service</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('bvon.doctor.service.list.edit', $service->id)}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="organization_name">Organization Name</label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" placeholder="Enter Organization Name" required value="{{$service->organization_name}}">
                    </div>

                    <div class="form-group">
                        <label for="service">Service</label>
                        <select name="service" id="service" class="js-select2 form-control" required>
                            <option value="" selected disabled>Choose Service</option>
                            <option value="CHAIN BRANDS & SHOPS" @if($service->service == 'CHAIN BRANDS & SHOPS') selected @endif >CHAIN BRANDS & SHOPS</option>
                            <option value="SUPER SHOP" @if($service->service == 'SUPER SHOP') selected @endif >SUPER SHOP</option>
                            <option value="SHOES(Apex, Bata - Man and Woman)" @if($service->service == 'SHOES(Apex, Bata - Man and Woman)') selected @endif >SHOES(Apex, Bata - Man and Woman)</option>
                            <option value="HOTEL/PARK/RESORT" @if($service->service == 'HOTEL/PARK/RESORT') selected @endif >HOTEL/PARK/RESORT</option>
                            <option value="TAILORS & FABRICS" @if($service->service == 'TAILORS & FABRICS') selected @endif >TAILORS & FABRICS</option>
                            <option value="RESTAURANTS" @if($service->service == 'RESTAURANTS') selected @endif >RESTAURANTS</option>
                            <option value="TRANSPORTATIONS(Air, Bus, Launch, Train)"  @if($service->service == 'TRANSPORTATIONS(Air, Bus, Launch, Train)') selected @endif> >TRANSPORTATIONS(Air, Bus, Launch, Train)</option>
                            <option value="PARLOR(Man and Woman)" @if($service->service == 'PARLOR(Man and Woman)') selected @endif >PARLOR(Man and Woman)</option>
                            <option value="ELECTRONICS-KITCHEN & HOME APPLIANCES" @if($service->service == 'ELECTRONICS-KITCHEN & HOME APPLIANCES') selected @endif >ELECTRONICS-KITCHEN & HOME APPLIANCES</option>
                            <option value="HEALTH(MEDICAL, DIAGNOSTIC & PHARMACY SERVICES)" @if($service->service == 'HEALTH(MEDICAL, DIAGNOSTIC & PHARMACY SERVICES)') selected @endif >HEALTH(MEDICAL, DIAGNOSTIC & PHARMACY SERVICES)</option>
                            <option value="FURNITURE" @if($service->service == 'FURNITURE') selected @endif >FURNITURE</option>
                            <option value="IT" @if($service->service == 'IT') selected @endif >IT</option>
                            <option value="EDUCATION" @if($service->service == 'EDUCATION') selected @endif >EDUCATION</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="district">District</label>
                        <select name="district" id="district"  class="js-select2 form-control" required>
                            <option value="">Choose District</option>
                            @foreach($district as $dis)
                                <option value="{{$dis->id}}" @if($dis->id == $service->district_id) selected @endif >{{$dis->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="thana">Thana</label>
                        <select name="thana" id="thana"  class="js-select2 form-control" required>
                            <option value="">Choose Thana</option>
                            @foreach($thana as $tha)
                                <option value="{{$tha->id}}" @if($tha->id == $service->thana_id) selected @endif >{{$tha->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone" required value="{{$service->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address" required  value="{{$service->address}}">
                    </div>

                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount" required  value="{{$service->discount}}">
                    </div>

                    <div class="form-group">
                        <label for="logo">Organization Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                        <input type="hidden" name="current_logo" value="{{$service->logo}}">
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
