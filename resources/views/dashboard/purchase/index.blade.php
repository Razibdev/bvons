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
        <h2 class="content-heading">All Purchases</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">

                    <a href="{{route('purchase.create')}}" class="btn btn-alt-primary">
                        <i class="si si-plus"></i> New Purchase
                    </a>
                    <small></small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Purchase Id</th>
                        <th>Vendor Id</th>
                        <th>Warehouse Id</th>
                        <th>User Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="font-w600">
                                <a href="javascript:void(0)">{{ $purchase->id }}</a>
                            </td>
                            <td>{{ $purchase->vendor_id }}</td>
                            <td>{{ $purchase->warehouse_id }}</td>
                            <td>{{ $purchase->user_id }}</td>

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
