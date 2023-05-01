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
        <h2 class="content-heading">User Withdrawal Details</h2>
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
                            <a href="#" style="background: url(data:image/png;base64,{{ $withdrawal->user->cover_pic }}) no-repeat center center; background-size: cover; height: 150px" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 align-items-end h-100">
                                    <img style="border-radius: 50%; width: 50px; height: 50px;" src="data:image/png;base64,{{ $withdrawal->user->profile_pic }}" alt="">
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>{{ $withdrawal->user->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>{{ $withdrawal->user->phone }}</th>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <th>{{ $withdrawal->user->type }}</th>
                                        </tr>
                                        <tr>
                                            <th>Verified</th>
                                            <th>{{ $withdrawal->user->verified === 0 ? "NO" : "Yes" }}</th>
                                        </tr>

                                        <tr>
                                            <th>Referred Id</th>
                                            <th>{{ $withdrawal->user->referral_id }}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan="2">
                                                <a class="btn btn-outline-dark" href="{{ route('bf.user.details', ['user' => $withdrawal->user->id]) }}">View Full Details</a>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </a>
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
                            <i class="si si-book-open"></i> Withdrawal Info
                        </h2>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $withdrawal->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ $withdrawal->amount }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $withdrawal->status }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </a>
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
                                        <?php
                                            $payment = $withdrawal->user->payment_method($withdrawal->payment_method_id)
                                        ?>
                                        <tr>
                                            <th>Payment Method</th>
                                            <td>{{ $payment->method }}</td>
                                        </tr>

                                        <tr>
                                            <th>Payment Details</th>
                                            <td>{{ $payment->details }}</td>
                                        </tr>
                                        <tr>
                                            <th>Initial Request</th>
                                            <td>{{ $withdrawal->created_at->format('d M, Y') }}</td>
                                        </tr>

                                        <tr>
                                            <th>Last Update</th>
                                            <td>{{ $withdrawal->updated_at->format('d M, Y') }}</td>
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


        <div class="float-buttons" style="right: 20px; bottom: 20px; position: fixed;">
            @if($withdrawal->status === "pending")
            <form class="" action="{{ route('user_withdrawal.accept', ["withdrawal" => $withdrawal->id]) }}" method="post">
                @csrf
                @method('patch')
                <button style="min-width: 150px;" type="submit" class="btn btn-rounded btn-outline-success mb-2">
                    <i class="fa fa-check mr-5"></i>Accept
                </button>
            </form>
            <form class="" action="{{ route('user_withdrawal.reject', ["withdrawal" => $withdrawal->id]) }}" method="post">
                @csrf
                @method('patch')
                <button style="min-width: 150px; " type="submit" class="btn btn-rounded btn-outline-danger" onclick="return confirm('Are you sure want to do this?')">
                    <i class="fa fa-remove mr-5"></i>Reject
                </button>
            </form>
            @elseif($withdrawal->status === "accepted")
                <form class="" action="{{ route('user_withdrawal.paid') }}" method="post">
                    @csrf
                    @method('patch')
                    <button style="min-width: 150px;" type="submit" class="btn btn-rounded btn-outline-success mb-2" name="paidList[]" value="{{$withdrawal->id}}">
                        <i class="fa fa-check mr-5"></i>Paid
                    </button>
                </form>

                <form class="" action="{{ route('user_withdrawal.refund') }}" method="post">
                    @csrf
                    @method('patch')
                    <button style="min-width: 150px;" type="submit" class="btn btn-rounded btn-outline-danger mb-2" name="id" value="{{$withdrawal->id}}">
                        <i class="fa fa-check mr-5"></i>Refund
                    </button>
                </form>
            @endif
        </div>





    </div>
    <!-- END Page Content -->
@endsection
