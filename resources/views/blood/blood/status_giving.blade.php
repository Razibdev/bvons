@extends('layouts.front_layout.front_layout')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        select{
            width: 24%;
            float: left;
            margin-right: 5px;
            height: 40px;

        }
        .blood h2{
            width: 25%; float: left;
        }


        .switch {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 25px;
            border-radius: 20px;
            background: #dfd9ea;
            transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            vertical-align: middle;
            cursor: pointer;
        }
        .switch::before {
            content: '';
            position: absolute;
            top: 1px;
            left: 2px;
            width: 22px;
            height: 22px;
            background: #fafafa;
            border-radius: 50%;
            transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .switch:active::before {
            box-shadow: 0 2px 8px rgba(0,0,0,0.28), 0 0 0 20px rgba(128,128,128,0.1);
        }
        input:checked + .switch {
            background: #72da67;
        }
        input:checked + .switch::before {
            left: 27px;
            background: #fff;
        }
        input:checked + .switch:active::before {
            box-shadow: 0 2px 8px rgba(0,0,0,0.28), 0 0 0 20px rgba(0,150,136,0.2);
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

            .blood form .form-group select{
                width: 28%;
                float: none;
                margin-right: 5px;
                height: 40px;
                margin-bottom: 10px;

            }

            .block-blood-need{
                width: 25%;
            }

            table{
                width: 100%;
            }
        }

    </style>
@endpush


@section('content')
    <!-- Page Content -->
    <div class="main-wrapper" style="margin: 15px;">
        <div class="content-header-fullrow">

            <div class="blood">
                <div class="main-blood">
                    <h2 class="font-w700 text-black mb-10"><a href="{{route('bvon.blood.user.status')}}">Blood Status</a></h2>
                    <h2><a href="{{route('bvon.blood.user.status.needed')}}">Needed Blood</a></h2>
                    <h2><a href="{{route('bvon.blood.user.status.giving')}}">Giving Blood</a></h2>
                    <h2><a href="{{route('bvon.blood.user.status.already')}}">Already Blood</a></h2>
                </div>
                <br><br>
                <form action="{{route('bvon.blood.user.status.giving')}}" method="get"> {{csrf_field()}}
                    <div class="row">
                        <div class="form-group">
                            <select name="blood_group" id="blood_group" class="form-control">
                                <option value="0" disabled selected>Choose Blood Group</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="district" required id="district" class="form-control">
                                <option value="0" selected disabled> Choose District</option>
                                @foreach($district as $dis)
                                    <option value="{{$dis->id}}-{{$dis->name}}">{{$dis->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="thana" id="thana" required class="form-control">
                                <option value="0" selected disabled>Choose Thana</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button style="height: 40px; width: 150px; border:none; background: darkgrey;cursor:pointer;">Filter</button>
                        </div>

                    </div>
                </form>
                <br>
            </div>


            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-8 col-lg-8">
                    <div class="border">
                        <div class="block-content block-blood-need block-content-full">
                            <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                                <thead>
                                <tr >
                                    <th>Blood Group</th>
                                    <th>Name</th>
                                    <th>Permanent Address</th>
                                    <th>Present Address</th>
                                    <th>Photo</th>
                                    <th>Contact Number</th>
                                    <th>Wishing Mark</th>
                                </tr>
                                </thead>

                                <tbody style="text-align: center">
                                    <tr>
                                        <td>{{$user->blood}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->hometown}}</td>
                                        <td>{{$user->lives_in}}</td>
                                        <td><img src="{{asset('/media/user/profile_pic/'.$user->id.'/'.$user->profile_pic)}}" width="100" height="100" alt=""></td>
                                        <td>{{$user->phone}} <a href="tel:{{$user->phone}}">Call</a></td>
                                        <td><input value="{{$user->wishing}}" @if($user->wishing == 1) checked @endif type="checkbox" hidden="hidden" id="username">
                                            <label class="switch" for="username"></label></td>
                                    </tr>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->blood}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->hometown}}</td>
                                        <td>{{$user->lives_in}}</td>
                                        <td><img src="{{asset('/media/user/profile_pic/'.$user->user_id.'/'.$user->profile_pic)}}" width="100" height="100" alt=""></td>
                                        <td>{{$user->phone}} <a href="tel:{{$user->phone}}">Call</a></td>
                                        <td>@if($user->wishing == 1)Yes @else No @endif</td>
                                    </tr>
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
@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script>
        $('#district').change(function () {
            if($(this).val != ''){
                var value = $(this).val();
                $.ajax({
                    url: '{{route('bvon.blood.user.status.dependency.thana')}}',
                    method: 'get',
                    data:{'value': value, "_token": "{{ csrf_token() }}"},
                    success:function (result) {
                        $('#thana').html(result);
                        console.log(result);
                    }
                })
            }
        });


        $('#username').on('click', function () {
                var value = $(this).val();
                if(value == 1){
                    var val = 0;
                }else{
                    var val = 1;
                }
                $.ajax({
                    url: '{{route('bvon.blood.user.status.giving.update')}}',
                    method: 'get',
                    data:{'value': val, "_token": "{{ csrf_token() }}"},
                    success:function (result) {
                        console.log(result);
                        window.location = '/bvon/blood/user/status/giving';
                    }
                })

        });

    </script>

@endpush
