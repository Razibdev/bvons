@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .center{
            background: transparent;
            width: 100%;
            height: auto;
            background: darkgoldenrod;
        }
        .container{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .container{
            display: none;
            background: #fff;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
            margin-top: 150px;
        }


        .container .close-btn{
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 18px;
            cursor: pointer;
            color: #343A40;
        }

        .container .close-btn:hover{
            color: #3498db;
        }

        .container .text{
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            color: #343A40;
        }
        .container  form{
            margin-top: -20px;

        }

        .container  .data{
            height: 45px;
            width: 100%;
            margin: 30px 0;
        }
        .container .data label{
            color: #343A40;
            font-size: 20px;
        }

        .container .data input{
            height: 100%;
            width: 100%;
            padding-left: 10px;
            font-size: 17px;
            border: 1px solid silver;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .container .data input:focus{
            border-color: #1c91df;
            border-bottom-width: 2px;
        }

        .container .forgot-pass{
            margin-top: -8px;
        }
        .container .forgot-pass a{
            color: #3498db;
            text-decoration: none;
        }

        .container .btn{
            margin: 30px 0;
            height: 45px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .container .btn .inner{
            height: 100%;
            width: 300%;
            position: absolute;
            left: -100%;
            z-index: -1;
            background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8ea, #9f01ea );
            transition: all 0.4s;
        }

        .container .btn:hover .inner{
            left: 0;
        }

        .container .btn button{
            height: 100%;
            width: 100%;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .container .signup-link{
            text-align: center;
            color: #343A40;
        }

        .container .signup-link a{
            color: #3498db;
            text-decoration: none;
        }

        .container .signup-link a:hover{
            text-decoration: underline;
        }

        .container .signin-link{
            text-align: center;
            color: #343A40;
        }

        .container .signin-link  a{
            color: #3498db;
            text-decoration: none;
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
        $('.commission_edit').click(function () {
          $('.container').css('display', 'block');
        });

        $(document).ready(function () {
           $('.dataTable').css('max-width', '1142px') ;
           $('#DataTables_Table_0').style.maxWidth = 1142 + 'px';
        });

        function closeBtn() {
            $('.container').css('display', 'none');
        }
    </script>
@endsection


@section('content')

    <div class="content">
        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Commission <small></small></h3>
            </div>
            <div class="block-content block-content-full" style="overflow-x: scroll">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                <table style="overflow-x: scroll" class="table table-bordered table-striped table-vcenter js-dataTable-full" width="1142">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 20px;">#</th>
                        <th>Like</th>
                        <th>Comment</th>
                        <th>Share</th>
                        <th>Incentive Reward</th>
                        <th>Instant Bonus</th>
                        <th>Daily Top Seller Bonus</th>
                        <th>Weakly Top Teller Bonus</th>
                        <th>Monthly Top Seller Bonus</th>
                        <th>Leader Bonus</th>
                        <th>Dealer Point Bonus</th>
                        <th>Company Profit</th>
                        <th>Reserved Fund</th>
                        <th>Company Management</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commission as $com)
                        <tr>
                            <td class="text-center">{{$com->id}}</td>
                            <td class="font-w600">
                                {{$com->post_like}}
                            </td>

                            <td class="font-w600">
                                {{$com->post_comment}}
                            </td>

                            <td class="font-w600">
                                {{$com->post_share}}
                            </td>

                            <td class="font-w600">
                                {{$com->incentive_reward}}
                            </td>

                            <td class="font-w600">
                                {{$com->instant_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->daily_top_seller_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->weakly_top_seller_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->monthly_top_seller_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->leader_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->dealer_point_bonus}}
                            </td>

                            <td class="font-w600">
                                {{$com->company_profit}}
                            </td>

                            <td class="font-w600">
                                {{$com->reserved_fund}}
                            </td>

                            <td class="font-w600">
                                {{$com->company_management}}
                            </td>
                            <td>
                                <button class="commission_edit">Edit</button>
                            </td>

                        </tr>

                        <div class="center" >
                            <div class="container" id="signup-form">
                                <label for="" class="close-btn fas fa-times" onclick="closeBtn()"></label>
                                <div class="text">Edit Commission</div>
                                <form method="POST" action="{{url('dashboard/admin_setting/post-commission')}}"> {{csrf_field()}}
                                    <div class="data">
                                        <input type="hidden" name="id" value="{{$com->id}}">
                                        <label for="">Post Like</label>
                                        <input type="text" name="post_like" id="post_like" value="{{$com->post_like}}" placeholder="Enter Your Name" required>
                                    </div>
                                    <div class="data">
                                        <label for="">Post Comment</label>
                                        <input type="text" name="post_comment" id="post_comment" value="{{$com->post_comment}}" placeholder="01xxxxxxxxxx" required>
                                    </div>
                                    <div class="data">
                                        <label for="">Post Share</label>
                                        <input type="text" name="post_share" id="post_share" value="{{$com->post_share}}" required>
                                    </div>

                                    <div class="data">
                                        <label for="">Incentive Reward</label>
                                        <input type="text" name="incentive_reward" id="incentive_reward" value="{{$com->incentive_reward}}" required>
                                    </div>

                                    <div class="data">
                                        <label for="">Instant Bonus</label>
                                        <input type="text" name="instant_bonus" id="instant_bonus" value="{{$com->instant_bonus}}">
                                    </div>


                                    <div class="data">
                                        <label for="">Daily Top Seller Bonus</label>
                                        <input type="text" name="daily_top_seller_bonus" id="daily_top_seller_bonus" value="{{$com->daily_top_seller_bonus}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Weekly Top Seller Bonus</label>
                                        <input type="text" name="weakly_top_seller_bonus" id="weakly_top_seller_bonus" value="{{$com->weakly_top_seller_bonus}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Monthly Top Seller Bonus</label>
                                        <input type="text" name="monthly_top_seller_bonus" id="monthly_top_seller_bonus" value="{{$com->monthly_top_seller_bonus}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Leader Bonus</label>
                                        <input type="text" name="leader_bonus" id="leader_bonus" value="{{$com->leader_bonus}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Dealer Point Bonus</label>
                                        <input type="text" name="dealer_point_bonus" id="dealer_point_bonus" value="{{$com->dealer_point_bonus}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Company Profit</label>
                                        <input type="text" name="company_profit" id="company_profit" value="{{$com->company_profit}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Reserved Fund</label>
                                        <input type="text" name="reserved_fund" id="reserved_fund" value="{{$com->reserved_fund}}">
                                    </div>

                                    <div class="data">
                                        <label for="">Company Management</label>
                                        <input type="text" name="company_management" id="company_management" value="{{$com->company_management}}">
                                    </div>

                                    <div class="btn">
                                        <div class="inner">

                                        </div>
                                        <button type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Dynamic Table Full -->
    </div>




    <!-- END Page Content -->
@endsection
