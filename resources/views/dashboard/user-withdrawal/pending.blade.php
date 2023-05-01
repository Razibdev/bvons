@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('title', 'Withdrawal pending request')

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
        <h2 class="content-heading">User Verification List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    All Request
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-light table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>User Balance</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_withdrawal as $all_request)
                        <tr>
                            <td class="text-center" style="width: 80px;">{{ $loop->iteration }}</td>
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

                            <td class="text-center">

                                <div class="btn-group" role="group">
                                    <a class="btn btn-alt-info text-link" href="{{ route('user_withdrawal.details', ["withdrawal" => $all_request->id]) }}" target="_blank">
                                        <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                                    </a>
                                </div>

                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucfirst($all_request->status) }}</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <form action="{{ route('user_withdrawal.accept', ["withdrawal" => $all_request->id]) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fa fa-check mr-5"></i>Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('user_withdrawal.reject', ["withdrawal" => $all_request->id]) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure want to do this?')">
                                                <i class="fa fa-remove mr-5"></i>Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
