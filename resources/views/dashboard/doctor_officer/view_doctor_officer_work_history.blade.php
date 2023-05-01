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
    </style>
@endsection



@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.idcart-active', function () {
                let id = $(this).data('id');
                $.ajax({
                    dataType: 'json',
                    type:"get",
                    url: "{{url('/dashboard/admin_setting/idcart-active')}}",
                    data:{'id':id},
                    success:function(data){
                        window.location = '/dashboard/admin_setting/get-id-cart';
                    }
                });
            });
        });


        $(document).ready(function(){
            $(document).on('click', '.deleteDoctorInfo', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('/dashboard/bvon-doctor/doctor-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            window.location = '/dashboard/bvon-doctor/view-doctor';
                        }
                    });
                }
            });
        });

    </script>
@endsection


@section('content')
    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">View Doctor Officer Work History </h3>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th >A/N</th>
                        <th>phone</th>
                        <th>Date</th>
                        <th>All Reg</th>
                        <th>Cur. Reg</th>
                        <th>Target</th>
                        <th>Per</th>
                        <th>Salary</th>
                        <th>Month</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bvonRegisterHistory as $doctor)
                        <tr>
                            <td class="text-center">{{$doctor->id}}</td>
                            <td><img @if(!empty($doctor->district)) src="{{asset('/media/user/profile_pic/'.$doctor->district->user->id.'/'.$doctor->district->user->profile_pic)}}" @elseif(!empty($doctor->upazilla)) src="{{asset('/media/user/profile_pic/'.$doctor->upazilla->user->id.'/'.$doctor->upazilla->user->profile_pic)}}"  @elseif(!empty($doctor->field)) src="{{asset('/media/user/profile_pic/'.$doctor->field->user->id.'/'.$doctor->field->user->profile_pic)}}"  @endif style="width: 100px; height: 100px;" alt=""></td>
                            <td class="text-center"> @if(!empty($doctor->district)) {{ $doctor->district->user->name}} @elseif(!empty($doctor->upazilla)) {{ $doctor->upazilla->user->name }} @elseif(!empty($doctor->field)) {{ $doctor->field->user->name }}  @endif  </td>

                            <td class="text-center"> @if(!empty($doctor->district)) {{ $doctor->district->user->referral_id}} @elseif(!empty($doctor->upazilla)) {{ $doctor->upazilla->user->referral_id }} @elseif(!empty($doctor->field)) {{ $doctor->field->user->referral_id }}  @endif   </td>
                            <td class="text-center"> @if(!empty($doctor->district)) {{ $doctor->district->user->phone}} @elseif(!empty($doctor->upazilla)) {{ $doctor->upazilla->user->phone }} @elseif(!empty($doctor->field)) {{ $doctor->field->user->phone }}  @endif   </td>
                            <td>{{$doctor->register_date}}</td>

                            <td class="text-center">

                                @if($type == 'district')

                                    @php
                                        $allRegisterd = App\Model\BvonDoctorRegisterHistory::where('district_officer_id', $doctor->district_officer_id)->count();
                                      @endphp
                                @elseif($type == 'upazilla')
                                    @php
                                        $allRegisterd = App\Model\BvonDoctorRegisterHistory::where('upazilla_officer_id', $doctor->upazilla_officer_id)->count();
                                    @endphp


                                @elseif($type == 'field')
                                    @php
                                        $allRegisterd = App\Model\BvonDoctorRegisterHistory::where('field_officer_id', $doctor->field_officer_id)->count();
                                    @endphp

                                    @endif
                                @php echo $allRegisterd; @endphp

                            </td>


                            <td class="text-center">
                                {{$doctor->count}}
                            </td>

                            <td class="text-center">

                                    @if($type == 'district')
                                       1500
                                    @elseif($type == 'upazilla')
                                        300
                                    @elseif($type == 'field')
                                      30
                                    @endif


                            </td>

                            <td class="text-center">

                                @if($type == 'district')
                                    @php
                                        $percentage = ($doctor->count /1500)* 100;
                                       echo $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                     @endphp
                                @elseif($type == 'upazilla')
                                    @php
                                        $percentage = ($doctor->count /300)* 100;
                                   echo $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                    @endphp


                                @elseif($type == 'field')
                                    @php
                                        $percentage = ($doctor->count /30)* 100;
                                       echo $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                    @endphp

                                @endif

                            </td>

                            <td class="text-center">

                                @if($type == 'district')
                                    @php
                                        $percentage = ($doctor->count /1500)* 20000;
                                        $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                    @endphp


                                @elseif($type == 'upazilla')
                                    @php
                                        $percentage = ($doctor->count /300)* 20000;
                                       $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                    @endphp


                                @elseif($type == 'field')
                                    @php
                                        $percentage = ($doctor->count /30)* 10000;
                                       $percentage =  number_format((float)$percentage, 2, '.', ', ');
                                    @endphp

                                @endif
                                @php
                                    echo $percentage;
                                @endphp

                            </td>
                            <td>{{$doctor->month_name}}</td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
