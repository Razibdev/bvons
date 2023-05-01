@extends('layouts.pagemain')
<?php
use App\Modal\CommissionRelation;
use App\Model\Matrix;
use App\Model\MachHistory;
use App\Model\Maching;

?>
@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">

        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">Designation Transaction History</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
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
    <!-- END Page Content -->
@endsection


@section('js_after')

@endsection

