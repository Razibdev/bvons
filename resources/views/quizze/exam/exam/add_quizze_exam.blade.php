@extends('layouts.front_layout.front_layout')

@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
            background-color: #eee
        }

        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            padding: 4px 0px;
            border: 1px solid red;
            display: inline-block;
            color: red;
            width: 100px;
            text-align: center;
            border-radius: 3px;
            margin-top: 7px;
            text-transform: uppercase
        }

        label.radio input:checked+span {
            border-color: red;
            background-color: red;
            color: #fff
        }

        .ans {
            margin-left: 36px !important
        }

        .btn:focus {
            outline: 0 !important;
            box-shadow: none !important
        }

        .btn:active {
            outline: 0 !important;
            box-shadow: none !important
        }
        .search-form{
            position: absolute;
        }

        .nav2{
            overflow: hidden;
        }
    </style>

@endpush
@section('content')
    <main class="main-wrapper">
       <div class="m-5">
        <ul class="list-group">
            @foreach($exams as $key => $exam)
                <?php

                $start = $exam->start_time;
                $end =$exam->end_time;
                $between =   $start <= date('Y-m-d H:i:s') && $end >=  date('Y-m-d H:i:s');

                ?>
            <div class="list-group-item @if($key %2 == 0) list-group-item-primary @else list-group-item-success @endif ">{{$exam->exam_title}} &nbsp; @if(isset($exam->exam_date) && $exam->exam_date != null) Date: {{$exam->exam_date}} &nbsp; @endif @if(isset($exam->start_time) && $exam->start_time != null) Start: {{$exam->start_time->format('h:i A')}} &nbsp; @endif @if(isset($exam->duration) && $exam->duration != null) Duration: {{$exam->duration}} Min &nbsp; @endif @if(isset($exam->exam_free) && $exam->exam_free != 0) Free: {{$exam->exam_free}} tk @endif

                    @if($exam->user_id != Auth::id() && $exam->exam_id == null) @if($exam->end_time >=  date('Y-m-d H:i:s')) <button class="btn @if($key %2 == 0) btn-primary @else btn-success @endif btn-sm exam_submit_now" style="float: right" data-id="{{$exam->id}}" data-free="{{$exam->exam_free}}"  >Attend</button> @else <button class="btn btn-warning" style="float: right;" >Exam Finish</button> @endif @endif
                    @if($exam->user_id == Auth::id() && $exam->exam_id != null)
                    @if($exam->start_time == null || $exam->end_time == null)
                        <a style="text-decoration: none; float: right;" href="{{url('/bvon/quizze/start/exam/start/'.$exam->id)}}">Start Exam</a>
                    @else
                        @if($between)
                        <a style="text-decoration: none; float: right;" href="{{url('/bvon/quizze/start/exam/start/'.$exam->id)}}">Start Exam</a>
                        @elseif($exam->end_time <= date('Y-m-d H:i:s'))
                            <a style="text-decoration: none; float: right; color:#ff8a65;" href="#">Exam Finished</a>
                         @else
                        <a style="text-decoration: none; float: right; color: #000;" href="#">Exam Not Start</a>
                        @endif
                     @endif
                @endif


                    </div>
                    <br>

        @endforeach
        </ul>
       </div>
    </main>
    <br><br>
    {{--<div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white"><button class="btn btn-primary d-flex align-items-center btn-danger" type="button"><i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button><button class="btn btn-primary border-success align-items-center btn-success" type="button">Next<i class="fa fa-angle-right ml-2"></i></button></div>--}}

@endsection

@push("js")

    <script>
        $(document).ready(function () {
            $('.right_answer').on('click', function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                var type = $(this).data('type');
                if(type == 'written'){
                    $("#written"+id).on('blur', function () {
                        var ans = $("#written"+id).val();
                        $.ajax({
                            url: "{{url('/bvon/quizze/start/submit')}}",
                            method: "post",
                            data:{'id':id, 'ans':ans, 'type':type, "_token": "{{ csrf_token() }}"},
                            success:function () {
                                window.location = '/bvon/quizze/start';
                            }
                        });

                    });

                }else{
                    var ans = $(this).data("ans");

                    $.ajax({
                        url: "{{url('/bvon/quizze/start/submit')}}",
                        method: "post",
                        data:{'id':id, 'ans':ans, 'type':type, "_token": "{{ csrf_token() }}"},
                        success:function () {
                            window.location = '/bvon/quizze/start';
                        }
                    });

                }

            });




            $('.exam_submit_now').on('click', function (e){
               e.preventDefault();
                var id = $(this).data("id");
                var free = $(this).data("free");
                $.ajax({
                    url: "{{url('/bvon/quizze/start/exam/free')}}",
                    method: "post",
                    data:{'id':id, 'free':free, "_token": "{{ csrf_token() }}"},
                    success:function (message) {
                        alert(message.message);
                        window.location = '/bvon/quizze/start/exam/';
                    }
                });
            });



        });
    </script>
@endpush