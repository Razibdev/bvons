@extends('layouts.backend')

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

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection


@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading">User Cash Back Transaction</h2>

        <!-- Dynamic Table Full -->
        <div class="row">
{{--            user Cash back list--}}
            <div class="col-md-7">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <small>User Cash Back List</small>
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                        <table class="table table-bordered table-vcenter datatable-user-list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_wallet as $single_user_wallet)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $single_user_wallet->created_at->format('d/m/y h:i a') }}</td>
                                    <td>{{ $single_user_wallet->product_name }}</td>
                                    <td>{{ $single_user_wallet->type }}</td>
                                    <td>{{ $single_user_wallet->amount }}</td>
                                    {{--<td>{{ $single_user_wallet-> }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('bf.user.details', ['user' => $single_user_wallet->id]) }}" class="btn btn-alt-primary cu-popover" data-content="See Details" data-placement="top">
                                            <i class="si si-info"></i>
                                        </a>
                                    </td>--}}
                                </tr>

                            @endforeach
                                <tr>
                                    <th colspan="3" style="text-align: right">Total</th>
                                    <td colspan="3">{{
                                            ($user_wallet->filter(function($single_t) { return $single_t->type === 'c'; })->pluck('amount')->sum())
                                            - ($user_wallet->filter(function($single_t) { return $single_t->type === 'd'; })->pluck('amount')->sum())
                                        }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
{{-- user cash back form--}}
            <div class="col-md-5">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <small>Increase or Decrease Cash Back</small>
                        </h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('create_cashback_wallet', ['user' => $user->id]) }}" method="post">
                            @csrf
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Product Name</th>
                                    <td>
                                        <input type="text" name="product_name" id="" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount Type</th>
                                    <td>
                                        <select name="type" id="" class="form-control">
                                            <option value="c">Increase (+)</option>
                                            <option value="d">Decrease (-)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>
                                        <input type="text" name="amount" id="" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>
                                        <textarea type="text" name="message" id="" class="form-control" required></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-success" onclick="confirm('Are you Sure?')">Submit</button>
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- END Dynamic Table Full -->
    </div>
    <!-- END Page Content -->
@endsection
