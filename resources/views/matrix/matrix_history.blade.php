@extends('ecommerce.eco_layout.main')

@section('css_before')

@endsection
<?php
use App\Modal\CommissionRelation;
use App\Model\Matrix;
use App\Model\MachHistory;
use App\Model\Maching;

?>

@section('content')

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Matrix Down Line</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Matrix Down Line</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->



        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Matrix Daily Performance History</h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>Designation</th>
                                    <th>Date</th>
                                    <th width="30%" style="text-align: center">
                                        Position
                                    </th>

                                    <th>Match</th>
                                    <th>Per Match Bonus</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($allHistories as $histories)
                                    <?php
                                    $matrix = Matrix::where('user_id', $histories->id)->first();
                                    $left_position = MachHistory::where('user_id', $histories->id)->pluck('left_position')->sum();
                                    $middle_position = MachHistory::where('user_id', $histories->id)->pluck('middle_position')->sum();
                                    $right_position = MachHistory::where('user_id', $histories->id)->pluck('right_position')->sum();
                                    $l_add_new = $matrix->left_count - $left_position;
                                    $m_add_new = $matrix->middle_count - $middle_position;
                                    $r_add_new = $matrix->right_count - $right_position;

                                    $maching = Maching::where('user_id', $histories->id)->first();
                                    $total_left = $maching->left_position + $l_add_new;
                                    $total_middle = $maching->middle_position + $m_add_new;
                                    $total_right = $maching->right_position + $r_add_new;

                                    if ($total_left >= $total_middle && $total_right >= $total_middle){
                                        $lmr = $total_middle;
                                    }else if($total_middle >= $total_left && $total_right >= $total_left){
                                        $lmr = $total_left;
                                    }else if($total_middle >= $total_right && $total_left >= $total_right){
                                        $lmr = $total_right;

                                    }
                                    ?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$histories->name}}</td>
                                    <td>{{$histories->referral_id}}</td>
                                    <td>{{$histories->type}}</td>
                                    <td>{{date('d-m-Y')}}</td>
                                    <td width="30%">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Option</th>
                                                <th>W-A</th>
                                                <th>W-B</th>
                                                <th>W-C</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Add</td>
                                                    <td>{{$l_add_new}}</td>
                                                    <td>{{$m_add_new}}</td>
                                                    <td>{{$r_add_new}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{$total_left}}</td>
                                                    <td>{{$total_middle}}</td>
                                                    <td>{{$total_right}}</td>
                                                </tr>
                                            <tr>
                                                <td>LeftOver</td>
                                                <td>{{$total_left - $lmr}}</td>
                                                <td>{{$total_middle - $lmr}}</td>
                                                <td>{{$total_right - $lmr}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>

                                    <td>{{$lmr}}</td>
                                    <td>1</td>
                                    <td>{{$lmr}}</td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Matrix All Performance History</h4>

                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>Designation</th>
                                    <th>Date</th>
                                    <th width="30%" style="text-align: center">
                                        Position
                                    </th>

                                    <th>Mach</th>
                                    <th>Match Limit</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($historiess as $histories)

                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$histories->user->name}}</td>
                                        <td>{{$histories->user->referral_id}}</td>
                                        <td>{{$histories->user->type}}</td>
                                        <td>{{$histories->created_at->format('d-m-Y')}}</td>
                                        <td width="30%">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>Option</th>
                                                    <th>W-A</th>
                                                    <th>W-B</th>
                                                    <th>W-C</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Add</td>
                                                    <td>{{$histories->l_add_new}}</td>
                                                    <td>{{$histories->m_add_new}}</td>
                                                    <td>{{$histories->r_add_new}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{$histories->total_left}}</td>
                                                    <td>{{$histories->total_middle}}</td>
                                                    <td>{{$histories->total_right}}</td>
                                                </tr>
                                                <tr>
                                                    <td>LeftOver</td>
                                                    <td>{{$histories->l_left_over}}</td>
                                                    <td>{{$histories->l_middle_over}}</td>
                                                    <td>{{$histories->l_right_over}}</td>
                                                </tr>
                                                </tbody>


                                            </table>
                                        </td>

                                        <td>{{$histories->minimum}}</td>
                                        <td>{{$histories->match_limit}}</td>
                                        <td>{{$histories->amount}}</td>
                                    </tr>
                                <?php $i++; ?>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td style="text-align: right" colspan="8">Total</td>
                                    <td>{{$allTransaction}}</td>
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
    <script>
        $('#myTable').DataTable( {
            // fixedColumns: true
        } );
    </script>
@endsection

