@extends('ecommerce.eco_layout.main')

@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">


@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

<script src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('js/plugins/easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('js/plugins/chartjs/Chart.bundle.min.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.min.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.stack.min.js')}}"></script>
<script src="{{asset('js/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('js/plugins/flatpickr/flatpickr.min.js')}}"></script>


<script src="{{ asset('js/pages/be_comp_charts.js') }}"></script>



@endsection


@section('content')
<!-- Page Content -->
<div class="content">
    <div class="my-10 mb-20">
{{--        <h2 class="font-w700 text-black mb-10">{{ $greet }}, {{ auth()->user()->name }}</h2>--}}
        <h3 class="text-muted mb-50">{{ $greet }}, {{ auth()->user()->name }}</h3>
    </div>



    <div class="row mb-50">
        <div class="col-md-4">
            <div class="col-full-width">
                <div class="dashboard-top-with-icon">
                    <div class="left-icon left-icon-info">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="right-info">
                        <p class="m-0">
                            <span class="finished">1</span> / <span class="total">5</span> Pending
                        </p>
                        <h4 class="m-0">100.00%</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-full-width">
                <div class="dashboard-top-with-icon">
                    <div class="left-icon left-icon-success">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="right-info">
                        <p class="m-0">
                            <span class="finished">3</span> / <span class="total">5</span> Complete
                        </p>
                        <h4 class="m-0">100.00%</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-full-width">
                <div class="dashboard-top-with-icon">
                    <div class="left-icon left-icon-danger">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="right-info">
                        <p class="m-0">
                            <span class="finished">1</span> / <span class="total">5</span> Cancel
                        </p>
                        <h4 class="m-0">0%</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="chart-container" class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Order Report</h3>
                    <div class="block-options">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button id="monthly-report" type="button" class="input-group-text active" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    Monthly Report
                                </button>
                            </div>
                            <div class="input-group-prepend">
                                <button id="weekly-report" class="input-group-text" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    Weekly Report
                                </button>
                            </div>

                            <input type="text" class="js-flatpickr form-control bg-white d-inline-block" id="example-flatpickr-range" name="example-flatpickr-range" placeholder="Select Date Range" data-mode="range" autocomplete="off">

                        </div>

                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <!-- Lines Chart Container -->
                    <canvas class="js-chartjs-lines"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- END Page Content -->
@endsection
