@extends('layouts.backend')

@section('css_before')
@endsection

@section('css_after')
    <style>
        *[contenteditable]:focus {
            color: deepskyblue;
            font-size: 16px;
        }
    </style>
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
        <h2 class="content-heading">Transaction Report</h2>
        <!-- block 1 -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Total Income List</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>date</th>
                            <th>category</th>
                            <th>amount_type</th>
                            <th>details</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_report["creditList"] as $credit)
                            <tr class="animated slideInDown">
                                <td>{{ $credit->id }}</td>
                                <td>{{ $credit->created_at->format('d M, Y') }}</td>
                                <td>{{ $credit->category }}</td>
                                <td>{{ $credit->amount_type }}</td>
                                <td>{{ $credit->message }}</td>
                                <td>{{ $credit->amount }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="5" style="text-align: right">Total User Income: </th>
                            <td>{{ $transaction_report["totalIncome"] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                {{ $transaction_report["creditList"]->links() }}
            </div>
        </div>
        <!-- block 1 -->

        <!-- block 2 -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Total Paid List</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>date</th>
                            <th>category</th>
                            <th>amount_type</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_report["debitList"] as $debit)
                            <tr class="animated slideInDown">
                                <td>{{ $debit->created_at->format('d M, Y') }}</td>
                                <td>{{ $debit->category }}</td>
                                <td>{{ $debit->amount_type }}</td>
                                <td>{{ $debit->amount }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="3" style="text-align: right">Total Paid: </th>
                            <td>{{ $transaction_report["totalPaid"] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- block 2 -->
    </div>
    <!-- END Page Content -->



    {{--                        <tr>--}}
    {{--                            <td>1</td>--}}
    {{--                            <td>{{ $transaction_report["totalIncome"] }}</td>--}}
    {{--                            <td>{{ $transaction_report["totalPaid"] }}</td>--}}
    {{--                            <td>{{ $transaction_report["totalDue"] }}</td>--}}
    {{--                        </tr>--}}
@endsection
