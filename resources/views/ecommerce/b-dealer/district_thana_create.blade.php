@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

@endsection

@section('content')

<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">B-Dealer Create District/Thana</h2>
    <div class="row">

        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Create Zone</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('b-dealer.distrinct_thana.store', ['req' => 'zone'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="zone_name">Zone Name</label>
                            <input required type="text" name="zone_name" id="zone_name" class="form-control" placeholder="Zone Name" aria-describedby="zone_name_error">
                            <small id="zone_name_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">Create Zone</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Create District</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('b-dealer.distrinct_thana.store', ['req' => 'district'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="zone_name_select">Select Zone</label>
                            <select name="zone_name_select" id="zone_name_select" class="js-select2 form-control" required>
                                <option value="">Please Select One</option>
                                @foreach($zone_list as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                            <small id="zone_name_error" class="text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="district_name">District Name</label>
                            <input required type="text" name="district_name" id="district_name" class="form-control" placeholder="District Name" aria-describedby="district_name_error">
                            <small id="district_name_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">Create District</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Create Thana</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('b-dealer.distrinct_thana.store', ['req' => 'thana'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="district_name_select">Select District</label>
                            <select name="district_name_select" id="district_name_select" class="js-select2 form-control" required>
                                <option value="">Please Select One</option>
                                @foreach($district_list as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            <small id="district_name_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="thana_name">Thana Name</label>
                            <input required type="text" name="thana_name" id="thana_name" class="form-control" placeholder="Thana Name" aria-describedby="thana_name_error">
                            <small id="thana_name_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">Thana Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Create Village/Union</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{route('b-dealer.distrinct_thana.store', ['req' => 'village'])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="thana_select">Select Thana</label>
                            <select name="thana_name_select" id="thana_name_select" class="js-select2 form-control" required>
                                <option value="">Please Select One</option>
                                @foreach($thana_list as $thana)
                                    <option value="{{ $thana->id }}">{{ $thana->name }}</option>
                                @endforeach
                            </select>
                            <small id="thana_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="village_name">Village Name</label>
                            <input required type="text" name="village_name" id="village_name" class="form-control" placeholder="Village Name" aria-describedby="village_name_error">
                            <small id="village_name_error" class="text-muted"></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">Village Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END Page Content -->
@endsection

