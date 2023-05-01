<?php
    $ssc = \App\BLearningCategory::where('type', 'S.S.C')->get();
    $hsc = \App\BLearningCategory::where('type', 'H.S.C')->get();
    $admissions = \App\BLearningCategory::where('type', 'Admission')->get();
    $jobs = \App\BLearningCategory::where('type', 'Job')->get();
    $skills = \App\BLearningCategory::where('type', 'Skills')->get();
?>

<header>
    <div class="container">
        <input type="checkbox" name="" id="check">

        <div class="logo-container">
            <h3 class="logo"><a style="color: #fff;" href="{{url('/b_learning_school')}}">Brand<span>Name</span></a></h3>
        </div>

        <div class="nav-btn">


            <div class="nav-links">
                <ul>
                    <li class="nav-link" style="--i: .85s">
                        <a href="#">S.S.C<i class="fas fa-caret-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                @foreach($ssc as $s)
                                <li class="dropdown-link">
                                    <a href="{{url('/blearning/'.$s->url)}}">{{$s->name}}</a>
                                </li>
                                @endforeach

                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-link" style="--i: .85s">
                        <a href="#">H.S.C<i class="fas fa-caret-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                @foreach($hsc as $h)
                                <li class="dropdown-link">
                                    <a href="{{url('/blearning/'.$h->url)}}">{{$h->name}}</a>
                                </li>
                               @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-link" style="--i: 1.1s">
                        <a href="#">Adminssion<i class="fas fa-caret-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                @foreach($admissions as $admission)
                                    <li class="dropdown-link">
                                        <a href="{{url('/blearning/'.$admission->url)}}">{{$admission->name}}</a>
                                    </li>
                                @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-link" style="--i: 1.35s">
                        <a href="#">Job</a>

                        <div class="dropdown">
                            <ul>
                                @foreach($jobs as $job)
                                    <li class="dropdown-link">
                                        <a href="{{url('/blearning/'.$job->url)}}">{{$job->name}}</a>
                                    </li>
                                @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-link" style="--i: 1.35s">
                        <a href="#">Skills</a>

                        <div class="dropdown">
                            <ul>
                                @foreach($skills as $skill)
                                    <li class="dropdown-link">
                                        <a href="{{url('/blearning/'.$skill->url)}}">{{$skill->name}}</a>
                                    </li>
                                @endforeach
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="form-group" id="menu-search-bar">
                <input type="text" name="search_bar" id="search_bar" class="search_bar" placeholder="Search Here.....">
            </div>



            <div class="log-sign" style="--i: 1.8s">
                <a href="#" class="btn transparent search-btn-menu" ><button type="submit" ><i class="fas fa-search"></i></button></a>
            </div>

            <div class="log-sign" style="--i: 1.8s">
                <a href="#" class="show-login btn " ><button type="submit" >Login</button></a>
            </div>
        </div>



        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>