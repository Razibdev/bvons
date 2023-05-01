@extends('layouts.backend')

@section('title', 'Create New Purchase')

@section('css_before')
    <link rel="stylesheet" href="{{asset('/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        #purchase-dataTable_filter {
            display: none;
        }
    </style>
@endsection

@section('js_after')
    <script src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <script src="{{asset('/js/plugins/jquery-number/jquery.number.min.js')}}"></script>


    <script>
        $('.format-number-with-comma').number( true );
    </script>

    <script>
        var table = $('#purchase-dataTable').DataTable({
            "info": true,
            // "pageLength": 100,
            "lengthMenu": [[100, 200, 300, -1], [100, 200, 300, "All"]],
            scrollY: 300,
            "oLanguage": {
                "sInfo": "Showing _START_ to _END_ Of _TOTAL_ Products"
            }
        });

        // #myInput is a <input type="text"> element
        $('#custom-dataTable-search').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );

        $('#clearDataTableSearch').on('click', function(){
            $('#custom-dataTable-search').val('');
            $('#custom-dataTable-search').keyup();
        });

        $('.dataTables_filter').after('<button class="float-right btn btn-sm btn-alt-primary add-multiple-products"><i class="fa fa-arrow-right"></i></button>')
    </script>

    <script>
        let purchaseRoute = "{{ route('purchase.create') }}";
    </script>

    <script src="{{ '/js/dashboard/Product.js' }}"></script>
    <script src="{{ '/js/dashboard/Purchase.js' }}"></script>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">Product Purchase</h2>

        <div class="row">

            <div class="col-md-12">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('vendor.create')}}" class="btn btn-alt-primary">
                                        <i class="si si-plus"></i> Add New Vendor
                                    </a>

                                    <a href="{{route('warehouse.create')}}" class="btn btn-alt-primary">
                                        <i class="si si-plus"></i> Add New Warehouse
                                    </a>
                                </div>
                            </div>

                        </h3>
                    </div>
                    <div class="block-content block-content-full">

                        <div class="form-group">
                            <label for="example-nf-email">Select Vendor</label>
                            <select class="form-control vendor" id="" name="vendor">
                                <option value="">Please Select One Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="example-nf-email">Select Warehouse</label>
                            <select class="form-control warehouse" id="example-select" name="warehouse">
                                <option value="">Please Select One Warehouse</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>

             {{-- Products List --}}
            <div class="col-md-6">
                <!-- Dynamic Table Full -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('product.create')}}" class="btn btn-alt-primary">
                                        <i class="si si-plus"></i> Add New Products
                                    </a>
                                    <small></small>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" id="custom-dataTable-search" class="form-control" placeholder="Search Your Products...">

                                        <div class="input-group-append">
                                            <button id="clearDataTableSearch" type="button" class="btn btn-secondary">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table id="purchase-dataTable" class="table table-bordered table-responsive-sm table-ku font-size-sm">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Name</th>
                                <th width="40%">Model</th>
                                <th width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody style="border-top: 1px solid #ddd;">
                            @foreach($products as $product)
                                <?php
                                    $productJson = [
                                        "id" => $product->id,
                                        "name" => $product->name,
                                        "category_id" => $product->category_id,
                                        "category_name" => $product->category->name,
                                        "model" => $product->model,
                                        "unit" => $product->unit,
                                        "purchase_status" => $product->purchase_status,
                                        "purchase_price" => 0,
                                        "purchase_quantity" => 0,
                                        "purchase_total_price" => 0,
                                    ];
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input class="custom-control-input product-checkbox" type="checkbox" name="products" id="{{ $product->id }}" value="{{ json_encode($productJson) }}">
                                            <label class="custom-control-label" for="{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="">
                                        {{ $product->name }}
                                        <a href="javascript:void(0)">
                                            <i class="si si-info pull-right"></i>
                                        </a>
                                    </td>
                                    <td class="">
                                        {{ $product->model }}
                                    </td>
                                    <td>
                                        <button class="btn btn-alt-primary btn-circle add-to-purchase-icon" product-details="{{ json_encode( $productJson ) }}">
                                            <i class="fa fa-shopping-basket btn-noborder add-to-purchase-icon" product-details="{{ json_encode( $productJson ) }}"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Dynamic Table Full -->
            </div>




            {{-- Purchase Cart --}}
            <div class="col-md-6">
                <!-- Dynamic Table Full -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="block-title">Add Your Product Over Here to Purchase</h3>
                                    <small></small>
                                </div>
                                {{--<div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" id="custom-dataTable-search" class="form-control" placeholder="Search Your Products...">

                                        <div class="input-group-append">
                                            <button id="clearDataTableSearch" type="button" class="btn btn-secondary">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>--}}
                            </div>

                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{route('purchase.store')}}" id="purchase-form">
                            <table class="table table-bordered table-responsive-sm table-ku font-size-sm">
                                <thead>
                                <tr>
                                    <th title="Action">A</th>
                                    <th width="60%">Name</th>
                                    <th width="25%" title="Purchase Name">P. Price</th>
                                    <th width="15%" title="Quantity">Qty</th>
                                    <th title="Total Price">T. Price</th>
                                </tr>
                                </thead>
                                <tbody class="purchase-items">

                                    <tr class="purchase-item-empty">
                                        <td colspan="5" class="text-center">Add Product to Purchase</td>
                                    </tr>
                                    {{--@for($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td class="text-center">
                                            <a href="">
                                                <i class="fa fa-remove text-danger"></i>
                                            </a>
                                        </td>
                                        <td>Samsung NVMe 4.0 1TB</td>
                                        <td><input type="text" class="form-control p-1 border-radius-0 font-size-10" value="0"></td>
                                        <td><input type="text" class="form-control p-1 border-radius-0 font-size-10" value="0"></td>
                                        <td class="format-number-with-comma">30502546</td>

                                    </tr>
                                    @endfor--}}
                                </tbody>

                                <tbody class="purchase-total-price">
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                        <td class="format-number-with-comma p-total-price">0</td>
                                    </tr>
                                </tbody>

                                <tbody class="purchase-payments">

                                </tbody>

                                <tbody class="purchase-due">
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>Due:</strong></td>
                                        <td class="format-number-with-comma p-total-due">0</td>
                                    </tr>
                                </tbody>
                                <tfoot class="purchase-add-payment">
                                    <tr>
                                        <td colspan="5">
                                            <p>Add Payment:</p>
                                            <form action="" id="purchase-payment" method="post" onsubmit="return false;">
                                                <div class="form-group">
                                                    <label for="payment-type">Select Payment Method</label>
                                                    <select class="form-control payment-type" name="payment-type">
                                                        <option value="">Please select</option>
                                                        <option value="Check">Check</option>
                                                        <option value="Hand Cash">Hand Cash</option>
                                                        <option value="Bkash">Bkash</option>
                                                        <option value="Rocket">Rocket</option>
                                                        <option value="Bank">Bank</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-nf-email">Payment Price</label>
                                                    <input name="" id="" class="form-control payment-price">
                                                </div>

                                                <div class="form-group">
                                                    <label for="example-nf-email">Payment Description</label>
                                                    <textarea name="" cols="30" rows="3" class="form-control payment-description"></textarea>
                                                </div>Purchase

                                                <div class="form-group float-right">
                                                    <button type="button" class="btn btn-alt-primary payment-button">Add Payment</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center" colspan="5">
                                            <button type="button" class="btn btn-alt-primary btn-rounded btn-noborder btn-lg btn-block end-purchase" data-toggle="click-ripple">
                                                <i class="si si-bag"></i> Purchase
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table Full -->
            </div>

        </div>
    </div>
    <!-- END Page Content -->
@endsection
