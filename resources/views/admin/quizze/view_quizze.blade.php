@extends('ecommerce.eco_layout.main')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product-stock-active').DataTable();
        });


    </script>


@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">View All Quizze User</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Phone</th>
                                <th>Account</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->referral_id}}</td>
                                   <td><a href="{{route('quizze.edit.user', $user->id)}}">Edit</a>&nbsp</td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
