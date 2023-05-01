@extends('layouts.front_layout.front_layout')
<?php
use App\Model\AttendExam;
use Carbon\Carbon;
use App\Model\CharityTransaction;
use Illuminate\Support\Facades\Auth;
use App\User;

?>
@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .charity{
            background: transparent;
            width: 100%;
            height: auto;
            background: darkgoldenrod;
        }

        .charity .charity-wrapper{
            position:absolute;
            top: 50%;
            right: 0%;
            transform: translate(-50%, -50%);

        }

        .charity .charity-wrapper{
            display: none;
            background: #fff;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
        }
        .charity .charity-wrapper .form-group {
              width: 100%;
          }

        .charity .charity-wrapper .form-group input{
            width: 100%;
            height: 40px;
            margin: 10px 0px;
        }

        .charity .charity-wrapper .form-group button{
            width: 150px;
            height: 40px;
            border: none;
            cursor: pointer;

        }

    </style>
@endpush

@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product-stock-active').DataTable();
        });

        $('.payment_send_charity').on('click', function () {
            var id = $(this).data("id");
            $('.charity-wrapper').css('display', 'none');
            $('#charity'+id).toggle();
        });

        function closePayment() {
            $('.charity-wrapper').css('display', 'none');
        }



        function myFunctions(id) {
            var x = document.getElementById("password"+id);
            if (x.type === "password") {
                x.type = "text";
                $('#cpayment').addClass("fa-eye-slash");
                $('#cpayment').removeClass("fa-eye");

            } else {
                x.type = "password";
                $('#cpayment').removeClass("fa-eye-slash");
                $('#cpayment').addClass("fa-eye");
                
            }
        }




    </script>


@endpush

@section('content')
    <!-- Page Content -->
    <div class="main-wrapper">
        <div class="container-fluid">

            <div class="mt-5">
                <br><br>
                <h2 class="font-w700 text-black mb-10">Charity</h2>
                <br>
            </div>

            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-12 col-lg-12">
                    <div class="border">
                        <div class="block-content block-content-full">
                            <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                                <thead  style="height: 50px;">
                                <tr >
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Amount</th>
                                    <th>Donor Name</th>
                                    <th>A/C</th>
                                    <th>Donor N</th>
                                    <th>Total</th>
                                    <th>Opening Date</th>
                                    <th>Closing Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody style="width: 100% !important; text-align: center">
                                <?php $i = 1; ?>
                                @foreach($events as $event)

                                        <tr style="height: 80px;">
                                            <td>{{$i}}</td>
                                            <td>{{$event->event_name}}</td>
                                            <td>{{$event->address}}</td>
                                            <td>
                                                <?php
                                                    $contact = $event->contact;
                                                    $c = explode(",", $contact);
                                                    for ($i=0; $i < count($c); $i++){
                                                        echo $c[$i]."<br>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $charities = CharityTransaction::where('charity_id', $event->id)->get();
                                                    foreach ($charities as $char){
                                                        if($char->user_id == Auth::id()){
                                                            echo $char->amount."<br>";
                                                        }
                                                    }

                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $charities = CharityTransaction::where('charity_id',$event->id)->get();
                                                    $users = User::where('id', $event->user_id)->get();
                                                    foreach ($charities as $cuser) {
                                                        $userd = User::where('id', $cuser->user_id)->first();
                                                        echo $userd->name."<br>";
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                $charities = CharityTransaction::where('charity_id',$event->id)->get();
                                                $users = User::where('id', $event->user_id)->get();
                                                foreach ($charities as $cuser) {
                                                    $userd = User::where('id', $cuser->user_id)->first();
                                                    echo $userd->referral_id."<br>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $charc = CharityTransaction::where('charity_id',$event->id)->count();
                                                echo $charc;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $charamount = CharityTransaction::where('charity_id',$event->id)->pluck('amount')->sum();
                                                echo $charamount;
                                                ?>
                                            </td>
                                            <td>{{$event->open_date}}</td>
                                            <td>{{$event->closing_date}}</td>
                                            <td><a href="#" class="payment_send_charity" data-id="{{$event->id}}">Pay Now</a></td>
                                        </tr>

                                    <?php $i++; ?>


                                        <div class="charity">
                                            <div class="charity-wrapper" id="charity{{$event->id}}">
                                                <h3>Charity Fund </h3> <i onclick="closePayment();" style="float: right; top: -20px; cursor: pointer;" class="fas fa-times"></i><br>
                                                <form action="{{route('charity.user.event.payment')}}" method="post">{{csrf_field()}}
                                                    <input type="hidden" name="event_id" value="{{$event->id}}">
                                                    <div class="form-group">
                                                        <input type="text" name="amount" id="amount{{$event->id}}" placeholder="Enter Amount Here"><br>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" id="password{{$event->id}}" placeholder="Enter Password ">
                                                        <i onclick="myFunctions({{$event->id}});" id="cpayment" style="top: 152px; position: absolute; right: 37px;" class="fa fa-eye"></i>
                                                        <br>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                @endforeach
                                </tbody>
                            </table>
                            <br><br>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
