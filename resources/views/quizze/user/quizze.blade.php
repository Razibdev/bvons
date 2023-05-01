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
        <div class="mt-5">
            <div class="d-flex justify-content-center row">
                <div class="col-4 col-sm-4 col-md-10 col-lg-10">
                    <div class="border">
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4>Bvon Quiz</h4>
                                <span><a href="{{url('/bvon/quizze/start/exam/ratting/gquizze')}}">G Quizze Ranking</a></span>
                                <span><a href="{{url('/bvon/quizze/start/exam/ratting/')}}">Exam Quizze Ranking</a></span>
                                <span><a style="text-decoration: none; color: #0a1520; "  href="{{route('bvon.quizze.start.exam')}}">If You want to attend quizze exam</a></span>
                            </div>
                        </div>

                        @foreach($questions as $question)
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row align-items-center question-title">
                                <h3 class="text-danger">Q.</h3>
                                <h5 class="mt-1 ml-2">{{$question->question_name}}</h5>
                                <input type="hidden" name="question_id" value="{{$question->id}}">
                            </div>
                            @if($question->type == 'mcq')
                            <div class="ans ml-2">
                                <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option1}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option1}}"> <span>{{$question->option1}}</span>
                                </label>
                            </div>
                            <div class="ans ml-2">
                                <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option2}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option2}}"> <span>{{$question->option2}}</span>
                                </label>
                            </div>
                            <div class="ans ml-2">
                                <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option3}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option3}}"> <span>{{$question->option3}}</span>
                                </label>
                            </div>
                            <div class="ans ml-2">
                                <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option4}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option4}}"> <span>{{$question->option4}}</span>
                                </label>
                            </div>
                                <div class="ml-2">
                                    <br>
                                    @if($question->node != null)
                                    <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                    @endif
                                </div>
                            @elseif($question->type == 'boolean')

                                <div class="ans ml-2">
                                    <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option1}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option1}}"> <span>{{$question->option1}}</span>
                                    </label>
                                </div>
                                <div class="ans ml-2">
                                    <label class="right_answer radio" data-id="{{$question->id}}" data-ans="{{$question->option2}}" data-type="{{$question->type}}"> <input type="radio" name="answer" value="{{$question->option2}}"> <span>{{$question->option2}}</span>
                                    </label>
                                </div>

                                <div class="ml-2">
                                    <br>
                                    @if($question->node != null)
                                        <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                    @endif
                                </div>

                                @elseif($question->type == 'written')

                                <div class="ans ml-2">
                                    <label class="right_answer" data-id="{{$question->id}}" data-ans="{{$question->option1}}" data-type="{{$question->type}}"> <input class="form-control" id="written{{$question->id}}" type="text" name="answer" placeholder="Enter Right Answer">
                                    </label>
                                </div>

                                <div class="ml-2">
                                    <br>
                                    @if($question->node != null)
                                        <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                    @endif
                                </div>

                            @endif
                            <br><br>

                        </div>

                            <script>
                                // $(document).ready(function () {
                                //    alert('ok');
                                // });
                                $(function () {
                                    var exes = '{{$question->duration}}';
                                    var exe = exes * 1000;
                                    setInterval(function() {
                                        window.location = '/bvon/quizze/start';
                                    }, exe);
                                    // alert(exes)
                                }).jQuery();
                            </script>
                        @endforeach

                    </div>
                </div>
            </div>
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
                            method: "get",
                            data:{'id':id, 'ans':ans, 'type':type, "_token": "{{ csrf_token() }}"},
                            success:function () {
                                console.log('ok');
                                window.location = '/bvon/quizze/start';
                            }
                        });

                    });

                }else{
                    var ans = $(this).data("ans");

                    $.ajax({
                        url: "{{url('/bvon/quizze/start/submit')}}",
                        method: "get",
                        data:{'id':id, 'ans':ans, 'type':type, "_token": "{{ csrf_token() }}"},
                        success:function () {
                            console.log('ok');
                            window.location = '/bvon/quizze/start';
                        }
                    });

                }

            });
        });
    </script>
@endpush