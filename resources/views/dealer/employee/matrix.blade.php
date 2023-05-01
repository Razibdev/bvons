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
        $(function() {
            $('#dealer-product-stock').DataTable();
        });


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
                <table class="datatable table table-stripped mb-0">
                    <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Account</th>
                        <th>Name</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($matrices as $matrix)
                        <tr>
                            <td>{{$i}}</td>
                            <td><a href="{{url('/dealer/account/team-arena?users='.$matrix->user->referral_id)}}">{{$matrix->user->referral_id}}</a></td>
                            <td>{{$matrix->user->name}}</td>
                            <td>{{$matrix->user->phone}}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                    </tbody>
                </table>



            </div>
        </div>
        <!-- END Dynamic Table Full -->

    </div>
    <!-- END Page Content -->
@endsection

























