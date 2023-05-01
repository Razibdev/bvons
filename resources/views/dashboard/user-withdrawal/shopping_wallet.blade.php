@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .add_merchant{
            float: right;
            padding: 10px;
            background-color: seagreen;
            border-radius: 10px;
            color: #fff;
        }

        p nav{
            margin-top: -52px;
            margin-left: 355px;
        }
        .pagination{
            margin-top: -50px;
            margin-left: 221px;
        }
    </style>

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
                <h3 class="block-title">Shopping Wallet <small></small></h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th >Image</th>
                        <th>Account</th>
                        <th >Name</th>
                        <th >Email</th>
                        <th >Phone</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td><img width="75" height="75" src="{{asset('media/user/profile_pic/'.$user->id.'/'.$user->profile_pic)}}" alt=""></td>
                            <td>{{$user->referral_id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td><a href="{{route('user_withdrawal.shopping.wallet.details',$user->id)}}">Details</a></td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
               <p> {{$users->links()}}</p>


            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>




    <!-- END Page Content -->
@endsection
