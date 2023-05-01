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
        <h2 class="content-heading">User Full Details</h2>
        <!-- START USER DETAILS -->
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header bg-gd-light block-header-default">
                        <h2 class="block-title">
                            <i class="si si-user"></i> User Details
                        </h2>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <div style="background: url(data:image/png;base64,{{ $user->cover_pic }}) no-repeat center center; background-size: cover; height: 150px" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 align-items-end h-100">
                                    <img style="border-radius: 50%; width: 50px; height: 50px;" src="data:image/png;base64,{{ $user->profile_pic }}" alt="">
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start" style="background: none">
                                <div class="row">
                                    <div class="col-md-6  table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $user->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>
                                                    @if($user->check_user_is_verified())
                                                        {{ $user->verification_details[0]->email }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Nick Name</th>
                                                <td>{{ $user->nick_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $user->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthday</th>
                                                <td>{{ $user->birthday }}</td>
                                            </tr>
                                            <tr>
                                                <th>Type</th>
                                                <td>{{ $user->type }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6 table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Hometown</th>
                                                <td>{{ $user->hometown }}</td>
                                            </tr>
                                            <tr>
                                                <th>Live In</th>
                                                <td>{{ $user->lives_in }}</td>
                                            </tr>
                                            <tr>
                                                <th>Religion</th>
                                                <td>{{ $user->religion }}</td>
                                            </tr>
                                            <tr>
                                                <th>Occupation</th>
                                                <td>{{ $user->occupation }}</td>
                                            </tr>


                                            <tr>
                                                <th>Verified</th>
                                                <td>{{ $user->verified === 0 ? "NO" : "Yes" }}</td>
                                            </tr>
                                            <tr>
                                                <th>Referred By</th>
                                                <td>
                                                    @if($user->referred_user())
                                                    <a href="{{ route('bf.user.details', ['user' => $user->referred_user()->id]) }}">{{ $user->referred_user()->name }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Referred Id</th>
                                                <td>{{ $user->referral_id }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END USER DETAILS -->


       @if($user->check_user_is_verified())

            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-header bg-gd-light block-header-default">
                            <h2 class="block-title">
                                <i class="fa fa-money"></i> Account
                            </h2>
                        </div>
                        <div class="block-content block-content-full">
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action flex-column align-items-start" style="background: none">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">

                                                <tr class="bg-gd-light">
                                                    <th>Transaction</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                </tr>
                                                @if($user->transactions->count())
                                                    @foreach($user->transactions()->latest()->get() as $transaction)
                                                    <tr>
                                                        <td>{{ ucfirst(str_replace('_', ' ', $transaction->category)) }}</td>
                                                        <td>{{ $transaction->created_at->toDateString() }}</td>
                                                        <th style="color: {{ $transaction->amount_type == 'c' ? 'lightgreen' : 'red' }}">{{ $transaction->amount }}</th>
                                                    </tr>
                                                    @endforeach
                                                    <tr style="border-top: 2px solid #222;">
                                                        <th colspan="2" style="text-align: right">Total Balance</th>
                                                        <th>{{ $user->balance() }}</th>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="text-center" colspan="3">No Data Found</td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

       @endif
    </div>
    <!-- END Page Content -->
@endsection
