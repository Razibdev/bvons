@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.deleteDoctorInfo', function () {
                let id = $(this).data('id');
                if(confirm('Your are sure, You want to delete this')){
                    $.ajax({
                        dataType: 'json',
                        type:"get",
                        url: "{{url('/b_dealer/orders/single-product-delete')}}",
                        data:{'id':id},
                        success:function(data){
                            console.log(data);
                            window.location = '/b_dealer/orders/'+data;
                        }
                    });
                }
            });
        });
    </script>


@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <!-- Bootstrap Design -->
        <h2 class="content-heading">B-Dealer Order Details</h2>
        <div class="row">
            <div class="col-md-8">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Order Details</h3>

                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="modal" data-target="#addProductForOrder" >
                                Add Product
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                       <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proudct Details</th>
                                    <th>Specification</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                           </thead>
                           @php
                                $totalPrice = 0;
                           @endphp
                           @foreach($border->border_details as $detail)
                               <tr>
                                   @php
                                        $product_d = json_decode($detail->product_json)->product_details;
                                        $order_d = json_decode($detail->product_json, true)["order_details"];
                                        $specifications = $order_d["specification"];
                                        $totalPrice += $detail->quantity * $order_d["price"];
                                   @endphp
                                   <th>{{ $loop->iteration }}</th>
                                   <td>
                                       <a href="{{ route('products.details', ["id" => $product_d->id]) }}">{{ $product_d->product_name }}</a>
                                   </td>
                                   <td>
                                       <table class="table table-bordered">
                                           <tr>
                                               <th>Size</th>
                                               <th>Quantity</th>
                                               <th>Price</th>
                                               <th>Total Price</th>

                                           </tr>
                                           @foreach($specifications as $specification)
                                                <tr>
                                                    <td>{{ $specification["size"] }}</td>
                                                    <td>{{ $specification["quantity"] }}</td>
                                                    <td>{{ $order_d["price"] }}</td>
                                                    <td>{{ $specification["quantity"] * $order_d["price"] }}</td>
                                               </tr>
                                           @endforeach
                                           <tr>
                                               <th>Total Quantity</th>
                                               <td>{{ $detail->quantity }}</td>
                                               <th>Total Price</th>
                                               <td>{{ $detail->quantity * $order_d["price"] }}</td>
                                           </tr>
                                       </table>
                                   </td>
                                   <td>{{ $detail->quantity * $order_d["price"] }}</td>
                                   <td> <div style="height: 100%; vertical-align: center; display: flex;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$detail->id}}" >Edit</button>
                                       <br> <br>  <button type="button" class="btn btn-danger deleteDoctorInfo" data-id="{{$detail->id}}">Delete</button></div></td>


                                   <div class="modal fade" id="exampleModalCenter{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered" role="document">
                                           <div class="modal-content">
                                               <form action="{{url('/b_dealer/orders/update-single-product-quantity')}}" method="post" > {{csrf_field()}}
                                               <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLongTitle">{{ $product_d->product_name }}</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">

                                                       <div class="row">
                                                           <div class="col-sm-12 col-md-12">
                                                               <div class="form-group">
                                                                   <label for="">Quantity</label>
                                                                   <div class="form-group">
                                                                       <input type="text" name="quantity" value="{{$detail->quantity}}" class="form-control">
                                                                       <input type="hidden" name="price" value="{{$detail->price}}" class="form-control">
                                                                       <input type="hidden" name="id" value="{{$detail->id}}" class="form-control">
                                                                   </div>
                                                               </div>
                                                           </div>


                                                       </div>

                                               </div>
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Save changes</button>
                                               </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>


                               </tr>
                           @endforeach
                                <tr>
                                    <th colspan="3" class="text-right">Total Price</th>
                                    <td>{{ $totalPrice }}</td>
                                </tr>
                       </table>

                    </div>
                </div>

                @if($border->assigned_to === NULL && ($border->status !== 'complete' && $border->status !== 'cancel'))
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Actions</h3>

                            <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-wrench"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content d-flex justify-content-between align-items-center p-20">
                            <form action="{{ route('b-dealer.order.complete') }}" class="border p-20" method="POST">
                                @csrf
                                @method('PATCH')
                                <h5>Complete Order</h5>
                                <div class="form-group">
                                    <label for="">Order Pin</label>
                                    <input type="hidden" name="order_id" value="{{$border->id}}" >
                                    <input type="text" name="pin" id="" class="form-control" placeholder="Give order pin">
                                </div>
                                <div class="form-group">
                                    <button type="submit" onclick="confirm('Are you sure you want to complete this order?')" class="btn btn-alt-success">Submit</button>
                                </div>
                            </form>

                            @if($border->bdealer->type->id != 1)
                                <?php
                                    $area = null;
                                    if($border->bdealer->type->id === 2) { // order by premimum dealer
                                        $area = [
                                            "dealer_name" => "Distributor",
                                            "column_name" => "zone_id",
                                            "column_value" => $border->bdealer->zone_id
                                        ];
                                    } else if($border->bdealer->type->id === 3) { // order by B Dealer
                                        $area = [
                                            "dealer_name" => "Premium Dealer",
                                            "column_name" => "district_id",
                                            "column_value" => $border->bdealer->district_id
                                        ];
                                    } else if($border->bdealer->type->id === 4) { // order by Sub B Dealer
                                        $area = [
                                            "dealer_name" => "B Dealer",
                                            "column_name" => "thana_id",
                                            "column_value" => $border->bdealer->thana_id
                                        ];
                                    }

                                    if($area) {
                                        $order_forward_users = \App\Model\Bdealer\Bdealer::where($area["column_name"], $area["column_value"])->where("id", "!=", $border->bdealer->id)->get();
                                    }

                                ?>
                            <form action="{{ route('b-dealer.order.forward_order') }}" class="border p-20" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <h5>Forward Order</h5>
                                    <label for="">Select {{$area["dealer_name"]}}</label>
                                    <select name="forward_dealer_id" id="" class="form-control mb-20" required>
                                        <option value="">Please Select One</option>
                                        @foreach($order_forward_users as $order_forward_user)
                                            <option value="{{$order_forward_user->id}}">{{$order_forward_user->user->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="order_id" value="{{$border->id}}" >
                                    <button type="submit" class="btn btn-alt-success">Submit</button>
                                </div>
                            </form>

                            @endif

                            <div class="">
                                @if($border->status !== 'complete' && $border->status !== 'processing' && $border->status !== 'shipped')
                                    <form action="{{route('b-dealer.order.change_status_order')}}" class="" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="order_id" value="{{$border->id}}">
                                        <input type="hidden" name="status" value="processing">
                                        <div class="form-group d-inline-block">
                                            <button type="submit" class="btn btn-alt-info">Processing Order</button>
                                        </div>
                                    </form>
                                @endif
                                @if($border->status !== 'complete' && $border->status !== 'shipped')
                                    <form action="{{route('b-dealer.order.change_status_order')}}" class="" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="order_id" value="{{$border->id}}">
                                        <input type="hidden" name="status" value="shipped">
                                        <div class="form-group d-inline-block">
                                            <button type="submit" class="btn btn-alt-warning">Shipped Order</button>
                                        </div>
                                    </form>
                                @endif
                                @if($border->status !== 'complete')
                                    <form action="{{route('b-dealer.order.cancel_order')}}" class="" method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="order_id" value="{{$border->id}}">
                                        <div class="form-group d-inline-block">
                                            <button type="submit" class="btn btn-alt-danger">Cancel Order</button>
                                        </div>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Details</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>Serial: </th>
                                <td>{{ $border->serial }}</td>
                            </tr>

                            <tr>
                                <th>Status: </th>
                                <td>{{ $border->status }}</td>
                            </tr>

                            <tr>
                                <th>Delivery Address: </th>
                                <td>{{ $border->delivery_address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Order By</h3>

                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <ul class="list-group mb-5">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <p class="m-0">
                                    <img class="mr-10" style="border-radius: 50%; width: 30px; height: 30px;" src="{{ env('USER_PROFILE_URL') . '/' . $border->user()->id . '/' . $border->user()->profile_pic }}" alt="">
                                    <a href="{{ route('bf.user.details', ["user" => $border->user()->id]) }}">{{$border->user()->name}}</a>
                                </p>
                                <span class="badge badge-success badge-pill">{{$border->bdealer->type->name}}</span>
                            </li>
                        </ul>
                        <table class="table table-bordered">
                            <tr>
                                <th>Zone</th>
                                <td>{{$border->bdealer->zone->name}}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{$border->bdealer->district->name}}</td>
                            </tr>
                            <tr>
                                <th>Thana</th>
                                <td>{{$border->bdealer->thana->name}}</td>
                            </tr>
                            <tr>
                                <th>Village</th>
                                <td>{{$border->bdealer->village->name}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Order To</h3>

                        <div class="block-options">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        @if($border->bdealer_assign_to)
                            <ul class="list-group mb-5">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <p class="m-0">
                                        <img class="mr-10" style="border-radius: 50%; width: 30px; height: 30px;" src="{{ env('USER_PROFILE_URL') . '/' . $border->user_assign_to()->id . '/' . $border->user_assign_to()->profile_pic }}" alt="">
                                        <a href="{{ route('bf.user.details', ["user" => $border->user_assign_to()->id]) }}">{{$border->user_assign_to()->name}}</a>
                                    </p>
                                    <span class="badge badge-success badge-pill">{{$border->bdealer_assign_to->type->name}}</span>
                                </li>
                            </ul>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Zone</th>
                                    <td>{{$border->bdealer_assign_to->zone->name}}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{$border->bdealer_assign_to->district->name}}</td>
                                </tr>
                                <tr>
                                    <th>Thana</th>
                                    <td>{{$border->bdealer_assign_to->thana->name}}</td>
                                </tr>
                                <tr>
                                    <th>Village</th>
                                    <td>{{$border->bdealer_assign_to->village->name}}</td>
                                </tr>
                            </table>
                        @else
                            <ul class="list-group mb-20">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <p class="m-0 d-flex align-items-center">
                                        <i class="fal fa-user-circle fa-2x mr-10"></i> <a href="#">{{__('Admin')}}</a>
                                    </p>
                                    <span class="badge badge-success badge-pill">{{__('Admin')}}</span>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>



        </div>


        <!-- END Bootstrap Design -->
    </div>
    <!-- END Page Content -->



    <div class="modal fade" id="addProductForOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{url('/b_dealer/orders/add-single-product')}}" method="post" > {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$border->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="district">Select Product</label><br>
                                    <select name="product_id" id="district"  class="js-select2 form-control" style="height: 52px !important;width: 457px">
                                        <option  value="">Select Product </option>
                                        @foreach($products as $product)
                                            @if(!empty($product->products))
                                                <option value="{{$product->id}}">{{$product->products->product_name}} -- {{$product->products->product_size}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <div class="form-group">
                                        <input type="text" name="quantity" value="" class="form-control" placeholder="Enter Quantity">

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection

