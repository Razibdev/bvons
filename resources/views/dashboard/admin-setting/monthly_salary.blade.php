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
                <h3 class="block-title">Monthly Salary <small></small></h3>
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
                    <tr>

                        <td colspan="2">Percentage</td>
                        <td>0</td>
                        <td>{{$designation_fix_value[0]}}</td>
                        <td>{{$designation_fix_value[1]}}</td>
                        <td>{{$designation_fix_value[2]}}</td>
                        <td>{{$designation_fix_value[3]}}</td>
                        <td>{{$designation_fix_value[4]}}</td>
                        <td>{{$designation_fix_value[5]}}</td>
                        <td>{{$designation_fix_value[6]}}</td>
                        <td>{{$designation_fix_value[7]}}</td>
                    </tr>

                    @foreach($designation as $des)
                        <tr>
                            <td>{{$des->created_at->format('y-m-d')}}</td>
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
                     @endforeach

                    <tr>
                        @if($total)
                        <td colspan="2">Total</td>
                        <td>{{$total->MO}} </td>
                        <td>{{$total->SMO}}</td>
                        <td>{{$total->MEx}}</td>
                        <td>{{$total->SMEx}}</td>
                        <td>{{$total->RMM}}</td>
                        <td>{{$total->MM}}</td>
                        <td>{{$total->SMM}}</td>
                        <td>{{$total->AGM}}</td>
                        <td>{{$total->GM}}</td>
                        @endif
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        @if($user)
                        <td colspan="2">Total User</td>
                        <td>{{$user->MO}}</td>
                        <td>{{$user->SMO}}</td>
                        <td>{{$user->MEx}}</td>
                        <td>{{$user->SMEx}}</td>
                        <td>{{$user->RMM}}</td>
                        <td>{{$user->MM}}</td>
                        <td>{{$user->SMM}}</td>
                        <td>{{$user->AGM}}</td>
                        <td>{{$user->GM}}</td>
                            @endif
                    </tr>

                    <tr style="font-weight: bold;">
                        @if($salary)
                        <td colspan="2">Salary Per User</td>

                        <td>{{$salary->MO}}</td>
                        <td>{{$salary->SMO}}</td>
                        <td>{{$salary->MEx}}</td>
                        <td>{{$salary->SMEx}}</td>
                        <td>{{$salary->RMM}}</td>
                        <td>{{$salary->MM}}</td>
                        <td>{{$salary->SMM}}</td>
                        <td>{{$salary->AGM}}</td>
                        <td>{{$salary->GM}}</td>
                            @endif
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>




    <!-- END Page Content -->
@endsection
