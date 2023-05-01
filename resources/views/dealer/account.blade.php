@extends('layouts.dealer')

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

    <script>
            $('#users-table').DataTable();
    </script>

@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Account No</th>
                        <th>Type</th>
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

