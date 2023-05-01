@extends('layouts.pagemain')

@section('css_before')

@endsection

@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">Designation Monthly Salary History</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Date</th>
                                <th>Designation</th>
                                <th>Details</th>
                                <th>Bonus</th>
                                <th>Status</th>
                                <th>Monthly Salary</th>
                                <th>Admin Details</th>
                            </tr>
                            </thead>

                                <tr>
                                    <td>{{1}}</td>
                                    <td> @if($designation->user->type== 'MO') {{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                    <td>MO</td>
                                    <td>
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Package</th>
                                                <th>W-A</th>
                                                <th>W-B</th>
                                                <th>W-C</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Required</td>
                                                    <td>{{10}}</td>
                                                    <td>{{10}}</td>
                                                    <td>{{10}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Achievement</td>
                                                    <td>{{$designation->left_count}}</td>
                                                    <td>{{$designation->middle_count}}</td>
                                                    <td>{{$designation->right_count}}</td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                        $left_more = 10 - $designation->left_count;
                                                        $middle_more = 10 - $designation->middle_count;
                                                        $right_more = 10 - $designation->right_count;
                                                    ?>
                                                    <td>Needs More</td>
                                                    <td>@if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif</td>
                                                    <td> @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif</td>
                                                    <td> @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>Bvon Bag</td>
                                    <td>
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>

                                        @else
                                            <p>Waiting For Achievement</p>

                                        @endif
                                    </td>
                                    <td>@if($designation->user->type == 'MO') {{"N/A"}} @endif </td>
                                    <td>@if(isset($status->MO)) {{$status->MO}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{2}}</td>
                                <td>@if($designation->user->type == 'SMO'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>SMO</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{30}}</td>
                                            <td>{{30}}</td>
                                            <td>{{30}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count >10) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 10) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 10) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 30 - $designation->left_count;
                                            $middle_more = 30 - $designation->middle_count;
                                            $right_more = 30 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >10) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 10)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 10) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Business Tour / 5000 tk</td>
                                <td>
                                    @if($designation->left_count >10 || $designation->middle_count > 10 || $designation->right_count > 10)
                                    @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                        <p>Congratulations</p>

                                    @else
                                        <p>Waiting For Achievement</p>
                                    @endif
                                        @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'SMO') <a href="{{url('/user/history/salary/designation/'.$designation->user->type)}}">Salary</a> @else {{'N/A'}} @endif </td>
                                <td>@if(isset($status->SMO)) {{$status->SMO}} @endif</td>
                            </tr>

                                <tr>
                                <td>{{3}}</td>
                                <td>@if($designation->user->type == 'MEx'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>MEx</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{150}}</td>
                                            <td>{{150}}</td>
                                            <td>{{150}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count >30) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 30) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 30) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 150 - $designation->left_count;
                                            $middle_more = 150 - $designation->middle_count;
                                            $right_more = 150 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >30) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 30)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 30) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Business Tour / 10,000 tk</td>
                                <td>
                                    @if($designation->left_count >30 || $designation->middle_count > 30 || $designation->right_count > 30)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>

                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'MEx') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->Mex)) {{$status->Mex}} @endif</td>
                                </tr>


                                <tr>
                                <td>{{4}}</td>
                                <td>@if($designation->user->type == 'SMEx'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>SMEx</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{400}}</td>
                                            <td>{{400}}</td>
                                            <td>{{400}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count >150) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 150) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 150) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 400 - $designation->left_count;
                                            $middle_more = 400 - $designation->middle_count;
                                            $right_more = 400 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >150) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 150)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 150) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Mobile / 15,000 tk</td>
                                <td>
                                    @if($designation->left_count >150 || $designation->middle_count > 150 || $designation->right_count > 150)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'SMEx') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->SMex)) {{$status->SMex}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{5}}</td>
                                <td>@if($designation->user->type == 'RMM'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>RMM</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{1500}}</td>
                                            <td>{{1500}}</td>
                                            <td>{{1500}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count > 400) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 400) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 400) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 1500 - $designation->left_count;
                                            $middle_more = 1500 - $designation->middle_count;
                                            $right_more = 1500 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >400) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 400)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 400) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>India Tour</td>
                                <td>
                                    @if($designation->left_count >400 || $designation->middle_count > 400 || $designation->right_count > 400)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'RMM') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->RMM)) {{$status->RMM}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{6}}</td>
                                <td>@if($designation->user->type == 'MM'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>MM</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{4000}}</td>
                                            <td>{{4000}}</td>
                                            <td>{{4000}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count > 1500) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 1500) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 1500) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 4000 - $designation->left_count;
                                            $middle_more = 4000 - $designation->middle_count;
                                            $right_more = 4000 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >1500) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 1500)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 1500) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Laptop / 50,000</td>
                                <td>
                                    @if($designation->left_count >1500 || $designation->middle_count > 1500 || $designation->right_count > 1500)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'MM') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->MM)) {{$status->MM}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{7}}</td>
                                <td>@if($designation->user->type == 'SMM'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>SMM</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{20000}}</td>
                                            <td>{{20000}}</td>
                                            <td>{{20000}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count > 4000) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 4000) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 4000) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 20000 - $designation->left_count;
                                            $middle_more = 20000 - $designation->middle_count;
                                            $right_more = 20000 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >4000) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 4000)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 4000) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Bike / 150,000</td>
                                <td>
                                    @if($designation->left_count >4000 || $designation->middle_count > 4000 || $designation->right_count > 4000)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'SMM') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->SMM)) {{$status->SMM}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{8}}</td>
                                <td>@if($designation->user->type == 'AGM'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>AGM</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{40000}}</td>
                                            <td>{{40000}}</td>
                                            <td>{{40000}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count > 20000) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 20000) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 20000) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 40000 - $designation->left_count;
                                            $middle_more = 40000 - $designation->middle_count;
                                            $right_more = 40000 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >20000) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 20000)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 20000) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Car / 15,00,000</td>
                                <td>
                                    @if($designation->left_count >20000 || $designation->middle_count > 20000 || $designation->right_count > 20000)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'AGM') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                    <td>@if(isset($status->AGM)) {{$status->AGM}} @endif</td>

                                </tr>

                                <tr>
                                <td>{{9}}</td>
                                <td>@if($designation->user->type == 'GM'){{$designation->user->designation_active_date}} @else {{'N/A'}} @endif</td>
                                <td>GM</td>
                                <td>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Package</th>
                                            <th>W-A</th>
                                            <th>W-B</th>
                                            <th>W-C</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Required</td>
                                            <td>{{60000}}</td>
                                            <td>{{60000}}</td>
                                            <td>{{60000}}</td>
                                        </tr>
                                        <tr>
                                            <td>Achievement</td>
                                            <td>@if($designation->left_count > 40000) {{$designation->left_count}} @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 40000) {{$designation->middle_count}} @else {{'N/A'}} @endif</td>
                                            <td>@if($designation->right_count > 40000) {{$designation->right_count}} @else {{'N/A'}} @endif</td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $left_more = 60000 - $designation->left_count;
                                            $middle_more = 60000 - $designation->middle_count;
                                            $right_more = 60000 - $designation->right_count;
                                            ?>
                                            <td>Needs More</td>
                                            <td>@if($designation->left_count >40000) @if($left_more <= 0) {{'Done'}} @else {{$left_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->middle_count > 40000)  @if($middle_more <= 0) {{'Done'}} @else {{$middle_more}} @endif @else {{'N/A'}} @endif</td>
                                            <td> @if($designation->right_count > 40000) @if($right_more <= 0) {{'Done'}} @else {{$right_more}} @endif @else {{'N/A'}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>Flat / 50,00,000</td>
                                <td>
                                    @if($designation->left_count >40000 || $designation->middle_count > 40000 || $designation->right_count > 40000)
                                        @if($left_more <= 0 && $middle_more <= 0 && $right_more <= 0)
                                            <p>Congratulations</p>
                                        @else
                                            <p>Waiting For Achievement</p>
                                        @endif
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td>@if($designation->user->type == 'GM') <a href="#">Salary</a> @else {{'N/A'}} @endif </td>
                                <td>@if(isset($status->GM)) {{$status->GM}} @endif</td>
                                </tr>

                            <tbody>

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

