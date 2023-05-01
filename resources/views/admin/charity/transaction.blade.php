@extends('ecommerce.eco_layout.main')

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
        $(function() {
            $('#dealer-product-stock-active').DataTable();
        });


    </script>


@endsection

@section('content')
    <!-- Page Content -->
    <div class="main-wrapper">
        <div class="container-fluid">

            <div class="mt-5">
                <br><br>
                <h2 class="font-w700 text-black mb-10">Charity</h2>
                <br>
            </div>

            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-12 col-lg-12">
                    <div class="border">
                        <div class="block-content block-content-full">
                            <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                                <thead  style="height: 50px;">
                                <tr >
                                    <th>ID</th>
                                    <th>Donor Name</th>
                                    <th>Contact</th>
                                    <th>Account</th>
                                    <th>Event Name</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody style="width: 100% !important; text-align: center">
                                <?php $i = 1; $total = 0; ?>
                                @foreach($transactions as $transaction)

                                    <tr style="height: 40px;">
                                        <td>{{$i}}</td>
                                        <td>{{$transaction->user->name}}</td>
                                        <td>{{$transaction->user->phone}}</td>
                                        <td>{{$transaction->user->referral_id}}</td>
                                        <td>{{$transaction->event->event_name}}</td>
                                        <td>{{$transaction->event->address}}</td>
                                        <td>{{$transaction->amount}}</td>

                                    </tr>

                                    <?php $i++; $total += $transaction->amount; ?>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right" colspan="6">Total</td>
                                    <td>{{$total}}</td>
                                </tr>
                                </tfoot>
                            </table>
                            <br><br>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
