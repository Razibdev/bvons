@extends('layouts.dealer')

@section('css_before')
@endsection

@section('css_after')
    <style>
        *[contenteditable]:focus {
            color: deepskyblue;
            font-size: 16px;
        }
    </style>
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $('#dealer-product-stock').DataTable();
        });


    </script>


@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User List</h2>

        <!-- Dynamic Table Full -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <small>All User</small>
                </h3>
            </div>
            <div class="block-content block-content-full">
                <table class="table table-bordered" id="dealer-product-stock">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($all_stocks as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            {{--<td> @if($product->product != '') {{ $product->product->product_name}} @endif</td>--}}
                            <td>{{substr($product->message, 0, -19)}}</td>
                            <td>{{$product->quantity}}</td>
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

























