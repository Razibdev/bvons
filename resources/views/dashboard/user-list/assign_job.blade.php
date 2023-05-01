@extends('layouts.backend')

@section('css_before')
@endsection

@section('css_after')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <style>
        .job_type {
            padding: 20px;
            box-sizing: border-box;
            border: 1px solid #eee;
            border-radius: 2px;
        }
        .job_type {
            display: none;
        }

        span.select2.select2-container {
            width: 100% !important;
        }
    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script>
        $('#show_job_type').on('change', function () {
            let val = $(this).val();
            $('.job_type').css('display', 'none');
            $(`div[job_name='${val}']`).css('display', 'block');
            $(`div[job_name='${val}'] form select:not('select.business_developer_select, select#zone')`).html(new Option("01.Please Select One", "", true, true)).trigger('change');

        });

        async function loadUser(user_id, job_type=null, area=false) {
            let url = "{{route('jobed_user')}}";
            let urlWithQuery = `${url}?user_id=${user_id}&job_type=${job_type}&area=${area}`;
            return await axios.get(urlWithQuery);
        }

        $('.business_developer_select').on('select2:select', async function(){
            let formName = $(this).attr('formName');
            let user_id = $(this).val();
            let job_type = $(this).attr('job_type');
            let response = await loadUser(user_id, job_type);
            let option = [];

            let main_data = response.data.main_data
            for(let i = 0; i < main_data.length; i++) {
                option.push(new Option(main_data[i].text, main_data[i].id, true, true))
            }
            option.push(new Option("01.Please Select One", "", true, true));
            $(`#${formName} .marketing_manager_select`).html(option).trigger('change');
        });
        $('.marketing_manager_select').on('select2:select', async function(){
            console.log('wokring');
            let formName = $(this).attr('formName');
            let user_id = $(this).val();
            let job_type = $(this).attr('job_type');
            let area = $(this).attr('area') ? $(this).attr('area') : null;

            let response = await loadUser(user_id, job_type, area);
            let option = [];
            let main_data = response.data.main_data
            for(let i = 0; i < main_data.length; i++) {
                option.push(new Option(main_data[i].text, main_data[i].id, true, true))
            }
            option.push(new Option("01.Please Select One", "", true, true));
            $(`#${formName} .area_marketing_manager_select`).html(option).trigger('change');

            if(area) {
                let area_option = [];
                if(response.data.area && response.data.area.length) {
                    for(let i = 0; i < response.data.area.length; i++) {
                        area_option.push(new Option(response.data.area[i].name, response.data.area[i].id, true, true))
                    }
                    area_option.push(new Option("01.Please Select One", "", true, true));
                    $(`#${formName} .area_select`).html(area_option).trigger('change');

                } else {
                    $(`#${formName} .area_select`).html(area_option).trigger('change');
                }
            }
        });
        $('.area_marketing_manager_select').on('select2:select', async function(){

            let formName = $(this).attr('formName');
            let user_id = $(this).val();
            let job_type = $(this).attr('job_type');
            let area = $(this).attr('area') ? $(this).attr('area') : null;

            let response = await loadUser(user_id, job_type, area);
            let option = [];
            let main_data = response.data.main_data
            for(let i = 0; i < main_data.length; i++) {
                option.push(new Option(main_data[i].text, main_data[i].id, true, true))
            }
            option.push(new Option("01.Please Select One", "", true, true));
            $(`#${formName} .area_supervisor_select`).html(option).trigger('change');

            if(area) {
                let area_option = [];
                if(response.data.area && response.data.area.length) {
                    for(let i = 0; i < response.data.area.length; i++) {
                        area_option.push(new Option(response.data.area[i].name, response.data.area[i].id, true, true))
                    }
                    area_option.push(new Option("01.Please Select One", "", true, true));
                    $(`#${formName} .area_select`).html(area_option).trigger('change');

                } else {
                    $(`#${formName} .area_select`).html(area_option).trigger('change');
                }
            }
        });
        $('.area_supervisor_select').on('select2:select', async function(){

            let formName = $(this).attr('formName');
            let user_id = $(this).val();
            let job_type = $(this).attr('job_type');
            let area = $(this).attr('area') ? $(this).attr('area') : null;

            let response = await loadUser(user_id, job_type, area);
            let option = [];
            let main_data = response.data.main_data
            for(let i = 0; i < main_data.length; i++) {
                option.push(new Option(main_data[i].text, main_data[i].id, true, true))
            }
            option.push(new Option("01.Please Select One", "", true, true));
            console.log(formName);
            $(`#${formName} .area_brand_promoter_select`).html(option).trigger('change');

            if(area) {
                let area_option = [];
                if(response.data.area && response.data.area.length) {
                    for(let i = 0; i < response.data.area.length; i++) {
                        area_option.push(new Option(response.data.area[i].name, response.data.area[i].id, true, true))
                    }
                    area_option.push(new Option("01.Please Select One", "", true, true));
                    $(`#${formName} .area_select`).html(area_option).trigger('change');

                } else {
                    $(`#${formName} .area_select`).html(area_option).trigger('change');
                }
            }
        });

    </script>


    <script>
        jQuery('#area_marketing_manager_form').validate({
            ignore: [],
            rules: {
                'business_developer_select': {
                    required: true
                },
                'marketing_manager_select': {
                    required: true
                },
                'area_marketing_manager_select': {
                    required: true
                },
                'user_id': {
                    required: true
                },
                'area': {
                    required: true
                },
            },
        });
    </script>




@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Assign Job</h2>


        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Assign Job to User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Select Job Type</label>
                            <select name="" id="show_job_type" class="form-control">
                                <option value="">Select One</option>
                                @foreach($user_job_types as $job_type)
                                    <option value="{{ $job_type->name }}">{{ $job_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="job_type b_developer core-font" job_name="B-Developer">
                            <h4 class="text-gray">Assign Job: B-Developer</h4>
                            <?php
                                $job_type = \App\UserJobType::where('id', 1)->first();
                            ?>
                            <form method="post" action="{{ route('bf.user.assign_job_store', ["assign_job" => $job_type->name]) }}" class="job_type_form b_developer_form">
                                @method('post')
                                @csrf
                                <div class="form-group">
                                    <label for="">Select User <small>(B-Developer)</small></label>
                                    <select required class="js-select2 form-control business_developer_select" id="" name="user_id" style="width: 100%;" data-placeholder="Choose one..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="job_type" value="{{ $job_type->id }}" class="btn btn-alt-success">Assign Jobs</button>
                            </form>
                        </div>
                        <div class="job_type marketing_manager core-font" job_name="Divisional Manager">
                            <h4 class="text-gray">Assign Job: Divisional Manager</h4>
                            <?php
                                $job_type = \App\UserJobType::where('id',2)->first();
                            ?>
                            <form id="marketing_manager_form"
                                  action="{{ route('bf.user.assign_job_store', ["assign_job" => $job_type->name]) }}"
                                  method="post"
                                  class="job_type_form marketing_manager_form"
                            >
                                @method('post')
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Business Developer</label>
                                    <select required name="" class="js-select2 form-control business_developer_select" formName="marketing_manager_form" job_type="null">
                                        <option value=""></option>
                                        @foreach($business_developers as $business_developer)
                                            <option value="{{ $business_developer->id }}">{{$business_developer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select User <small>(Divisional Manager)</small></label>
                                    <select required name="user_id" id="" class="js-select2 form-control marketing_manager_select">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select Zone</label>
                                    <select required name="area" id="zone" class="js-select2 form-control">
                                        <option value=""></option>
                                        @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="job_type" value="{{ $job_type->id }}" class="btn btn-alt-success">Assign Jobs</button>
                            </form>
                        </div>

                        <div class="job_type area_marketing_manager core-font" job_name="District Manager">
                            <h4 class="text-gray">Assign Job: District Manager</h4>
                            <?php
                            $job_type = \App\UserJobType::where('id', 3)->first();
                            ?>
                            <form
                                id="area_marketing_manager_form"
                                action="{{ route('bf.user.assign_job_store', ["assign_job" => $job_type->name]) }}"
                                method="post"
                                class="job_type_form area_marketing_manager_form"
                            >
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Business Developer</label>
                                    <select required name="business_developer_select" id="" class="js-select2 form-control business_developer_select" formName="area_marketing_manager_form" job_type="Divisional Manager">
                                        <option value=""></option>
                                        @foreach($business_developers as $business_developer)
                                            <option value="{{ $business_developer->id }}">{{$business_developer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Select Divisional Manager</label>
                                        <select required name="marketing_manager_select" id="" class="js-select2 form-control marketing_manager_select" formName="area_marketing_manager_form" job_type="null" area="districts">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Select User <small>(District Manager)</small></label>
                                    <select required name="user_id" id="" class="js-select2 form-control area_marketing_manager_select" job_type="null">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select District</label>
                                    <select required name="area" id="" class="js-select2 form-control area_select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <button type="submit" name="job_type" value="{{ $job_type->id }}" class="btn btn-alt-success">Assign Jobs</button>
                            </form>
                        </div>
                        <div class="job_type area_supervisor core-font" job_name="Area Manager">
                            <h4 class="text-gray">Assign Job: Area Manager</h4>
                            <?php
                            $job_type = \App\UserJobType::where('id', 4)->first();
                            ?>
                            <form
                                  id="area_supervisor_form"
                                  action="{{ route('bf.user.assign_job_store', ["assign_job" => $job_type->name]) }}"
                                  method="post"
                                  class="job_type_form area_supervisor_form"
                            >
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Business Developer</label>
                                    <select required name="business_developer_select" id="" class="js-select2 form-control business_developer_select" formName="area_supervisor_form" job_type="Divisional Manager">
                                        <option value=""></option>
                                        @foreach($business_developers as $business_developer)
                                            <option value="{{ $business_developer->id }}">{{$business_developer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Select Divisional Manager</label>
                                        <select required name="marketing_manager_select" class="js-select2 form-control marketing_manager_select" formName="area_supervisor_form" job_type="District Manager">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Select District Manager</label>
                                    <select required name="area_marketing_manager_select" class="js-select2 form-control area_marketing_manager_select" formName="area_supervisor_form" job_type="null" area="thana">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select User <small>(Area Manager)</small></label>
                                    <select required name="user_id" id="" class="js-select2 form-control area_supervisor_select" job_type="null">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Select Thana</label>
                                    <select required name="area" id="" class="js-select2 form-control area_select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <button type="submit" name="job_type" value="{{ $job_type->id }}" class="btn btn-alt-success">Assign Jobs</button>
                            </form>
                        </div>
                        <div class="job_type business_promoter core-font" job_name="Brand Promoter">
                            <h4 class="text-gray">Assign Job: Brand Promoter</h4>
                            <?php
                            $job_type = \App\UserJobType::where('id', 5)->first();
                            ?>
                            <form
                                id="brand_promoter_form"
                                action="{{ route('bf.user.assign_job_store', ["assign_job" => $job_type->name]) }}"
                                method="post"
                                class="job_type_form brand_promoter_form"
                            >
                                @csrf
                                <div class="form-group">
                                    <label for="">Select Business Developer</label>
                                    <select required name="business_developer_select" id="" class="js-select2 form-control business_developer_select" formName="brand_promoter_form" job_type="Divisional Manager">
                                        <option value=""></option>
                                        @foreach($business_developers as $business_developer)
                                            <option value="{{ $business_developer->id }}">{{$business_developer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">Select Divisional Manager</label>
                                        <select required name="marketing_manager_select" class="js-select2 form-control marketing_manager_select" formName="brand_promoter_form" job_type="District Manager">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Select District Manager</label>
                                    <select required name="area_marketing_manager_select" class="js-select2 form-control area_marketing_manager_select" formName="brand_promoter_form" job_type="Area Manager">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select Area Manager</label>
                                    <select required name="area_supervisor_select" id="" class="js-select2 form-control area_supervisor_select" formName="brand_promoter_form" job_type="null" area="village">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Select User <small>(Brand Promoter)</small></label>
                                    <select required name="user_id" id="" class="js-select2 form-control area_brand_promoter_select" job_type="null">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Select Village</label>
                                    <select required name="area" id="" class="js-select2 form-control area_select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <button type="submit" name="job_type" value="{{ $job_type->id }}" class="btn btn-alt-success">Assign Jobs</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection
