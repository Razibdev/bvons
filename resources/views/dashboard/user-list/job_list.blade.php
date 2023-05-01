@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>


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

    <script>
        function clearForm() {
            document.getElementById('filterForm').reset();

            $("select.js-select2").select2('data', {}); // clear out values selected
            $("select.js-select2").select2({ allowClear: true }); // re-init to show default status
        }
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Job List</h2>

        <div class="block">
            <div class="block-content">
                <form action="" method="get" id="filterForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zone_id">Select Zone</label>
                                    <select name="zone_id" id="zone_id" required class="js-select2 form-control">
                                        <option value=""></option>
                                        @foreach($zones as $zone)
                                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district_id">Select District</label>
                                    <select name="district_id" id="district_id" class="js-select2 form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="thana_id">Select Thana</label>
                                    <select name="thana_id" id="thana_id" class="js-select2 form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="village_id">Select Village/Union</label>
                                    <select name="village_id" id="village_id" class="js-select2 form-control">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_job_type_id">Select Job Type</label>
                                    <select name="user_job_type_id" id="user_job_type_id" class="js-select2 form-control">
                                        <option value=""></option>
                                        @foreach($job_types as $job_type)
                                        <option value="{{$job_type->id}}">{{$job_type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-alt-primary">Search</button>
                        <button type="button" class="btn btn-block btn-alt-primary" onclick="clearForm()">Clear</button>

                </form>
            </div>
        </div>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>User Job List</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered table-light table-vcenter user-job-list">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Job</th>
                            <th>Area Type</th>
                            <th>Area</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($job_list as $job)

                            <tr>
                                <th>{{ $job->id }}</th>
                                <th>{{ $job->user->name }}</th>
                                <th>{{ $job->job_type->name }}</th>
                                <th>{{ collect(explode('\\', $job->area_type))->last() }}</th>
                                <th>{{ $job->areaable ? $job->areaable->name : null}}</th>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection
