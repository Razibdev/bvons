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
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Zone</th>
                            <th>District</th>
                            <th>Thana</th>
                            <th>Village</th>
                            <th>Status</th>
                            <th>Active Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($b_dealer_list as $b_dealer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $b_dealer->user->name }}</td>
                                <td>{{ $b_dealer->zone->name }}</td>
                                <td>{{ $b_dealer->district->name }}</td>
                                <td>{{ $b_dealer->thana->name }}</td>
                                <td>{{ $b_dealer->village->name }}</td>
                                <td>{{ $b_dealer->status }}</td>
                                <td>{{ $b_dealer->updated_at->format('d/m/y h:i a') }}</td>
                                <td>
                                    <a class="btn btn-alt-primary" href="{{route('b-dealer.request.show', ["id" => $b_dealer->id])}}">View Details</a>
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
