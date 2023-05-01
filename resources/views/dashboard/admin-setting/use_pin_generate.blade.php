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
                <h3 class="block-title">PinCode <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Pin Code</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Type</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Account</th>
                        <th class="d-none d-sm-table-cell">Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pincodes as $code)
                        <tr>
                            <td class="text-center">{{$code->id}}</td>
                            <td class="font-w600">
                                {{$code->pincode}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <em class="text-muted">{{$code->type}}</em>
                            </td>
                            <td>{{$code->name}}</td>
                            @php
                            $user = \App\User::where('referral_id', $code->account)->first();
                             $userc = \App\User::where('referral_id', $code->account)->count();


                            @endphp
                            <td>
                                @if($userc > 0)
                                <a href="{{ route('bf.user.details', ['user' => $user->id]) }}">{{$code->account}}</a>
                                @else
                                    <a href="#" title="User Not available" >{{$code->account}}</a>

                                @endif
                            </td>
                            <td>{{$code->updated_at->diffForHumans()}}</td>
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
