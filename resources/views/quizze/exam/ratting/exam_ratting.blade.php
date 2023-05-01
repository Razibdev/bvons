@extends('layouts.front_layout.front_layout')
<?php
use App\Model\AttendExam;
use Carbon\Carbon;

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
            <h2 class="font-w700 text-black mb-10">View Quizze Exam</h2>
            <br>
        </div>

            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-10 col-lg-10">
                <div class="border">
                    <div class="block-content block-content-full">
                        <table style="width: 100% !important; margin-top: 10px; margin-bottom: 10px " class="table table-striped table-bordered">
                            <thead  style="height: 50px;">
                            <tr >
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Exam Date</th>
                                <th>Examinee</th>
                                <th>Question</th>
                                <th>Own Details</th>
                                <th>Ranking</th>
                            </tr>
                            </thead>
                            <tbody style="width: 100% !important; text-align: center">
                            @foreach($exams as $exam)

                                <?php
                                    $totalExaminee = AttendExam::where('exam_id', $exam->id)->count();
                                    $end =  $exam->end_time ;
                                    $hours = $end->format('h');
                                    $min = $end->format('i');
                                    $sec = $end->format('s');

                                    $date = $exam->exam_date;
                                    $y = $date->format('Y');
                                    $m = $date->format('m');
                                    $d = $date->format('d');
                                    $dt = date('Y-m-d H:i:s');
                                $oldDate = Carbon::create($y, $m, $d, $hours, $min, $sec);
                                ?>

                                @if($oldDate <= $dt)
                                <tr style="height: 40px;">
                                    <td>{{$exam->id}}</td>
                                    <td>{{$exam->exam_title}}</td>
                                    <td>{{$exam->exam_date}}</td>
                                    <td>{{$totalExaminee}}</td>
                                    <td> <a href="{{route('bvon.quizze.start.exam.ratting.question', $exam->id)}}">View Question</a></td>
                                    <td>
                                        @if(count($exam->attend) > 0)
                                        @foreach($exam->attend as $attend)
                                            @if($attend->user_id == Auth::id())
                                                <a href="{{url('/bvon/quizze/start/exam/start/ok/thanks', $exam->id)}}">Own Details</a>
                                            @endif
                                       @endforeach
                                        @else
                                            <a href="#">Not Attend Exam</a>

                                        @endif
                                    </td>
                                    <td>
                                        @if(count($exam->attend) > 0)
                                        <a href="{{url('/bvon/quizze/start/exam/ratting/user', $exam->id)}}">Ranking</a>
                                        @else
                                            <a href="#">N/A</a>

                                        @endif

                                    </td>

                                </tr>
                                    @endif
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
