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

    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Monthly Salary History<small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Package</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">MO</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">SMO</th>
                        <th class="d-none d-sm-table-cell">MEx</th>
                        <th class="d-none d-sm-table-cell">SMEx</th>
                        <th class="d-none d-sm-table-cell">RMM</th>
                        <th class="d-none d-sm-table-cell">MM</th>
                        <th class="d-none d-sm-table-cell">SMM</th>
                        <th class="d-none d-sm-table-cell">AGM</th>
                        <th class="d-none d-sm-table-cell">GM</th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($salary as $key => $des)
                        {{--@foreach($as as $des)--}}
                        {{--@php echo($des->SMO); @endphp--}}
                            <tr>
                                <td>{{$des->created_at->format('M')}}</td>
                                <td>{{$des->package}}</td>
                                <td>{{$des->MO}}</td>
                                <td>{{$des->SMO}}</td>
                                <td>{{$des->MEx}}</td>
                                <td>{{$des->SMEx}}</td>
                                <td>{{$des->RMM}}</td>
                                <td>{{$des->MM}}</td>
                                <td>{{$des->SMM}}</td>
                                <td>{{$des->AGM}}</td>
                                <td>{{$des->GM}}</td>
                            </tr>
                        {{--@endforeach--}}
                    @endforeach


                    </tbody>

                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>




    <!-- END Page Content -->
@endsection
