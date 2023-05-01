@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        window.getDistrictUrl = "{{route('ajax.get_district')}}";
        window.getThanatUrl = "{{route('ajax.get_thana')}}";
        window.getVilalgeUrl = "{{route('ajax.get_village')}}";
    </script>
    <script src="{{asset('js/ku-global.js')}}"></script>

    <script>
        $('#zone_id').select2().on("change", async function(){
            let res = await getDistricts(getDistrictUrl, $(this).val());

            let output = `<option value=""></option>`;
            if(res.data.length) {
                for(let i = 0; i < res.data.length; i++) {
                    output += `<option value="${res.data[i].id}">${res.data[i].name}</option>`
                }
            }
            $('#district_id').html(output);
            $('#thana_id').html(`<option value=""></option>`);
            $('#village_id').html(`<option value=""></option>`);
        });

        $('#district_id').select2().on("change", async function(){
            let res = await getThanas(getThanatUrl, $(this).val());
            let output = `<option value=""></option>`;
            if(res.data.length) {
                for(let i = 0; i < res.data.length; i++) {
                    output += `<option value="${res.data[i].id}">${res.data[i].name}</option>`
                }
            }
            $('#thana_id').html(output);
            $('#village_id').html(`<option value=""></option>`);
        });

        $('#thana_id').select2().on("change", async function(){
            let res = await getVillages(getVilalgeUrl, $(this).val());
            let output = `<option value=""></option>`;
            if(res.data.length) {
                for(let i = 0; i < res.data.length; i++) {
                    output += `<option value="${res.data[i].id}">${res.data[i].name}</option>`
                }
            }
            $('#village_id').html(output);
        });
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Create New B-Dealer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Create New Request For B-Dealer</small>
                </h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{route('b-dealer.store', ["admin" => true])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Select User</label>
                        <select name="user_id" id="user_id" required class="js-select2 form-control" required>
                            <option value=""></option>
                            @foreach($premium_users as $premium_user)
                                <option value="{{$premium_user->id}}">{{$premium_user->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="user_id">Select Zone</label>
                        <select name="zone_id" id="zone_id" required class="js-select2 form-control" required>
                            <option value=""></option>
                            @foreach($zones as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Select District</label>
                        <select name="district_id" id="district_id" required class="js-select2 form-control" required>
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Select Thana</label>
                        <select name="thana_id" id="thana_id" required class="js-select2 form-control" required>
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Select Village/Union</label>
                        <select name="village_id" id="village_id" required class="js-select2 form-control" required>
                            <option value=""></option>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="user_id">B-Dealer Picture</label>
                        <input type="file" name="pic" id="" required>
                    </div>

                    <div class="form-group">
                        <label for="user_id">NID Picture front</label>
                        <input type="file" name="nid_pic_front" id="" required>
                    </div>

                    <div class="form-group">
                        <label for="user_id">NID Picture back</label>
                        <input type="file" name="nid_pic_back" id="" required>
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
