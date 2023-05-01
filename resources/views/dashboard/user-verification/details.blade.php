@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        .list-group-item-action:hover, .list-group-item-action:focus {
            color: initial !important;
            background-color: initial !important;
        }
    </style>
@endsection

@section('js_after')
    <script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script>
        $('#referred_by').on('keyup', function () {
            $('input[name="referred_by"]').val($(this).val());
        });
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User Verification Details</h2>
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
                            <div style="background: url({{ env('USER_COVER_URL') . '/' . $user_verification->user->id . '/' . $user_verification->user->cover_pic }}) no-repeat center center; background-size: cover; height: 150px" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 align-items-end h-100">
                                    <img style="border-radius: 50%; width: 50px; height: 50px;" src="{{ env('USER_PROFILE_URL') . '/' . $user_verification->user->id . '/' . $user_verification->user->profile_pic }}" alt="">
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>{{ $user_verification->user->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>{{ $user_verification->user->phone }}</th>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <th>{{ $user_verification->user->type }}</th>
                                        </tr>
                                        <tr>
                                            <th>Verified</th>
                                            <th>{{ $user_verification->user->verified === 0 ? "NO" : "Yes" }}</th>
                                        </tr>

                                        <tr>
                                            <th>Referred By</th>
                                            <th>
                                                <input id="referred_by" type="text" name="" class="form-control" value="{{ $user_verification->user->referred_by }}">
                                            </th>
                                        </tr>

                                        <tr>
                                            <th>Referred Id</th>
                                            <th>{{ $user_verification->user->referral_id }}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan="2">
                                                <a class="btn btn-outline-dark" href="{{ route('bf.user.details', ['user' => $user_verification->user]) }}">View Full Details</a>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END USER DETAILS -->

        <div class="row">
            <!-- START EDUCATION INFO -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header bg-gd-light block-header-default">
                        <h2 class="block-title">
                            <i class="si si-book-open"></i> User Education Info
                        </h2>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="">
                                    @if($user_verification->user->verification_details && $user_verification->user->verification_details->count())

                                        <form action="{{ route('user_verification_deails.modify', ['user_verification_details' => $user_verification->user->verification_details[0]->id]) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Email</th>
                                                    <td><input type="text" name="email" class="form-control" value="{{ $user_verification->user->verification_details[0]->email }}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Education</th>
                                                    <td><input type="text" name="education" class="form-control" value="{{ $user_verification->user->verification_details[0]->education }}"></td>
                                                </tr>
                                                <tr>
                                                    <th>Group</th>
                                                    <td>
                                                        <?php
                                                            $groupList = ["Science", "Business Studies", "Humanities", "Others"];
                                                            $selectedGroup = $user_verification->user->verification_details[0]->group;
                                                        ?>
                                                        <select name="group" id="" class="form-control">
                                                            @foreach($groupList as $group)
                                                                <option value="{{$group}}" @if($selectedGroup === $group) selected @endif>{{$group}}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Board</th>
                                                    <td>
                                                        <?php
                                                            $boardList = ["Barisal", "Chittagong", "Comilla", "Dhaka", "Dinajpur", "Jessore", "Mymensingh", "Rajshahi", "Sylhet", "Madrasah", "Technical"];
                                                            $selectedBoard = $user_verification->user->verification_details[0]->board;
                                                        ?>
                                                            <select name="board" id="" class="form-control">
                                                                @foreach($boardList as $board)
                                                                    <option value="{{$board}}" @if($selectedBoard === $board) selected @endif>{{$board}}</option>
                                                                @endforeach
                                                            </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Year</th>
                                                    <td>
                                                        <?php
                                                            $yearRange = range(1971, 2021);
                                                            $selectedYear = $user_verification->user->verification_details[0]->year
                                                        ?>
                                                        <select name="year" id="" class="form-control">
                                                            @foreach($yearRange as $year)
                                                                <option value="{{$year}}" @if($selectedYear === $year) selected @endif>{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Roll Number</th>
                                                    <td>
                                                        <input type="text" class="form-control" name="roll" value="{{ $user_verification->user->verification_details[0]->roll }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Registration Number</th>
                                                    <td>
                                                        <input type="text" name="reg_num" value="{{ $user_verification->user->verification_details[0]->reg_num }}" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button type="submit" class="btn btn-alt-success float-right">Submit</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    @else
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>There is no verification details</td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END EDUCATION INFO -->

            <!-- START USER VERIFICATION INFO -->
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header bg-gd-light block-header-default">
                        <h2 class="block-title">
                            <i class="si si-credit-card"></i> User Payment Details
                        </h2>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $user_verification->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Method</th>
                                            <td>{{ $user_verification->payment_method }}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Id</th>
                                            <td>{{ $user_verification->transaction_id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Details</th>
                                            <td>{{ $user_verification->payment_details }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rejected</th>
                                            <td class="text-danger">{{ $user_verification->rejected }}</td>
                                        </tr>
                                        <tr>
                                            <th>Initial Request</th>
                                            <td>{{ $user_verification->created_at->format('d M, Y') }}</td>
                                        </tr>

                                        <tr>
                                            <th>Last Update</th>
                                            <td>{{ $user_verification->updated_at->format('d M, Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END USER VERIFICATION INFO -->
        </div>

        @if($user_verification->status === "pending")
        <div class="float-buttons" style="right: 20px; bottom: 20px; position: fixed;">
            <form class="" action="{{ route('user_verification.bp_request_accept', ["id" => $user_verification->id]) }}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="referred_by" value="{{ $user_verification->user->referred_by }}">
                <button style="min-width: 150px;" type="submit" class="btn btn-rounded btn-outline-success mb-2">
                    <i class="fa fa-check mr-5"></i>Accept
                </button>
            </form>
            <form class="" action="{{ route('user_verification.bp_request_reject', ["user_verification" => $user_verification->id]) }}" method="post">
                @csrf
                @method('patch')
                <button style="min-width: 150px; " type="submit" class="btn btn-rounded btn-outline-danger" onclick="return confirm('Are you sure want to do this?')">
                    <i class="fa fa-remove mr-5"></i>Reject
                </button>
            </form>
        </div>
        @endif
    </div>
    <!-- END Page Content -->
@endsection
