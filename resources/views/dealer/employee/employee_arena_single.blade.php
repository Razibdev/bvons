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
        <h2 class="content-heading">User List of {{$user->name}}</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User Referral by {{$user->name}}</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered" id="dealer-product-stock">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Phone</th>
                        <th>User A/C No</th>
                        <th>Total User</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                @if($user->type != 'GU')
                                    <a href="{{url('/dealer/account/employee-arena/'.$user->id)}}">{{$user->name}}</a>
                                @else
                                    {{$user->name}}
                                @endif
                            </td>
                            <td><img style="width: 100px; height: 100px; border-radius: 50%;" src="{{asset('/media/user/profile_pic/'.$user->id.'/'.$user->profile_pic)}}" alt=""></td>
                            <td><a href="tel:+88{{$user->phone}}">{{$user->phone}}</a></td>
                            <td>{{$user->referral_id}}</td>

                            @php
                                if($user->referral_id !=null || $user->referral_id != ''){
                                    $usertotalref = \App\User::where('referred_by', $user->referral_id)->count();
                                }else{
                                    $usertotalref = 0;
                                }

                            @endphp
                            <td>{{$usertotalref}}</td>
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

























