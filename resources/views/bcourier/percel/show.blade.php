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
        <h2 class="content-heading">Percel Details</h2>
        <!-- START Delivery Boy DETAILS -->

            <table class="table table-bordered table-light">
                    <tr>
                        <th>Username</th>
                        <td>{{ $parcel->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Percel Name</th>
                        <td>{{ $parcel->name }}</td>
                    </tr>

                    <tr>
                        <th>Percel type</th>
                        <td>{{ $parcel->type->name }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td class="text-uppercase">{{ $parcel->status }}</td>
                    </tr>
                    <tr>
                        <th>Percel Images</th>
                        <td>
                            <div class="row">
                                @foreach(json_decode($parcel->images, true) ?? [] as $img)
                                <div class="col-md-3">
                                    <a href="{{ Storage::disk('user_upload')->url($img) }}" target="_blank">
                                        <div class=""
                                             style="
                                                 width: 200px;
                                                 height: 200px;
                                                 background-image: url('{{ Storage::disk('user_upload')->url($img) }}');
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
                                        <p class="mute mt-5 mb-0">Parcel Images - {{ $loop->iteration }}</p>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>Sender Info</th>
                        <td>
                            <table>
                                <tr>
                                    <td>sender name</td>
                                    <td>{{ $parcel->sender_name }}</td>
                                </tr>
                                <tr>
                                    <td>sender phone</td>
                                    <td>{{ $parcel->sender_phone }}</td>
                                </tr>
                                <tr>
                                    <td>pickup address</td>
                                    <td>{{ $parcel->pickup_address }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Receiver Info</th>
                        <td>
                            <table>
                                <tr>
                                    <td>receiver name</td>
                                    <td>{{ $parcel->receiver_name }}</td>
                                </tr>
                                <tr>
                                    <td>receiver phone</td>
                                    <td>{{ $parcel->receiver_phone }}</td>
                                </tr>
                                <tr>
                                    <td>receiver address</td>
                                    <td>{{ $parcel->receiver_address }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <th>Action</th>
                        <td>

                            <?php
                                $csrf_token_plus_method = csrf_field() . method_field('PATCH');
                                $active = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $parcel->id, "status" => 'active']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-success" name="active_delivery_boy">Active Delivery Boy</button>
                                    </form>
                                ';

                                $cancel = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $parcel->id, "status" => 'cancel']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-danger" name="cancel_delivery_boy">Cancel Delivery Boy</button>
                                    </form>
                                ';

                                $banned = '
                                    <form action="'. route('bco.delivery_boy.change_status', ["delivery_boy" => $parcel->id, "status" => 'banned']) .'" method="post" class="mr-5 d-inline-block">
                                        '. $csrf_token_plus_method .'
                                        <button type="submit" class="btn btn-outline-warning" name="banned_delivery_boy">Banned Delivery Boy</button>
                                    </form>
                                ';
                            ?>

                            @if($parcel->status === 'pending')
                                {!! $active !!}  {!! $cancel !!}  {!! $banned !!}
                            @elseif($parcel->status === 'cancel')
                                {!! $active !!}  {!! $banned !!}
                            @elseif($parcel->status === 'banned')
                                {!! $active !!}  {!! $cancel !!}
                            @elseif($parcel->status === 'active')
                                {!! $banned !!}
                            @endif
                        </td>
                    </tr>
                </table>

        <!-- END Delivery Boy DETAILS -->
    </div>
    <!-- END Page Content -->
@endsection
