@extends('layouts.pagemain')


<?php
use App\Model\AttendExam;
use Carbon\Carbon;
use App\Model\CharityTransaction;
use Illuminate\Support\Facades\Auth;
use App\User;

?>

@section('css_before')
    <link rel="stylesheet" href="{{asset('js/plugins/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/simplemde/simplemde.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('css_after')
    <link rel="stylesheet" href="{{asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <style>
        .inputFileWithColor {
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 5px;
            position: relative;
            max-width: 250px;
            height: 250px;
            overflow: hidden;
        }
        .inputFileWithColor input[type="color"] {
            background: transparent;
            border: 0;
            width: 30px;
            height: 30px;
            padding: 0;
            box-sizing: border-box;
        }
        .inputFileWithColor img.img-preview {
            position: absolute;
            top: 0;
            height: 90%;
            left: 50%;
            transform: translateX(-50%);
        }
        .inputFileWithColor div.bottom-section {
            position: absolute;
            bottom: 0;
            background: #ddd;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: stretch;
            padding: 5px;
            box-sizing: border-box;
            left: 0;
            border-top: 2px solid #222;
        }
        .inputFileWithColor:first-child:before {
            content: 'thumbnail';
            position: absolute;
            top: 0;
            z-index: 999;
            padding: 5px;
            border: 1px solid #1d1b1b;
            color: #efecec;
            right: 10px;
            top: 8px;
            font-size: 10px;
            text-transform: uppercase;
            border-radius: 3px;
            background: rgba(0,0,0,.4);
            letter-spacing: 1.5px;
        }
        .tox-notifications-container, .tox-statusbar__branding {
            display: none !important;
        }
    </style>
@endsection



@section('js_after')

    <script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>
    <script src="{{ asset('js/ku-modules/input.js') }}"></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>

@endsection




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
                                @foreach($events  as $eve)
                                    @foreach($eve as $event)

                                    <tr style="height: 40px;">
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
                                            $charities = CharityTransaction::where('charity_id', $event->id)->get();

                                            foreach ($charities as $cuser) {
                                                $userd = User::where('id', $cuser->user_id)->first();
                                                echo $userd->name."<br>";
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $charities = CharityTransaction::where('charity_id',$event->id)->get();
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
                                        <td><a href="{{route('charity.sub.admin.transaction.history', $event->id)}}" >Transaction History</a></td>
                                    </tr>

                                    <?php $i++; ?>
                                        @endforeach
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


