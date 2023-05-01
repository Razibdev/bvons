@extends('layouts.front_layout.front_layout')
<?php
    use App\Model\QuizzeAnswer;
?>
@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div class="container-lg">

            <div class="mt-5">
                <br><br>
                <h2 class="font-w700 text-black mb-10">View Quizze Exam Question</h2>
                <br>
            </div>

            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-10 col-lg-10">
                    <div class="border">
                        <div class="block-content block-content-full">
                            <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                                <thead  style="height: 50px;">
                                <tr >
                                    <th>Rank ID</th>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>Total Marks</th>
                                    <th>Right</th>
                                    <th>Wrong</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody style="width: 100% !important; text-align: center">
                                <?php $i = 1; ?>
                                @foreach($ansers as $ans)

                                    <?php
//                                        $rank = QuizzeAnswer::where('user_id', $ans->user_id)->where('exam_id', $ans->exam_id)->count();
                                        $rankget = QuizzeAnswer::where('user_id', $ans->user_id)->where('exam_id', $ans->exam_id)->get();
                                        $count = 0;
                                        $fcount = 0;
                                        foreach ($rankget as $item) {
                                            if($item->answers == $item->right_answers){
                                                $count++;
                                                }else{
                                                $fcount++;
                                            }
                                            }
//                                        echo $fcount." ".$rank."<br>";

//                                        echo $rank."<br>";
                                    ?>

                                    <tr style="height: 40px; border-bottom: 1px solid #000;">
                                        <td>{{$i}}</td>
                                        <td>{{$ans->user->name}}</td>
                                        <td>{{$ans->user->referral_id}}</td>
                                        <td>{{$count}}</td>
                                        <td>{{$count}}</td>
                                        <td>{{$fcount}}</td>
                                        <td>{{$ans->created_at}}</td>

                                    </tr>

                                    <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
