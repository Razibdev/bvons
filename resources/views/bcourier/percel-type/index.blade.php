@extends('layouts.backend')
@section('ttile', 'All percel type')
@section('css_before')
@endsection

@section('css_after')

@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $('#makeAjaxDataTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('bco.percel_type.index.datatables') !!}',
            columns: [
                { data: 'rownum', name: 'rownum' },
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' },

            ]
        });
    </script>

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Delivery Boy List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered" id="makeAjaxDataTables">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>id</th>
                        <th>Name</th>
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
