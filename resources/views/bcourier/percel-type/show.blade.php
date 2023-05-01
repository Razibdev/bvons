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
        <h2 class="content-heading">Delivery Boy Details</h2>
        <!-- START Delivery Boy DETAILS -->

            <table class="table table-striped table-bordered table-light">
                    <tr>
                        <th>Name</th>
                        <td>{{ $delivery_boy->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Present Address</th>
                        <td>{{ $delivery_boy->present_address }}</td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td>{{ $delivery_boy->permanent_address }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td class="text-uppercase">{{ $delivery_boy->status }}</td>
                    </tr>
                    <tr>
                        <th>Media</th>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ Storage::disk('user_upload')->url($delivery_boy->pic) }}" target="_blank">
                                        <div class=""
                                             style="
                                                 width: 200px;
                                                 height: 200px;
                                                 background-image: url('{{ Storage::disk('user_upload')->url($delivery_boy->pic) }}');
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
                                        <p class="mute mt-5 mb-0">Delivery Boy Picture</p>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ Storage::disk('user_upload')->url($delivery_boy->nid_pic) }}" target="_blank">
                                        <div class=""
                                             style="
                                                 width: 200px;
                                                 height: 200px;
                                                 background-image: url('{{ Storage::disk('user_upload')->url($delivery_boy->nid_pic) }}');
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
                                        <p class="mute mt-5 mb-0">Nid Picture</p>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ Storage::disk('user_upload')->url($delivery_boy->p_nid_pic) }}" target="_blank">
                                        <div class="delivery_boy_picture">
                                            <div class=""
                                                 style="
                                                     width: 200px;
                                                     height: 200px;
                                                     background-image: url('{{ Storage::disk('user_upload')->url($delivery_boy->p_nid_pic) }}');
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
                                            <p class="mute mt-5 mb-0">Parent Nid Picture</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ Storage::disk('user_upload')->url($delivery_boy->e_bill_pic) }}" target="_blank">
                                        <div class=""
                                             style="
                                                 width: 200px;
                                                 height: 200px;
                                                 background-image: url('{{ Storage::disk('user_upload')->url($delivery_boy->e_bill_pic) }}');
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
                                        <p class="mute mt-5 mb-0">Electricity Bill Picture</p>

                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>Action</th>
                        <td>

                            <?php
                                $csrf_token_plus_method = csrf_field() . method_field('PATCH');
                                $active = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $delivery_boy->id, "status" => 'active']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-success" name="active_delivery_boy">Active Delivery Boy</button>
                                    </form>
                                ';

                                $cancel = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $delivery_boy->id, "status" => 'cancel']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-danger" name="cancel_delivery_boy">Cancel Delivery Boy</button>
                                    </form>
                                ';

                                $banned = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $delivery_boy->id, "status" => 'banned']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-warning" name="banned_delivery_boy">Banned Delivery Boy</button>
                                    </form>
                                ';
                            ?>

                            @if($delivery_boy->status === 'pending')
                                {!! $active !!}  {!! $cancel !!}  {!! $banned !!}
                            @elseif($delivery_boy->status === 'cancel')
                                {!! $active !!}  {!! $banned !!}
                            @elseif($delivery_boy->status === 'banned')
                                {!! $active !!}  {!! $cancel !!}
                            @elseif($delivery_boy->status === 'active')
                                {!! $banned !!}
                            @endif
                        </td>
                    </tr>
                </table>

        <!-- END Delivery Boy DETAILS -->
    </div>
    <!-- END Page Content -->
@endsection
