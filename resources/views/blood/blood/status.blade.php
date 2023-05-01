@extends('layouts.front_layout.front_layout')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .blood h2{
            width: 25%; float: left;
        }

        @media screen and (max-width: 768px){

            .blood h2{
                width: 28%;
                float: none;
                padding: 5px 10px;
            }
            .blood .main-blood{
                width: 100%;
            }
            .blood .main-blood:last-child{
                margin-bottom: 10px;
            }

        }

    </style>
@endpush

@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

@endpush

@section('content')
    <!-- Page Content -->
    <div class="main-wrapper" style="margin: 15px;">
        <div class="content-header-fullrow">

            <div class="blood">
                <div class="main-blood">
                <h2 style="width: 25%; float: left;" class="font-w700 text-black mb-10"><a href="{{route('bvon.blood.user.status')}}">Blood Status</a></h2>
                <h2 style="width: 25%; float: left;"><a href="{{route('bvon.blood.user.status.needed')}}">Needed Blood</a></h2>
                <h2 style="width: 25%; float: left;"><a href="{{route('bvon.blood.user.status.giving')}}">Giving Blood</a></h2>
                <h2 style="width: 25%; float: left;"><a href="{{route('bvon.blood.user.status.already')}}">Already Blood</a></h2>
                </div>
                <br>
            </div>

            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-8 col-lg-8">
                    <div class="border">
                        <div class="block-content block-content-full">
                            <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">

                                <thead style=" margin-top: 10px;">
                                    @foreach($bloods as $blood)
                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th>Blood Group &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;</th>
                                            <td>{{$blood->blood_group}}</td>
                                        </tr>
                                        <tr style="height: 30px; width: 800px; float: left;">
                                            <th>Patient's Name &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;</th>
                                            <td>{{$blood->patient_name}}</td>
                                        </tr>
                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th>Address  &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                            <td>{{$blood->address}}</td>
                                        </tr>

                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th>Time &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</th>
                                            <td>{{$blood->blood_time}}</td>
                                        </tr>

                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th>Date &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; </th>
                                            <td>{{$blood->blood_date}}</td>
                                        </tr>



                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th style="text-align:left;">Blood Bag &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</th>
                                            <td style="right: 10px;">{{$blood->blood_bag}}</td>
                                        </tr>

                                        <tr style="height: 20px; width: 800px; float: left;">
                                            <th>Cause &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</th>
                                            <td>{{$blood->cause}}</td>
                                        </tr>

                                        <tr style="height: 40px; width: 800px; float: left;">
                                            <th>Contact Person-1 &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</th>
                                            <td>{{$blood->name1}}<br> {{$blood->contact1}} <a href="tel:{{$blood->contact1}}">Call</a></td>
                                        </tr>

                                        <tr style="height: 40px; width: 800px; float: left;">
                                            <th>Contact Person-2 &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</th>
                                            <td>{{$blood->name2}}<br> {{$blood->contact2}} <a href="tel:{{$blood->contact2}}">Call</a></td>
                                        </tr>

                                        <tr style="height: 40px; width: 800px; float: left;">
                                            <th>Contact Person-3 &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;</th>
                                            <td>{{$blood->name3}}<br>{{$blood->contact3}} <a href="tel:{{$blood->contact3}}">Call</a></td>
                                        </tr>


                                        <tr>
                                            <th>
                                                <hr style="margin: 20px; width: 600px; float: left; right: 300px; visibility: collapse;">
                                            </th>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <th></th>
                                            <td></td>
                                        </tr>
                                     @endforeach

                                </thead>
                            </table>
                            <br><br>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
