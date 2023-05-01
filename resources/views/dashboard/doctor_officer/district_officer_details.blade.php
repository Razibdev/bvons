@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('css_after')

@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        $(document).ready(function () {
            $.ajax({
                url:"{{url('dashboard/bvon-doctor/district-doctor-officer/fetch')}}",
                method:"get",
                success:function(result)
                {
                    $('#userdetails').html(result);
                }
            })
        })
    </script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Get District Doctor Officer</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Upazilla officer list</small>
                </h3>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th >Account</th>
                        <th>phone</th>
                        <th>All Register</th>
                        <th>Current Register</th>
                        <th>Percentage</th>
                        <th>Salary</th>
                        <th>Sign Up</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(thanaofficers as $thana)
                            <tr>
                                <td><img style="width: 100px; height: 100px;" src="{{ asset('media/user/profile_pic/'.$thana->user->id.'/'.$thana->user->profile_pic)}}" alt=""></td>
                                <td>{{$thana->user->name}}</td>
                                <td>{{$thana->user->referral_id}}</td>
                                <td>{{$thana->user->phone}}</td>
                                <td>
                                    @php
                                     $totalRegister = BvonDoctorRegisterHistory::where('upazilla_officer_id', $thana->id)->count();
                                     echo $totalRegister;
                                    @endphp
                                </td>
                                <td> @php
                                      $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('upazilla_officer_id', $thana->id)->whereMonth('created_at', Carbon::now()->month)->count();
                                     echo $totalRegistercurrentMonth;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    
                                     $totalRegistercurrentMonthAmount = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
                                        $percentage= 0;
                                        if($totalRegistercurrentMonth > 0){
                                            $percentage = ($totalRegistercurrentMonthAmount / 30000)*100;
                                            $percentage =  number_format((float)$percentage, 2, '.', ',');
                                            echo percentage;
                                        }
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$thana->id.'/'.$thana->type)}}">Sign Up</a>
                                </td>
                                <td>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type)}}">Work History</a> <br>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type)}}">View Details</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>





            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>Field officer list</small>
                </h3>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th >Account</th>
                        <th>phone</th>
                        <th>All Register</th>
                        <th>Current Register</th>
                        <th>Percentage</th>
                        <th>Salary</th>
                        <th>Sign Up</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(fieldOfficers as $thana)
                            <tr>
                                <td><img style="width: 100px; height: 100px;" src="{{ asset('media/user/profile_pic/'.$thana->user->id.'/'.$thana->user->profile_pic)}}" alt=""></td>
                                <td>{{$thana->user->name}}</td>
                                <td>{{$thana->user->referral_id}}</td>
                                <td>{{$thana->user->phone}}</td>
                                <td>
                                    @php
                                     $totalRegister = BvonDoctorRegisterHistory::where('field_officer_id', $thana->id)->count();
                                     echo $totalRegister;
                                    @endphp
                                </td>
                                <td> @php
                                      $totalRegistercurrentMonth = BvonDoctorRegisterHistory::where('field_officer_id', $thana->id)->whereMonth('created_at', Carbon::now()->month)->count();
                                     echo $totalRegistercurrentMonth;
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    
                                     $totalRegistercurrentMonthAmount = BvonDoctorRegisterHistory::where('field_officer_id', $row->id)->whereMonth('created_at', Carbon::now()->month)->pluck('amount')->sum();
                                        $percentage= 0;
                                        if($totalRegistercurrentMonth > 0){
                                            $percentage = ($totalRegistercurrentMonthAmount / 30000)*100;
                                            $percentage =  number_format((float)$percentage, 2, '.', ',');
                                            echo percentage;
                                        }
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-signup-history/'.$thana->id.'/'.$thana->type)}}">Sign Up</a>
                                </td>
                                <td>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-work-history/'.$row->id.'/'.$row->type)}}">Work History</a> <br>
                                    <a href="{{url('dashboard/bvon-doctor/view-doctor-officer-details/'.$row->id.'/'.$row->type)}}">View Details</a>
                                </td>
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
