@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Designation Salary History</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Designation Salary History</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Designation Salary History</h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Designation</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1; $total = 0; @endphp
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$type}}</td>
                                        <td>{{$transaction->message}}</td>
                                        <td>{{$transaction->created_at->format('d-m-Y')}}</td>
                                        <td>{{$transaction->amount}}</td>
                                        <?php $total += $transaction->amount ?>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td>@if($total != 0){{$total}} @endif</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection


@section('js_after')

@endsection

