@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('/js/plugins/select2/css/select2.min.css')}}">
@endsection

@section('js_after')
    <script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/js/plugins/select2/js/select2.min.js')}}"></script>
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
                    <div class="block-header bg-gd-light block-header-default d-flex justify-content-between">
                        <h2 class="block-title">
                            <i class="si si-user"></i> User Details
                        </h2>
                        <h2 class="block-title text-right">
                            <a href="{{ route('cashback_wallet', ['user' => $user->id ]) }}" class="btn btn-alt-primary"><i class="si si-wallet"></i> User Cashback Wallet</a>
                        </h2>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <div style="background: url({{ env('USER_COVER_URL') . '/' . $user->id . '/' . $user->cover_pic }}) no-repeat center center; background-size: cover; height: 150px" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 align-items-end h-100">
                                    <img style="border-radius: 50%; width: 50px; height: 50px;" src="{{ env('USER_PROFILE_URL') . '/' . $user->id . '/' . $user->profile_pic }}" alt="">
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start" style="background: none">
                              <form action="{{route('update.user.information.ok')}}" method="post">{{csrf_field()}}
                                <div class="row">
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <td><input class="form-control" style="border: none;" type="text" name="name" value="{{$user->name}}"></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><input class="form-control" style="border: none;" type="text" name="phone" value="{{$user->phone}}"></td>
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
                                            <td>
                                                <input type="text" name="nick_name" style="border: none;" class="form-control" value="{{ $user->nick_name }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>

                                                <input type="radio" name="gender" @if($user->gender == 'Male') checked @endif value="Male">&nbsp; Male &nbsp;

                                                <input type="radio" @if($user->gender == 'Female') checked @endif name="gender" value="Female">&nbsp; Female &nbsp;

                                                <input type="radio" @if($user->gender == 'Other') checked @endif name="gender" value="Other">&nbsp; Other &nbsp;

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Birthday</th>
                                            <td>
                                                <input type="text" name="birthday" style="border: none;" class="form-control" value="{{ $user->birthday }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Job Details</th>
                                            <td>
                                                @if(is_array($user->has_job()))
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>Designation</td>
                                                            <td>@if(isset($user->job->job_type->name)) {{ $user->job->job_type->name }} @endif</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Area Type</td>
                                                            <td>{{ collect(explode('\\', $user->job->area_type))->last() }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Area Name</td>
                                                            <td>{{ $user->job->areaable->name ?? null }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created At</td>
                                                            <td>{{ $user->job->created_at->format('d/m/y h:i a') }}</td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6 table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Hometown</th>
                                        <td>
                                            <input type="text" name="hometown" style="border: none;" class="form-control" value="{{ $user->hometown }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Live In</th>
                                        <td>
                                            <input type="text" name="lives_in" style="border: none;" class="form-control" value="{{ $user->lives_in }}">

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Religion</th>
                                        <td>
                                            <input type="text" name="religion" style="border: none;" class="form-control" value="{{ $user->religion }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Occupation</th>
                                        <td>
                                            <input type="text" name="occupation" style="border: none;" class="form-control" value="{{ $user->occupation }}">

                                        </td>
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
                                        <th>Account No</th>
                                        <td>{{ $user->referral_id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cashback Balance </th>
                                        <td>{{ $user->cashbackBlance() }}</td>
                                    </tr>
                                </table>
                            </div>
                                    <button class="btn btn-primary" type="submit">Update User Information</button>

                                    </form>
                                <br>
                                    <div class="col-md-12">
                                        <form action="{{route('bf.user.change_password', ["user" => $user->id])}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <table class="table table-bordered">
                                                <tr class="bg-light">
                                                    <th colspan="3">Change Password</th>
                                                </tr>
                                                <tr style="vertical-align: bottom">
                                                    <td style="vertical-align: bottom">
                                                        <label for="">New Password</label>
                                                        <input type="text" name="password" id="" class="form-control" placeholder="New Password">

                                                    </td>
                                                    <td style="vertical-align: bottom">
                                                        <label for="">Confirm Password</label>
                                                        <input type="text" name="password_confirmation" id="" class="form-control" placeholder="Confirm Password">
                                                    </td>
                                                    <td style="vertical-align: bottom">
                                                        <button type="submit" class="btn btn-alt-success btn-block">Change Password</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>


                                    <div class="col-md-12">
                                        <form action="{{url('dashboard/bf/user/add-balance')}}" method="post" >{{csrf_field()}}
                                            <table class="table table-bordered">
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <tr class="bg-light">
                                                    <th colspan="3">Balance Control</th>
                                                </tr>
                                                <tr style="vertical-align: bottom">
                                                    <td style="vertical-align: bottom">
                                                        <label for="">Add or Sub Balace</label>
                                                        <input type="number" name="balance" id="" class="form-control" placeholder="Enter Balance"><br><br>
                                                        <input type="checkbox" name="balance_add" id="" value="1"> Add Balance

                                                    </td>
                                                    <td style="vertical-align: bottom">
                                                        <label for="">Message</label>
                                                        <textarea name="message" id="message" cols="30" rows="4" class="form-control"></textarea>
                                                    </td>
                                                    <td style="vertical-align: bottom">

                                                        <button type="submit" class="btn btn-alt-success btn-block">Submit</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>

                                    @if($user->referred_by != null)
                                    <div class="col-md-12">
                                        <form action="{{route('bf.user.change_referred_by', ["user" => $user->id])}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <table class="table table-bordered">
                                                <tr class="bg-light">
                                                    <th colspan="3">Change Referred BY</th>
                                                </tr>
                                                <tr style="vertical-align: bottom">
                                                    <td style="vertical-align: bottom">
                                                        <label for="">Select User</label>
                                                        <select name="referred_by" id="" class="form-control js-select2">
                                                            <option value="">Please Select One</option>
                                                            @foreach( \App\User::where('id', '!=', $user->id)->whereNotNull('referral_id')->get() as $ref_users )
                                                                <option value="{{$ref_users->referral_id}}">{{$ref_users->name}} - {{$ref_users->referral_id}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: bottom">
                                                        <button type="submit" class="btn btn-alt-success btn-block">Change Referred By</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    @endif


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END USER DETAILS -->


       {{--@if($user->check_user_is_verified())--}}

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
                                                    <th>Date</th>
                                                    <th>Transaction Type</th>
                                                    <th>Message</th>
                                                    <th>Amount</th>
                                                </tr>
                                                @if($user->transactions->count())
                                                    @php
                                                        $user_transactions = $user->transactions()->latest()->paginate(20);
                                                    @endphp
                                                    @foreach($user_transactions as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->created_at->format('d/m/y h:i a') }}</td>
                                                        <td>{{ ucfirst(str_replace('_', ' ', $transaction->category)) }}</td>
                                                        <td>{{ $transaction->message }}</td>
                                                        <th style="color: {{ $transaction->amount_type == 'c' ? 'lightgreen' : 'red' }}">{{ $transaction->amount }}</th>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="ml-auto mr-auto">
                                                        <td colspan="4">{{ $user_transactions->links() }}</td>
                                                    </tr>
                                                    <tr style="border-top: 2px solid #222;">
                                                        <th colspan="3" style="text-align: right">Total Balance</th>
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

       {{--@endif--}}
    </div>
    <!-- END Page Content -->
@endsection
