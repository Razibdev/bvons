@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
@endsection

@section('js_after')
    <script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
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
                        <i class="si si-plus"></i> New Purchase
                    </a>--}}
                    <small></small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Payment Method</th>
                            <th>Transaction Id</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_verification_pending_request as $pending_request)
                        <tr>
                            <th class="text-center" style="width: 80px;">{{ $loop->iteration }}</th>
                            <th>{{ $pending_request->user->name }}</th>
                            <th>{{ $pending_request->user->phone }}</th>
                            <th>{{ $pending_request->payment_method }}</th>
                            <th>{{ $pending_request->transaction_id }}</th>
                            <th class="text-center">

                                <div class="btn-group" role="group">
                                    <a class="btn btn-alt-info text-link" href="{{ route('user_verification.request.details', ["id" => $pending_request->id]) }}" target="_blank">
                                        <i class="fa fa-fw fa-info-circle mr-5"></i>View Details
                                    </a>
                                </div>

                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucfirst($pending_request->status) }}</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <form action="" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="dropdown-item text-success">
                                                <i class="fa fa-fw fa-check mr-5"></i>Success
                                            </button>
                                        </form>
                                        <form action="" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fa fa-fw fa-remove mr-5"></i>Rejected
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </th>
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
