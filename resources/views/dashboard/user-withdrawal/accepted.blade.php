@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection


@section('js_after')
    <script>
        window.userWithdrawalPaidUrl = "{{ route('user_withdrawal.paid') }}";
        window.userWithdrawalRefundUrl = "{{ route('user_withdrawal.refund') }}";
    </script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/pages/user_withdrawal.js') }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Withdrawal Request</h2>
        <form id="paidListForm" action="{{ route('user_withdrawal.paid') }}" method="post" class="d-inline-block">
        <!-- Dynamic Table Full -->

        <div id="user-withdrawal-list" class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title d-flex justify-content-between">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    <div class="title-left">
                        Accepted List
                    </div>
                    <div class="title-right">
                        <a class="btn btn-alt-primary cu-popover" href="{{ route('user_withdrawal.export.accepted_list') }}" data-content="Download accepted list as Excel" data-placement="top">
                            <i class="fa fa-file-excel-o"></i>
                        </a>

                            @csrf
                            @method('patch')
                            <button form="paidListForm" type="submit" v-show="checked" class="btn btn-alt-success cu-popover" data-content="Paid Selected" data-placement="top" id="submitPaidListForm">
                                <i class="si si-check"></i>
                            </button>

                    </div>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-vcenter withdrawal-accepted-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th class="text-center" style="width: 80px;">ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Payment</th>
                            <th>Amount</th>
                            <th>User Balance</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_withdrawal as $all_request)
                        <tr>
                            <td class="text-center">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input @change="isChecked" class="custom-control-input withdrawal-checkbox" type="checkbox" name="paidList[]" id="{{ $all_request->id }}" value="{{ $all_request->id }}">
                                    <label class="custom-control-label" for="{{ $all_request->id }}"></label>
                                </div>
                            </td>
                            <td class="text-center" style="width: 80px;">{{ $loop->iteration }}</td>
                            <td>{{ $all_request->id }}</td>
                            <td>{{ $all_request->user->name }}</td>
                            <td>{{ $all_request->user->phone }}</td>
                            <?php
                                $payment_method = $all_request->user->payment_method($all_request->payment_method_id) ?? null;
                            ?>
                            <td>
                                @if($payment_method)
                                    <table class="table table-dark text-center">
                                        <tr>
                                            <th>Name</th>
                                            <th>{{ $payment_method->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>Method</th>
                                            <th>{{ $payment_method->method }}</th>
                                        </tr>
                                        <tr>
                                            <th>Details</th>
                                            <th>{{ $payment_method->details }}</th>
                                        </tr>
                                    </table>
                                @endif
                            </td>

                            <td>{{ $all_request->amount }}</td>
                            <td>{{ $all_request->user->balance() }}</td>
                            <td>{{ $all_request->status }}</td>

                            <td class="text-center vertical-align-middle">
                                <div class="btn-group" role="group">
                                    <a class="btn btn-alt-info text-link cu-popover" data-content="Show Details" data-placement="top" href="{{ route('user_withdrawal.details', ["withdrawal" => $all_request->id]) }}" target="_blank">
                                        <i class="fa fa-fw fa-info-circle mr-5"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-alt-success cu-popover paidList"
                                            data-content="Paid Withdrawal"
                                            data-placement="top"
                                            value="{{ $all_request->id }}">
                                            <i class="si si-check"></i>
                                    </button>

                                    <button type="button"
                                            class="btn btn-alt-danger cu-popover refundWithdrawal"
                                            data-content="Refund Withdrawal"
                                            data-placement="top"
                                            value="{{ $all_request->id }}">
                                        <i class="si si-action-undo"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </form>
    </div>




    <!-- END Page Content -->
@endsection
