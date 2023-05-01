@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#all-request-datatables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('user_verification.bp_request_pending.datatables') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'users.name' },
                    { data: 'phone', name: 'users.phone' },
                    { data: 'payment_info', name: 'payment_info' },
                    { data: 'payment_method', name: 'user_verifications.payment_method' },
                    { data: 'transaction_id', name: 'user_verifications.transaction_id' },
                    { data: 'payment_details', name: 'user_verifications.payment_details' },
                    { data: 'status', name: 'user_verifications.status'},
                    { data: 'rejected', name: 'user_verifications.rejected'},
                    { data: 'created_at', name: 'user_verifications.created_at'},
                    { data: 'action', name: 'action'}
                ],
                columnDefs: [
                    { targets: 4,searchable: true, visible: false },
                    { targets: 5,searchable: true, visible: false },
                    { targets: 6,searchable: true, visible: false },
                ],
                order: [[0, 'desc']]
            });
        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User Verification</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{--<a href="" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> Total Verified Today
                    </a>--}}
                    Total Verified Today <small>{{ $total_verified_today }}</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table id="all-request-datatables" class="table table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Payment Info</th>
                            <th style="display: none">Payment Method</th>
                            <th style="display: none">Transaction ID</th>
                            <th style="display: none">Payment Details</th>
                            <th>Status</th>
                            <th>Rejected</th>
                            <th>Request Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
