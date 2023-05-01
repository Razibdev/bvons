@extends('layouts.main_b_learning')
@push('css')
    <link rel="stylesheet" href="{{asset('blearning/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('blearning/css/slick-theme.css')}}">
@endpush
@section('content')
    <main>
        <div class="single-wrapper">
            <div class="wrapper">
                <div class="wrapper-single">
                    <h3>{{$course->course_name}}</h3>
                </div>
                <div class="wrapper-single">
                    <h3>Teacher</h3>
                    <div class="teacher-slider">
                        <div class="brand-slick-carousel">
                            @foreach($course->subjects as $subject)
                                @foreach($subject->teachers as $teacher)
                                    <div class="items">
                                        <img src="{{asset('media/blearning/teacher/image/'.$teacher->profile_image)}}">
                                        <h4>{{$teacher->teacher_name}}</h4>
                                        <h5>{{$teacher->university_name}}</h5>
                                    </div>
                                    @endforeach
                                @endforeach

                        </div>
                    </div>
                </div>

                <div class="wrapper-single">
                    <h3>About this course</h3>
                    <div class="about-course">
                        <p>{!! $course->course_description !!}</p>
                    </div>

                </div>

                <div class="wrapper-single">
                    <h3>Course Content</h3>

                    @foreach($course->subjects as $subject)
                    <div class="collapse-single">
                        <input type="checkbox" name="c" id="c-{{$subject->id}}">
                        <label for="c-{{$subject->id}}" class="btn"><span>{{$subject->subject_name}}</span> <span class="sign" id="d-{{$subject->id}}"></span></label>

                        <div class="content">
                            <div class="scroll-content">
                                <p>{!! $subject->subject_description !!}</p>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>


            </div>

            <div class="wrapper">
                <div class="banner">
                    <img src="{{asset('/media/blearning/course/image/'.$course->id.'/'.$course->cover_image)}}" alt="">
                </div>

                <div class="facility">
                    <div class="item">
                        <i class="far fa-clock "></i>
                        <span>Live Class</span>
                        <span>{{$course->live_class}}</span>
                    </div>


                    <div class="item">
                        <i class="fas fa-users"></i>
                        <span>Enrolled</span>
                        <span>1568 Students</span>
                    </div>


                    <div class="item">
                        <i class="fas fa-swimming-pool"></i>
                        <span>Suggestion</span>
                        <span>Yes</span>
                    </div>
                </div>


                <div class="tags_column" style="padding-left: 20px; text-align: justify">
                    {!! \Illuminate\Support\Str::limit($course->course_feature, 270) !!}
                </div>


                <div class="buy-form">
                    <p>প্রোমো কোড ব্যবহার করতে লগ-ইন করুন</p>
                    <p> @if($course->current_price != '' || $course->current_price != null) <del>৳ {{$course->course_price}}</del> ৳ {{$course->current_price}} @else ৳ {{$course->course_price}} @endif <button type="submit">Get This Course</button></p>
                    <p>For any problem: 0961-200-1010 (10AM – 10PM) or send SMS 10MSHelp to</p>
                </div>



            </div>
        </div>
    </main>
@endsection

@push('js')
    <script src="{{asset('blearning/js/slick.min.js')}}"></script>
    <script src="{{asset('blearning/js/main.js')}}"></script>
    <script>
        $('.brand-slick-carousel').slick({
            dots: true,
            infinite: true,
            autoplay: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>
@endpush
