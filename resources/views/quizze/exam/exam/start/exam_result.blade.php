@extends('layouts.front_layout.front_layout')

@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };


        $(document).ready(function() {
            function disableBack() { window.history.forward() }

            window.onload = disableBack();
            window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
        });


    </script>

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

        .complain{
            background: transparent;
            width: 100%;
            height: auto;
            background: darkgoldenrod;
            position: relative;
        }

        .complain_wrapper{
            position:absolute;
            left: 203px;
            top: 153px;
            transform: translate(-50%, -50%);


        }
        .complain_wrapper{
            display: none;
            background: #fff;
            width: 400px;
            padding:30px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
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
                                    <h4 class="text-center">{{$exam->exam_title}}</h4>
                                    <span>{{$rightcount}} / {{$countQuestion}}</span>
                                </div>
                            </div>

                            @foreach($questions as $key => $question)
                                <div class="question bg-white p-3 border-bottom">
                                    <div class="d-flex flex-row align-items-center question-title">
                                        <h3 class="text-danger">Q.</h3>
                                        <h5 class="mt-1 ml-2">{{$question->question_name}}</h5>
                                        <input type="hidden" name="question_id{{$key}}" value="{{$question->id}}">
                                    </div>
                                    @if($question->type == 'mcq')
                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option1 == $question->answers) checked @endif type="radio" id="r" name="answer{{$key}}" value="{{$question->option1}}"> <span>{{$question->option1}}</span>
                                            </label>
                                        </div>
                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option2 == $question->answers) checked @endif  type="radio" id="r" name="answer{{$key}}" value="{{$question->option2}}"> <span>{{$question->option2}}</span>
                                            </label>
                                        </div>
                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option3 == $question->answers) checked @endif  type="radio" id="r" name="answer{{$key}}" value="{{$question->option3}}"> <span>{{$question->option3}}</span>
                                            </label>
                                        </div>
                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option4 == $question->answers) checked @endif  type="radio" id="r" name="answer{{$key}}" value="{{$question->option4}}"> <span>{{$question->option4}}</span>
                                            </label>
                                        </div>

                                        <div class="ans ml-2">
                                            <label class="radio">Right Answer: <span>{{$question->answer}}</span>
                                            </label>
                                        </div>

                                        <div class="ml-2">
                                            <br>
                                            @if($question->node != null)
                                                <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                            @endif
                                            <p class="complain" style=" display: inline; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; background: #d1d1d1; cursor: pointer;" data-id="{{$question->id}}">Complain</p>

                                        </div>

                                    @elseif($question->type == 'boolean')

                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option1 == $question->answers) checked @endif  type="radio" id="r" name="answer{{$key}}" value="{{$question->option1}}"> <span>{{$question->option1}}</span>
                                            </label>
                                        </div>
                                        <div class="ans ml-2">
                                            <label class="radio"> <input @if($question->option2 == $question->answers) checked @endif  type="radio" id="r" name="answer{{$key}}" value="{{$question->option2}}"> <span>{{$question->option2}}</span>
                                            </label>
                                        </div>

                                        <div class="ans ml-2">
                                            <label class="radio">Right Answer: <span>{{$question->answer}}</span>
                                            </label>
                                        </div>

                                        <div class="ml-2">
                                            <br>
                                            @if($question->node != null)
                                                <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                            @endif
                                            <p class="complain" style=" display: inline; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; background: #d1d1d1; cursor: pointer;" data-id="{{$question->id}}">Complain</p>

                                        </div>

                                    @elseif($question->type == 'written')

                                        <div class="ans ml-2">
                                            <label><input class="form-control" value="{{$question->answers}}" id="written{{$question->id}}" type="text" name="answer{{$key}}" placeholder="Enter Right Answer">
                                            </label>
                                        </div>

                                        <div class="ans ml-2">
                                            <label class="radio">Right Answer: <span>{{$question->answer}}</span>
                                            </label>
                                        </div>

                                        <div class="ml-2">
                                            <br>
                                            @if($question->node != null)
                                                <p style="color: #6c757d;" class="text-muted">Note: {{$question->node}}</p>
                                            @endif
                                            <p class="complain" style=" display: inline; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; background: #d1d1d1; cursor: pointer;" data-id="{{$question->id}}">Complain</p>

                                        </div>

                                    @endif

                                    <div class="complain">
                                        <div class="complain_wrapper" id="complain_wrapper{{$question->id}}">
                                            <p style="display: inline; float: left;">Complain Box </p>
                                            <p onclick="closeComplain();" style="float: right; display: inline; cursor: pointer;"><i class="fas fa-times"></i></p>
                                            <div class="form-group">
                                                <textarea name="complain" id="complain{{$question->id}}" cols="40" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <p class="complainSubmit" data-exam_id ="{{$exam->id}}" data-id="{{$question->question_id}}" data-receiver="{{$question->user_id}}" style=" display: inline; padding: 10px; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; background: #d1d1d1; cursor: pointer;">Submit</p>
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>

                                </div>



                            @endforeach


                        </div>
                </div>
            </div>
        </div>
    </main>
    <br><br>

@endsection

@push("js")

    <script>
        $('.complainSubmit').on('click', function () {
            alert('ok');
            var id = $(this).data("id");
            var message = $('#complain'+id).val();
            var receiver = $(this).data("receiver");
            var exam_id = $(this).data("exam_id");

            $.ajax({
                url: "{{url('/bvon/quizze/start/question/complain/submit')}}",
                method: "get",
                data:{'id':id, 'message':message, 'receiver':receiver, "_token": "{{ csrf_token() }}"},
                success:function () {
                    console.log('ok');
                    window.location = '/bvon/quizze/start/exam/start/ok/thanks/'+exam_id;
                }
            });

        });
    </script>

    <script>
        $('.complain').on('click', function () {
            var  id = $(this).data("id");
            $('#complain_wrapper'+id).toggle();
        });

        function closeComplain() {
            $('.complain_wrapper').css('display', 'none');
        }
    </script>

@endpush