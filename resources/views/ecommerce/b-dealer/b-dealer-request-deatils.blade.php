@extends('layouts.backend')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>

    <script>
        @php
            $limit = 1;
            $addTime = null;
            if($last_transaction) {
                $diff = $last_transaction->created_at->diffInMinutes(\Carbon\Carbon::now());
                $addTime = $last_transaction->created_at->addMinutes($limit)->format('Y/m/d H:i:s');
            }
        @endphp
        @if($last_transaction)
        $('#clock').countdown('{{ $addTime }}', function(event) {
            $(this).html(event.strftime('%H:%M:%S'));
        }).on('finish.countdown', function(event) {
            $(this).html('<button onclick="location.reload();" class="btn btn-alt-primary"><i class="fas fa-sync-alt"></i></button>');

        });
        @endif

        async function getBdealerUser(url, params, label) {
            let output = '';
            let res = await axios.get(url, params);

            if(res.data.length) {
                output += `
                    <label for="">Select ${label}</label>
                    <select class="form-control" required name="bdealer_id">
                        <option value="">Please Select One</option>
                `;
                for(let user of res.data ) {
                    output += `<option value="${user.id}">${user.user.name}</option>`;
                }
                output += `</select>`;
            } else {
                output += `
                    <label for="">Select ${label}</label>
                    <select class="form-control" required name="bdealer_id">
                        <option value="">In this zone doesn't have any ${label}</option>
                    </select>
                `;
            }
            return output;
        }


        $('#bdealer_type_id').on('change', async function (evt){
            /*
                bdealer type
                value 1 = Distributor
                value 2 = Premimum dealer
                value 3 = B Dealer
                value 4 = Sub B Dealer
            */
            let bDealerType = $(this).val();
            let zone_id = $(this).attr('zone_id');
            let district_id = $(this).attr('district_id');
            let thana_id = $(this).attr('thana_id');
            let village_id = $(this).attr('village_id');
            let url = "{{ route('getBdealerAjax') }}";

            let bdealerUserOutput = "";
            if(bDealerType == 1) {
                $("#addBdealerUser").html(bdealerUserOutput);
            } else if(bDealerType == 2) {

                let bdealerUserOutput = await getBdealerUser(url,{
                    params: {
                        b_dealer_type_id : bDealerType - 1,
                        zone_id : zone_id,
                    }
                }, "Distributor");

                let allDistributor = await axios(url, {
                    params: {
                        all_distributor: true,
                        b_dealer_type_id : bDealerType - 1,
                        zone_id : zone_id,
                    }
                })
                if(allDistributor.data.length) {
                    bdealerUserOutput += `
                    <label for="">Select Reference Distributor</label>
                    <select class="form-control" name="bdealer_reference_id">
                        <option value="">Please Select One</option>
                `;
                    for(let user of allDistributor.data) {
                        bdealerUserOutput += `<option value="${user.id}">${user.user.name}</option>`;
                    }
                    bdealerUserOutput += `</select>`;
                }



                $("#addBdealerUser").html(bdealerUserOutput);

            } else if(bDealerType == 3) {
                let bdealerUserOutput = await getBdealerUser(url,{
                    params: {
                        b_dealer_type_id : bDealerType - 1,
                        zone_id : zone_id,
                        district_id: district_id
                    }
                }, "Premimum Dealer");
                $("#addBdealerUser").html(bdealerUserOutput);
            } else if(bDealerType == 4) {
                let bdealerUserOutput = await getBdealerUser(url,{
                    params: {
                        b_dealer_type_id : bDealerType - 1,
                        zone_id : zone_id,
                        district_id: district_id,
                        thana_id: thana_id,
                    }
                }, "B-Dealer");
                $("#addBdealerUser").html(bdealerUserOutput);
            }
        });



        $('#rechargeBdealer').on('submit', function(e){
            e.preventDefault();
            $("#rechargeSubmitButton").attr('disabled', 'disabled');
            this.submit();
        });


    </script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">Bdealer Details</h2>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>User name</th>
                                <td>
                                    <a href="{{route('bf.user.details', ["user" => $b_dealer->user->id])}}">
                                        {{ $b_dealer->user->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Bdealer Type</th>
                                <td>{{ $b_dealer->type->name ?? "" }}</td>
                            </tr>
                            <tr>
                                <th>Zone</th>
                                <td>{{ $b_dealer->zone->name }}</td>
                            </tr>

                            <tr>
                                <th>District</th>
                                <td>{{ $b_dealer->district->name }}</td>
                            </tr>
                            <tr>
                                <th>Thana</th>
                                <td>{{ $b_dealer->thana->name }}</td>
                            </tr>
                            <tr>
                                <th>Village</th>
                                <td>{{ $b_dealer->village->name }}</td>
                            </tr>
                            <tr>
                                <th>contact</th>
                                <td>{{ $b_dealer->contact }}</td>
                            </tr>
                            <tr>
                                <th>Business type</th>
                                <td>{{ $b_dealer->business_type }}</td>
                            </tr>
                            <tr>
                                <th>Comment about business</th>
                                <td>{{ $b_dealer->comment_about_business }}</td>
                            </tr>
                            <tr>
                                <th>status</th>
                                <td>{{ $b_dealer->status }}</td>
                            </tr>

                            <tr>
                                <th>Dealer AC NO: </th>
                                <td>{{ $dealeraccount->dealer_referral_id }}</td>
                            </tr>

                            <tr>
                                <th>Dealer Under</th>
                                <td> @if(isset($dealer->name)) <a href="{{route('bf.user.details', ["user" => $dealer->user->id])}}"> {{ $dealer->name }} </a> @else Company @endif</td>
                            </tr>

                            <tr>
                                <th>Reffered By</th>
                                <td> @if(isset($under->name)) <a href="{{route('bf.user.details', ["user" => $under->user->id])}}"> {{ $under->name }} </a> @else Company @endif</td>
                            </tr>


                            <tr>
                                <th>Dealer's Stock</th>
                                <td><a href="{{url('/b_dealer/dealer-stock/'.$b_dealer->id)}}">Check Stock</a></td>
                            </tr>
                            <tr>
                                <th>media info</th>
                                <td>
                                    <div class="row d-flex flex-wrap">
                                        <div class="m-20">
                                            <a href=" {{url('/storage/user/'.$b_dealer->pic)}}" target="_blank">
                                                <div class=""
                                                     style="
                                                         width: 200px;
                                                         height: 200px;
                                                         background-image: url('{{url('/storage/user/'.$b_dealer->pic)}}');
                                                         background-size: contain;
                                                         background-repeat: no-repeat;
                                                         border: 1px solid #ddd;
                                                         display: flex;
                                                         justify-content: center;
                                                         align-items: center;
                                                         background-position: center;
                                                         padding: 5px;
                                                         background-origin: content-box;

                                                         "
                                                ></div>
                                                <p class="mute mt-5 mb-0">B-Dealer Picture</p>
                                            </a>
                                        </div>

                                        <div class="m-20">
                                            <a href="{{url('/storage/user/'.$b_dealer->nid_pic_front)}}" target="_blank">
                                                <div class=""
                                                     style="
                                                         width: 200px;
                                                         height: 200px;
                                                         background-image: url('{{url('/storage/user/'.$b_dealer->nid_pic_front)}}');
                                                         background-size: contain;
                                                         background-repeat: no-repeat;
                                                         border: 1px solid #ddd;
                                                         display: flex;
                                                         justify-content: center;
                                                         align-items: center;
                                                         background-position: center;
                                                         padding: 5px;
                                                         background-origin: content-box;

                                                         "
                                                ></div>
                                                <p class="mute mt-5 mb-0">Nid Picture Front</p>
                                            </a>
                                        </div>

                                        <div class="m-20">
                                            <a href="{{url('/storage/user/'.$b_dealer->nid_pic_back)}}" target="_blank">
                                                <div class=""
                                                     style="
                                                         width: 200px;
                                                         height: 200px;
                                                         background-image: url('{{url('/storage/user/'.$b_dealer->nid_pic_back)}}');
                                                         background-size: contain;
                                                         background-repeat: no-repeat;
                                                         border: 1px solid #ddd;
                                                         display: flex;
                                                         justify-content: center;
                                                         align-items: center;
                                                         background-position: center;
                                                         padding: 5px;
                                                         background-origin: content-box;

                                                         "
                                                ></div>
                                                <p class="mute mt-5 mb-0">Nid Picture Back</p>
                                            </a>
                                        </div>
                                        {{--{{ Storage::disk('user_upload')->url($b_dealer->ecucation_cert_pic) }}--}}

                                        <div class="m-20">
                                            <a href="{{url('/storage/user/'.$b_dealer->ecucation_cert_pic)}}" target="_blank">
                                                <div class=""
                                                     style="
                                                         width: 200px;
                                                         height: 200px;
                                                         background-image:  url('{{url('/storage/user/'.$b_dealer->ecucation_cert_pic)}}');
                                                         background-size: contain;
                                                         background-repeat: no-repeat;
                                                         border: 1px solid #ddd;
                                                         display: flex;
                                                         justify-content: center;
                                                         align-items: center;
                                                         background-position: center;
                                                         padding: 5px;
                                                         background-origin: content-box;

                                                         "
                                                ></div>
                                                <p class="mute mt-5 mb-0">Certificate Picture</p>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-md-5">
                @if($b_dealer->status === 'pending')
                <div class="block">
                    <div class="block-content block-content-full">
                        <form action="{{ route('b-dealer.request.active', ["id" => $b_dealer->id]) }}" method="post">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input required type="text" name="shop_name" id="shop_name" class="form-control" placeholder="B-Dealer Shop Name" aria-describedby="shop_name_error">
                                <small id="shop_name_error" class="text-muted"></small>
                            </div>

                            <div class="form-group">
                                <label for="bdealer_type_id">B-Dealer Type</label>
                                <select required
                                        name="bdealer_type_id"
                                        id="bdealer_type_id"
                                        class="form-control"
                                        aria-describedby="bdealer_type_error"
                                        zone_id="{{$b_dealer->zone_id}}"
                                        district_id="{{$b_dealer->district_id}}"
                                        thana_id="{{$b_dealer->thana_id}}"
                                        village_id="{{$b_dealer->village_id}}"
                                >
                                    <option value="">Please Select One</option>

                                    @foreach($b_dealer_type as $bd_type)
                                        <option value="{{$bd_type->id}}">
                                            {{$bd_type->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="bdealer_type_error" class="text-muted"></small>
                            </div>

                            <div class="form-group" id="addBdealerUser">

                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-alt-success" type="submit">Acitve B-Dealer</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                {{--recharge bdealer account--}}


                @if($b_dealer->status === 'active')

                        @if($last_transaction === null)
                            <div class="block mt-5">
                                <div class="block-content block-content-full">
                                    <form id="rechargeBdealer" action="{{ route('b-dealer.recharge', ["id" => $b_dealer->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="recharge_amount">Recharge Amount</label>
                                            <input required type="number" name="recharge_amount" id="recharge_amount" class="form-control" placeholder="Recharge Amount" aria-describedby="recharge_amount_error">
                                            <small id="recharge_amount_error" class="text-muted"></small>
                                        </div>


                                        <div class="form-group">
                                            <label for="payment_method">Payment Method</label>
                                            <input required type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Payment Method" aria-describedby="payment_method_error">
                                            <small id="payment_method_error" class="text-muted"></small>
                                        </div>

                                        <div class="form-group text-right">
                                            <input type="hidden" name="bdealer_transaction_category_id" value="1">
                                            <button id="rechargeSubmitButton" class="btn btn-alt-success" type="submit">Recharge</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif ($last_transaction && $diff >= $limit)
                            <div class="block mt-5">
                                <div class="block-content block-content-full">
                                    <form id="rechargeBdealer" action="{{ route('b-dealer.recharge', ["id" => $b_dealer->id]) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="recharge_amount">Recharge Amount</label>
                                            <input required type="number" name="recharge_amount" id="recharge_amount" class="form-control" placeholder="Recharge Amount" aria-describedby="recharge_amount_error">
                                            <small id="recharge_amount_error" class="text-muted"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="payment_method">Payment Method</label>
                                            <input required type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Payment method" aria-describedby="payment_method_error">
                                            <small id="payment_method_error" class="text-muted"></small>
                                        </div>


                                        <div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <select name="payment_type" id="payment_type" class="form-control" >
                                                <option value="c">Add Balance</option>
                                                <option value="d">Minus Balance</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_type">Message</label>
                                            <textarea name="message" id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group text-right">
                                            <input type="hidden" name="bdealer_transaction_category_id" value="1">
                                            <button id="rechargeSubmitButton" class="btn btn-alt-success" type="submit">Recharge</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="block mt-5">
                                <div class="block-content block-content-full">
                                    After <span id="clock"></span>  Minute you can recharge again.
                                </div>
                            </div>
                        @endif
                @endif



                {{--Bdealer Transaction--}}
                <div class="block mt-5">
                    <div class="block-header bg-light">
                        Bdealer Transactions
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-bordered">
                            <tr>
                                <th>Type</th>
                                <th>Date and Time</th>
                                <th>Method</th>
                                <th>Amount</th>
                            </tr>
                            @foreach($b_dealer->transactions as $b_dealer_transaction)
                            <tr class="">
                                <td>{{$b_dealer_transaction->category->name}}</td>
                                <td>{{ date('d-M-Y | H:i:s', strtotime($b_dealer_transaction->created_at))}}</td>
                                <td>{{$b_dealer_transaction->payment_method}}</td>
                                <td @if($b_dealer_transaction->type =='d') style="color: red;" @endif>{{$b_dealer_transaction->amount}}</td>

                            </tr>
                            @endforeach
                            <tr class="bg-light">
                                <th style="text-align: right;" colspan="3">Total Blance</th>
                                <td>{{ $b_dealer->balance() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
