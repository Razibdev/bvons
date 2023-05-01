@extends('ecommerce.eco_layout.main')

@section('css_before')


@endsection

@section('js_after')

    <script>
        $('input[name="can_use_cashback"], input[name="user_price"], input[name="premium_price"]').on("keyup", function() {
            let useableCashBack = $('input[name="can_use_cashback"]').val();
            let userPrice = $('input[name="user_price"]').val()
            let premiumPrice = $('input[name="premium_price"]').val()

            console.log(useableCashBack, userPrice, premiumPrice);

            let userPriceAfterCashback = (userPrice * useableCashBack)/100;
            let premiumPriceAfterCashback = (premiumPrice * useableCashBack)/100;

            $('#premium_price_cashback').html(premiumPriceAfterCashback);
            $('#user_price_cashback').html(userPriceAfterCashback);

        });
    </script>

@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Product Details</h2>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Product Details</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary d-inline-block">
                        <a href="{{ route('products.details.edit', ["id" => $product->id]) }}">
                            <i class="si si-pencil"></i>
                        </a>
                    </button>
                    <form action="{{ route('products.details.delete', ["id" => $product->id]) }}" method="post" class="d-inline-block ml-20">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-alt-danger">
                            <i class="fal fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="block-content block-content-full">
                <div class="row d-flex">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $product->product_name }}</td>
                            </tr>

                            <tr>
                                <th>Sizes</th>
                                <td>{{ $product->product_size }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $product->product_quantity }}</td>
                            </tr>
                            <tr>
                                <th>Model No</th>
                                <td>{{ $product->product_model }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $product->product_permision }}</td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Vendor Name</th>
                                <td>{{ $product->vendor->name }}</td>
                            </tr>
                            <tr>
                                <th>Shop Name</th>
                                <td>{{ $product->shop->shop_name }}</td>
                            </tr>
                            <tr>
                                <th>Category Name</th>
                                <td>{{ $product->category->category_name }}</td>
                            </tr>
                            <tr>
                                <th>Sub Category Name</th>
                                <td>{{ $product->sub_category->sub_category_name }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brands->name }}</td>
                            </tr>

                        </table>
                       {{-- <p class="mt-5 m-0 font-weight-bold">Product Images</p>
                        <div class="d-flex" style="border: 1px solid #ddd;">
                            @foreach($product->media as $media)
                                <div class="product-image d-flex flex-column">
                                    <div class=""><img class="w-100" src="{{url('/storage/')}}/{{ $media->product_image }}" alt=""></div>
                                    <div class="text-center" style="background: {{ $media->product_color }}; color: #fff;">{{ $media->product_color }}</div>
                                </div>
                            @endforeach
                        </div>--}}

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-5 font-weight-bold p-0">Product Images</h5>
                        <div class="d-flex" style="border: 1px solid #ddd;">
                            @foreach($product->media as $media)
                                <div class="product-image d-flex flex-column">
                                    <div class=""><img class="w-100" src="{{url('/storage/')}}/{{ $media->product_image }}" alt=""></div>
                                    <div class="text-center" style="background: {{ $media->product_color }}; color: #fff;">{{ $media->product_color }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row mt-20">
                    <div class="col-md-12">
                        <h5 class="mt-5 font-weight-bold p-0">Description</h5>
                        <div class="m-0 css-revert">{!! $product->description !!}</div>
                    </div>
                </div>

            </div>
        </div>


        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Product Price</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route("products.approved",$product->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <table class="table table-bordered">
                        <tr>
                            <th>Production Price</th>
                            <th>Bvon Price</th>
                            <th>Store Amount</th>
                            <th>
                                SR Amount<br>
                                <small>L1,L2,L3,L4,L5</small>
                            </th>
                            <th>Useable Cashback Amount(%)</th>
                            <th>Premium Price</th>
                            <th>User Price</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" value="{{ $product->production_price }}" name="production_price">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $product->bvon_price }}" name="bvon_price">
                            </td>

                            <td>
                                <input type="text" class="form-control" value="{{ $product->store_amount }}" name="store_amount">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $product->sr_amount }}" name="sr_amount">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $product->can_use_cashback }}" name="can_use_cashback">
                            </td>

                            <td>
                                <input type="text" class="form-control" value="{{ $product->premium_price }}" name="premium_price">
                                <small class="">Cashback: <strong id="premium_price_cashback"></strong></small>
                            </td>

                            <td>
                                <input type="text" class="form-control" value="{{ $product->user_price }}" name="user_price">
                                <small class="">Cashback: <strong id="user_price_cashback"></strong></small>
                            </td>
                        </tr>
                    </table>

                    <div class="row d-flex justify-content-end">
                        <div class="col-md-3 text-right">
                            <button class="btn btn-alt-primary" type="submit">Save and Approved</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>



        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">Add Bdealers Product Price</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <form action="{{ route("products.add-beader-price",$product->id) }}" method="post">
                    @csrf

                    <table class="table table-bordered">
                        <tr>
                            <th>B-Dealer</th>
                            <th>Price</th>
                            <th>Minimum Quantity</th>
                        </tr>



                        @foreach($bdealer_type as $bdealer_t)

                            @php
                                $bproduct = $bdealer_t->bdealer_product_with_id($product->id);
                            @endphp
                            <tr>
                                <td>
                                    {{ $bdealer_t->name }}
                                    <input type="hidden" name="bdealer_type[{{ $loop->iteration }}][id]" value="{{ $bdealer_t->id }}">
                                </td>
                                <td>
                                    <input type="number" step="any" name="bdealer_type[{{ $loop->iteration }}][price]" value="{{ $bproduct ? $bproduct->purchase_price : 0}}" class="form-control" required>
                                </td>
                                <td>
                                    <input type="number" name="bdealer_type[{{ $loop->iteration }}][minimum_quantity]" value="{{ $bproduct ? $bproduct->minimum_quantity: 0 }}" class="form-control" required>
                                </td>
                            </tr>


                        @endforeach
                    </table>


                    <div class="row d-flex justify-content-end">
                        <div class="col-md-3 text-right">
                            <button class="btn btn-alt-primary" type="submit">Save Price</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>


    </div>
    <!-- END Page Content -->
@endsection
