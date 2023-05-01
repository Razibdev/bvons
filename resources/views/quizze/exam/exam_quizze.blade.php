@extends('layouts.pagemain')

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
    <div class="content">
        <div class="my-50">
            <h2 class="font-w700 text-black mb-10">View Quizze Exam</h2>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-content block-content-full">
                        <table class="table table-bordered" id="dealer-product-stock-active">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exam Title</th>
                                <th>Exam Date</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Question</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->id}}</td>
                                    <td>{{$exam->exam_title}}</td>
                                    <td>{{$exam->exam_date}}</td>
                                    <td>{{$exam->start_time}}</td>
                                    <td>{{$exam->end_time}}</td>
                                    <td>{{$exam->duration}}</td>
                                    <td>
                                        <a href="{{route('user.quizze.exam.add.question', $exam->id)}}">Add Question</a> <br>
                                        <a href="{{route('user.quizze.exam.view.question', $exam->id)}}">View Question</a>
                                    </td>
                                    <td>
                                        <a href="{{route('user.quizze.edit.exam', $exam->id)}}">Edit</a>&nbsp
                                        &nbsp;<form
                                                action="{{route('user.quizze.exam.delete', $exam->id)}}" method="post"> {{csrf_field()}}
                                            <button style="border: none;" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
