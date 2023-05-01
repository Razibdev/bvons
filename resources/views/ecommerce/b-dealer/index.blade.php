@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">District With Thana</h2>
        </div>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                {{--<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>District Name</th>
                            <th>District Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($zone_list as $zone)
                            <tr>
                                <td>{{$zone->name}}</td>
                                <td>
                                    <table class="table table-bordered">
                                        @foreach($zone->districts as $district)
                                            <tr>
                                                <td>{{ $district->name }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>--}}


                @foreach ($zone_list as $zone)
                    <div id="accordion{{$zone->id}}" role="tablist" aria-multiselectable="true">
                        <div class="block block-bordered block-rounded mb-2">
                            <div class="block-header" role="tab" id="{{$zone->name}}">
                                <a class="font-w600" data-toggle="collapse" data-parent="#accordion{{$zone->id}}" href="#{{'zone_' . $zone->id}}" aria-expanded="true" aria-controls="{{'zone_' . $zone->id}}">{{$zone->id . " - " .$zone->name}}</a>
                            </div>
                            <div id="{{'zone_' . $zone->id}}" class="collapse" role="tabpanel" aria-labelledby="{{$zone->name}}">
                                <div class="block-content">
                                    @foreach($zone->districts as $district)
                                        <div id="accordion{{$district->id}}" role="tablist" aria-multiselectable="true">
                                            <div class="block block-bordered block-rounded mb-2">
                                                <div class="block-header" role="tab" id="{{$district->name}}">
                                                    <a class="font-w600" data-toggle="collapse" data-parent="#accordion{{$district->id}}" href="#{{'district_' . $district->id}}" aria-expanded="true" aria-controls="{{'district_' . $district->id}}">{{$district->id . " - " .$district->name}}</a>
                                                </div>
                                                <div id="{{'district_' . $district->id}}" class="collapse" role="tabpanel" aria-labelledby="{{$district->name}}">
                                                    <div class="block-content">
                                                        @foreach($district->thanas as $thana)
                                                            <div id="accordion{{$thana->id}}" role="tablist" aria-multiselectable="true">
                                                                <div class="block block-bordered block-rounded mb-2">
                                                                    <div class="block-header" role="tab" id="{{$thana->name}}">
                                                                        <a class="font-w600" data-toggle="collapse" data-parent="#accordion{{$thana->id}}" href="#{{'thana_' . $thana->id}}" aria-expanded="true" aria-controls="{{'thana_' . $thana->id}}">{{$thana->id . " - " .$thana->name}}</a>
                                                                    </div>
                                                                    <div id="{{'thana_' . $thana->id}}" class="collapse" role="tabpanel" aria-labelledby="{{$thana->name}}">
                                                                        <div class="block-content">
                                                                            @foreach($thana->villages as $village)
                                                                                <div id="accordion{{$village->id}}" role="tablist" aria-multiselectable="true">
                                                                                    <div class="block block-bordered block-rounded mb-2">
                                                                                        <div class="block-header" role="tab" id="{{$village->name}}">
                                                                                            <a class="font-w600" data-toggle="collapse" data-parent="#accordion{{$village->id}}" href="#{{'village_' . $village->id}}" aria-expanded="true" aria-controls="{{'village_' . $village->id}}">{{$village->id . " - " .$village->name}}</a>
                                                                                        </div>
                                                                                        <div id="{{'village_' . $village->id}}" class="collapse" role="tabpanel" aria-labelledby="{{$village->name}}">
                                                                                            <div class="block-content">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach






            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
