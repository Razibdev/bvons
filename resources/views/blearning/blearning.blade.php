@extends('layouts.main_b_learning')
@section('content')
<main>
    <div class="main-wrapper">
        <div class="wrapper">
            <h4><span>Experience</span>  Better Learning.</h4>
            <p>{!! $course->course_description !!}</p>
        </div>
        <div class="wrapper">
            <a href="{{url('/b_learning_schools/'.$course->course_url)}}">
                <img src="{{asset('media/blearning/course/image/'.$course->id.'/'.$course->cover_image)}}" alt="">
            </a>
        </div>
    </div>


    <div class="second-wrapper">
        <div class="title">
            <h3>Recent Top Course</h3>
        </div>
        @foreach($courses as $course)
        <div class="wrapper">
            <a href="{{url('/b_learning_schools/'.$course->course_url)}}">
                <img src="{{asset('media/blearning/course/image/'.$course->id.'/'.$course->cover_image)}}" alt="">
            </a>
        </div>
        @endforeach

    </div>
</main>

@endsection