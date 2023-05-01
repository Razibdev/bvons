@extends('layouts.front_layout.front_layout')
@push('css')

    <style>
        .form-wrapper{
            background: transparent;
            width: 300px;
            height: auto;
            margin-top: 125px;
            margin-left: -100px;
        }

        .form-wrapper .wrappepost{
            position:absolute;
            transform: translate(-50%, -50%);
            display: none;
            background: #ddd;
            width: 400px;
            padding:10px;
            border-radius: 5px;
            box-shadow: 0 0 8px rgba(0, 0, 0, .1);
            z-index: 2;
        }

        .form-wrapper .wrappepost .form-group{
            width: 100%;
            padding:10px;
            overflow: hidden;
        }

        .form-wrapper .wrappepost .form-group.now{
            width: 100%;
        }

        .form-wrapper .wrappepost .form-group.now h3{
            width: 50%;
            float: left;
        }

        .form-wrapper .wrappepost .form-group.now h3:last-child span{
            width: 50%;
            float: right !important;
            margin-right: -77px;
            cursor: pointer;
        }

        .form-wrapper .wrappepost .form-group.now a span{
            float: right;
        }

        .form-wrapper .wrappepost .form-group textarea{
            width: 100%;
        }
        .form-wrapper .wrappepost .form-group button{
            border: none;
            width: 200px;
            height: 35px;
            cursor: pointer;
        }

    </style>

    <style>
        .profile-tab-body .about-main .single h5 input:focus{
            border: none !important;
            outline: none !important;
        }
        .profile-tab-body .about-main .single h5 input{
            border: none;
            width: 100%;
            height: 35px;
            text-align: center;

        }

        .profile-tab-body .about-main .single button{
            width: 150px;
            height: 35px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')

    <div class="main-profile">
        <div class="wrapper">
            <div class="caption">
                <img src="{{asset('media/user/cover_pic/'.Auth::id().'/'.Auth::user()->cover_pic)}}" alt="">
                <a href="#">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <div class="profile-cap">
                    <div class="single">
                        <img src="{{asset('media/user/profile_pic/'.Auth::id().'/'.Auth::user()->profile_pic)}}" alt="">
                    </div>
                    <div class="single">
                        <h3>{{ Str::limit(Auth::user()->name, 12) }}</h3>

                    </div>
                    <div class="single">
                        <i class="fas fa-check-circle"></i>

                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <div class="profile-tab">
                <div class="profile-tab-header">
                    <div class="active">
                        <i class="fas fa-paste"></i>
                        <h3>Post</h3>
                    </div>

                    <div>
                        <i class="fas fa-info"></i>
                        <h3>About</h3>
                    </div>


                    <div>
                        <i class="fas fa-user-friends"></i>
                        <h3>Follower</h3>
                    </div>

                    <div>
                        <i class="fas fa-user-friends"></i>
                        <h3>Following</h3>
                    </div>
                </div>

                <div class="profile-tab-indicator">

                </div>

                <div class="profile-tab-body">

                    <div class="active profilebgnow">

                        <div class="add-post-section">
                            <form action="{{url('/social-add-post-ok')}}" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    {{csrf_field()}}
                                    <textarea name="body" id="body" cols="30" rows="4" placeholder="What's on your mined"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" name="media" />
                                            <i class="fa fa-arrow-up"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit">Post</button>
                                </div>
                            </form>
                        </div>

                        <div class="search_user">
                            <form action="{{url('/search-user')}}" method="get"> {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="query" class="search_user_bind_ok" id="search" placeholder="Enter user name">
                                </div>
                                <div class="form-group">
                                    <button type="submit">Search</button>
                                </div>
                            </form>

                            <div class="center search_user_fetch_ok" >

                            </div>

                        </div>




                    @foreach($posts as $key => $post)

                            <div class="tbody-single">
                            <div class="title">
                                <div class="single">
                                    <img src=" @if(isset($post->user->profile_pic)){{asset('media/user/profile_pic/'.$post->user_id.'/'.$post->user->profile_pic)}} @endif " alt="">
                                </div>
                                <div class="single">
                                    <h3>@if(isset($post->user->name))  {{$post->user->name}} @endif</h3>
                                </div>
                                <div class="single">
                                    <img src="{{asset('frontend/image/download.png')}}" alt="">
                                </div>

                                <div class="single">
                                    <p class="three-dot" data-id="{{$post->id}}"><i class="fas fa-ellipsis-v"></i>

                                    </p>
                                    <div class="simple-work" id="post-simple-{{$post->id}}">
                                        <div class="work">
                                            <p  class="post-edit-now-social" data-id="{{$post->id}}" >Edit</p>
                                            <form action="{{ route('social.post.delete', $post->id) }}" method="POST">@csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>


                                    <div class="form-wrapper">
                                        <div class="wrappepost" id="wrapper-{{$post->id}}">
                                            <form action="{{url('/social-edit-post/'.$post->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                                <div class="form-group now">
                                                    <h3>Edit Post</h3>
                                                    <h3 href="#" onclick="myfunctionnow()"><span>X</span></h3>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="body" cols="30" rows="3">{{$post->body}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" name="media" >
                                                    <input type="hidden" name="current_image" value="@if(isset($post->media)) {{$post->media}} @endif">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="second">
                                <div class="single">
                                    <p>{{$post->created_at->diffForhumans()}}</p>
                                </div>

                            </div>

                            <div class="third">
                                <h4>{{$post->body}}</h4>
                                @if(!empty($post->media) || $post->media != null)
                                <img src="{{asset('media/post/'.$post->user_id.'/'.$post->id.'/'.$post->media)}}" alt="">
                                @else
                                    <div style="width: 618px; height: 300px;"></div>
                                @endif
                            </div>

                            <div class="forth">
                                <h3 class="like" data-id="{{$post->id}}"><i class="fas fa-heart" ></i>  {{$post->likes->count()}}</h3>
                                <h3 data-id="{{$post->id}}" class="comment-section-now-ok"><i class="fas fa-comments"></i>  {!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h3>
                                <h3><i class="fas fa-share"> &nbsp; 5</i>
                                    {{--<div class="socila-share mt-3">--}}
                                        {{--<div style="float: left; margin-top: 10px;" class="sharethis-inline-share-buttons"></div>--}}
                                    {{--</div>--}}
                                </h3>
                            </div>

                                <div class="main-comment">
                                    <div class="comment-section" id="comment-section-{{$post->id}}">
                                        <p onclick="myfunctionnows()" style="float:right;">X</p>
                                        <div class="comment-total">
                                            @foreach($post->comments as $comment)
                                                <div class="comment">
                                                    <div class="single">
                                                        <img src="{{asset('media/user/profile_pic/'.$comment->user_id.'/'.$comment->user->profile_pic)}}" alt="">
                                                    </div>
                                                    <div class="single">
                                                        <h3>{{$comment->user->name}}</h3>
                                                        <p>{{$comment->body}}</p>
                                                    </div>

                                                    <div class="favorite">
                                                        <p> <span>Like</span> <span onclick="showReplyForm('{{$comment->id}}', '{{$comment->user->name}}', '{{$post->id}}');">Replay</span></p>
                                                    </div>
                                                    @foreach($comment->replies as $reply)
                                                        <div class="next-comment">

                                                            <div class="single">
                                                                <img src="{{asset('media/user/profile_pic/'.$reply->user_id.'/'.$reply->user->profile_pic)}}" alt="">

                                                            </div>
                                                            <div class="single">
                                                                <h3>{{$reply->user->name}}</h3>
                                                                <p>{{$reply->message}}</p>
                                                            </div>

                                                            <div class="favorite">
                                                                <p> <span >Like</span> <span onclick="showReplyForm('{{$comment->id}}', '{{$reply->user->name}}', '{{$post->id}}');">Replay</span></p>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <div class="comment-form replay-comment-form" style="display: none;" id="reply-form-{{$comment->id}}" >
                                                        <form action="{{url('/social-comment-post/'.$comment->id)}}" method="post"> {{csrf_field()}}
                                                            <div class="form-group">
                                                                <input type="hidden" name="post_id" value="{{$comment->post_id}}">
                                                                <textarea name="comment" id="reply-form-{{$comment->id}}-text"  cols="30" rows="3" required ></textarea>
                                                                <button type="submit">Send</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="comment-form" id="post-main-comment-{{$post->id}}">
                                            <form action="{{url('post/comment')}}" method="post" > {{csrf_field()}}
                                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                                <div class="form-group">
                                                    <textarea name="comment"  cols="30" rows="3"></textarea>
                                                    <button type="submit">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>




                        @endforeach

                    </div>


                    <div>
                        <div class="about-main">
                            <form method="post" action="{{url('/social-update-user-information')}}">{{csrf_field()}}
                            <div class="single">
                                <i class="fas fa-user"></i>
                                <h5>Known as</h5>
                                <h5><input  type="text" name="name" value="{{$userDetails->name}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-briefcase"></i>
                                <h5>Work as</h5>
                                <h5><input  type="text" name="occupation" value="{{$userDetails->occupation}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-birthday-cake"></i>
                                <h5>Birthday</h5>
                                <h5><input  type="text" name="birthday" value="{{$userDetails->birthday}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-venus-mars"></i>
                                <h5>Gender</h5>
                                <h5><input  type="text" name="gender" value="{{$userDetails->gender}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-globe-asia"></i>
                                <h5>Follows</h5>
                                <h5><input  type="text" name="religion" value="{{$userDetails->religion}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-dungeon"></i>
                                <h5>Lives In</h5>
                                <h5><input  type="text" name="lives_in" value="{{$userDetails->lives_in}}"></h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-home"></i>
                                <h5>Hometown</h5>
                                <h5><input  type="text" name="hometown" value="{{$userDetails->hometown}}"></h5>

                            </div>
                            <div class="single">
                                <button>Update Information</button>
                            </div>

                                @if($userDetails->type == 'SMO')
                                    <div class="single">
                                        <h5>Business Tour / 5000 </h5>
                                    </div>

                                @elseif($userDetails->type == 'MEx')
                                    <div class="single">
                                        <h5>Business Tour / 10000</h5>
                                    </div>
                                @elseif($userDetails->type == 'SMEx')
                                    <div class="single">
                                        <h5>Mobile / 15000</h5>
                                    </div>
                                @elseif($userDetails->type == 'RMM')
                                    <div class="single">
                                        <h5>India Tour</h5>
                                    </div>
                                @elseif($userDetails->type == 'MM')
                                    <div class="single">
                                        <h5>Laptop / 50,000</h5>
                                    </div>
                                @elseif($userDetails->type == 'SMM')
                                    <div class="single">
                                        <h5>Bike/150,000</h5>
                                    </div>
                                @elseif($userDetails->type == 'AGM')
                                    <div class="single">
                                        <h5>Car / 15,00,000</h5>
                                    </div>
                                @elseif($userDetails->type == 'GM')
                                    <div class="single">
                                        <h5>Flat / 50,00,000</h5>
                                    </div>
                                    @endif

                            </form>


                        </div>

                        @if($sscInformation > 0)

                        <div class="ssc-information">
                            <div class="ssc-wrapper">
                                <h3>SSC Information Here</h3>
                                <form action="{{url('/user_profile_update')}}" method="post">{{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="roll" id="roll" @if($userDetails->verified ==1) readonly @endif  value="{{$sscInformationd->roll}}" placeholder="SSC/Equivalent Roll Number">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="registration" @if($userDetails->verified ==1) readonly @endif  value="{{$sscInformationd->reg_num}}" id="registration" placeholder="SSC/Equivalent Registration Number">
                                </div>

                                <div class="form-group">
                                    <select name="group" id="group" @if($userDetails->verified ==1) readonly @endif >
                                        <option value="Science" @if($sscInformationd->group == 'Science') selected @endif >Science</option>
                                        <option value="Business Studies" @if($sscInformationd->group == 'Business Studies') selected @endif >Business Studies</option>
                                        <option value="Humanities" @if($sscInformationd->group == 'Humanities') selected @endif >Humanities</option>
                                        <option value="Others" @if($sscInformationd->group == 'Others') selected @endif >Others</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="year" id="year" @if($userDetails->verified ==1) readonly @endif >
                                        <option value="1971" @if($sscInformationd->year == '1971') selected @endif >1971</option>
                                        <option value="1972" @if($sscInformationd->year == '1972') selected @endif >1972</option>
                                        <option value="1973" @if($sscInformationd->year == '1973') selected @endif >1973</option>
                                        <option value="1974" @if($sscInformationd->year == '1974') selected @endif >1974</option>
                                        <option value="1975" @if($sscInformationd->year == '1975') selected @endif >1975</option>
                                        <option value="1976" @if($sscInformationd->year == '1976') selected @endif >1976</option>
                                        <option value="1977" @if($sscInformationd->year == '1977') selected @endif >1977</option>
                                        <option value="1978" @if($sscInformationd->year == '1978') selected @endif >1978</option>
                                        <option value="1979" @if($sscInformationd->year == '1979') selected @endif >1979</option>
                                        <option value="1980" @if($sscInformationd->year == '1980') selected @endif >1980</option>
                                        <option value="1981" @if($sscInformationd->year == '1981') selected @endif >1981</option>
                                        <option value="1982" @if($sscInformationd->year == '1982') selected @endif >1982</option>
                                        <option value="1983" @if($sscInformationd->year == '1983') selected @endif >1983</option>
                                        <option value="1984" @if($sscInformationd->year == '1984') selected @endif >1984</option>
                                        <option value="1985" @if($sscInformationd->year == '1985') selected @endif >1985</option>
                                        <option value="1986" @if($sscInformationd->year == '1986') selected @endif >1986</option>
                                        <option value="1987" @if($sscInformationd->year == '1987') selected @endif >1987</option>
                                        <option value="1988" @if($sscInformationd->year == '1988') selected @endif >1988</option>
                                        <option value="1989" @if($sscInformationd->year == '1989') selected @endif >1989</option>
                                        <option value="1990" @if($sscInformationd->year == '1990') selected @endif >1990</option>
                                        <option value="1991" @if($sscInformationd->year == '1991') selected @endif >1991</option>
                                        <option value="1992" @if($sscInformationd->year == '1992') selected @endif >1992</option>
                                        <option value="1993" @if($sscInformationd->year == '1993') selected @endif >1993</option>
                                        <option value="1994" @if($sscInformationd->year == '1994') selected @endif >1994</option>
                                        <option value="1995" @if($sscInformationd->year == '1995') selected @endif >1995</option>
                                        <option value="1996" @if($sscInformationd->year == '1996') selected @endif >1996</option>
                                        <option value="1997" @if($sscInformationd->year == '1997') selected @endif >1997</option>
                                        <option value="1998" @if($sscInformationd->year == '1998') selected @endif >1998</option>
                                        <option value="1999" @if($sscInformationd->year == '1999') selected @endif >1999</option>
                                        <option value="2000" @if($sscInformationd->year == '2000') selected @endif >2000</option>
                                        <option value="2001" @if($sscInformationd->year == '2001') selected @endif >2001</option>
                                        <option value="2002" @if($sscInformationd->year == '2002') selected @endif >2002</option>
                                        <option value="2003" @if($sscInformationd->year == '2003') selected @endif >2003</option>
                                        <option value="2004" @if($sscInformationd->year == '2004') selected @endif >2004</option>
                                        <option value="2005" @if($sscInformationd->year == '2005') selected @endif >2005</option>
                                        <option value="2006" @if($sscInformationd->year == '2006') selected @endif>2006</option>
                                        <option value="2007" @if($sscInformationd->year == '2007') selected @endif >2007</option>
                                        <option value="2008" @if($sscInformationd->year == '2008') selected @endif >2008</option>
                                        <option value="2009" @if($sscInformationd->year == '2009') selected @endif >2009</option>
                                        <option value="2010" @if($sscInformationd->year == '2010') selected @endif >2010</option>
                                        <option value="2011" @if($sscInformationd->year == '2011') selected @endif >2011</option>
                                        <option value="2012" @if($sscInformationd->year == '2012') selected @endif >2012</option>
                                        <option value="2013" @if($sscInformationd->year == '2013') selected @endif>2013</option>
                                        <option value="2014" @if($sscInformationd->year == '2014') selected @endif >2014</option>
                                        <option value="2015" @if($sscInformationd->year == '2015') selected @endif >2015</option>
                                        <option value="2016" @if($sscInformationd->year == '2016') selected @endif >2016</option>
                                        <option value="2017" @if($sscInformationd->year == '2017') selected @endif >2017</option>
                                        <option value="2018" @if($sscInformationd->year == '2018') selected @endif >2018</option>
                                        <option value="2019" @if($sscInformationd->year == '1919') selected @endif >2019</option>
                                        <option value="2020" @if($sscInformationd->year == '2020') selected @endif >2020</option>
                                        <option value="2021" @if($sscInformationd->year == '2021') selected @endif >2021</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="board" id="board" @if($userDetails->verified ==1) readonly @endif >
                                        <option value="Barisal" @if($sscInformationd->board == 'Barisal') selected @endif >Barisal</option>
                                        <option value="Chittagong" @if($sscInformationd->board == 'Chittagong') selected @endif >Chittagong</option>
                                        <option value="Comilla" @if($sscInformationd->board == 'Comilla') selected @endif >Comilla</option>
                                        <option value="Dhaka" @if($sscInformationd->board == 'Dhaka') selected @endif>Dhaka</option>
                                        <option value="Dinajpur" @if($sscInformationd->board == 'Dinajpur') selected @endif >Dinajpur</option>
                                        <option value="Jessore" @if($sscInformationd->board == 'Jessore') selected @endif >Jessore</option>
                                        <option value="Mymensingh" @if($sscInformationd->board == 'Mymensingh') selected @endif >Mymensingh</option>
                                        <option value="Madrasha" @if($sscInformationd->board == 'Madrasha') selected @endif >Madrasha</option>
                                        <option value="Rajshahi" @if($sscInformationd->board == 'Rajshahi') selected @endif >Rajshahi</option>
                                        <option value="Sylhet" @if($sscInformationd->board == 'Sylhet') selected @endif >Sylhet</option>
                                        <option value="Technical" @if($sscInformationd->board == 'Technical') selected @endif >Technical</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <input type="email" name="email" @if($userDetails->verified ==1) readonly @endif  id="email" value="{{$sscInformationd->email}}" placeholder="E-Mail (Must be valid)">
                                </div>
                                <div class="form-group">
                                    @if($userDetails->verified ==1)
                                        <a href="#" class="youareverifired">Update SSC Information</a>
                                        @else
                                        <button type="submit">Update SSC Information</button>
                                    @endif
                                </div>
                                 <div class="form-group">
                                     <a href="{{url('/update-user-all-information')}}">Update All Information</a>
                                 </div>


                                </form>
                            </div>
                        </div>

                        @endif
                    </div>

                    <div>
                        <h3>This is Follower Section</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure maxime quidem beatae consectetur ipsum assumenda libero fugit ipsam totam placeat asperiores dignissimos dicta eligendi autem similique porro, vero nulla vel.</p>
                    </div>

                    <div>
                        <h3>This is Following Section</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure maxime quidem beatae consectetur ipsum assumenda libero fugit ipsam totam placeat asperiores dignissimos dicta eligendi autem similique porro, vero nulla vel.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5fa39b45420a440019cbdd2b&product=inline-share-buttons' async='async'></script>

    <script>

        $(".youareverifired").click(function () {
            alert("You are already verified");
        });

        $(document).ready(function () {
            $(".search_user_bind_ok").keyup(function () {
                var query = $(this).val();
                if(query != ''){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/search-user-list')}}",
                        method: "get",
                        data:{'query':query, '_token':_token},
                        success:function(data){
                            $('.search_user_fetch_ok').fadeIn();
                            $('.search_user_fetch_ok').html(data);
                        }
                    })
                }
            });

            $(document).on('click', 'a', function(){
                console.log($(this).text());
                $('.search_user_bind_ok').val($(this).text());
                $('.search_user_fetch_ok').fadeOut();
            });
        });

    </script>
    <script>
        $('.like').on('click', function (event) {
            event.preventDefault();
           var isLike = event.target.previousElementSibling != null;
           var postId = $(this).data("id");

           $.ajax({
               method:"POST",
               url:"{{url('like-post')}}",
               data:{isLike : isLike, postId : postId, "_token": "{{ csrf_token() }}"}
           }).done(function () {
               window.location = "social";
           })
        });
    </script>

    <script>
        function showReplyForm(commentId, user, postId) {
            var x = document.getElementById(`reply-form-${commentId}`);
            var input = document.getElementById(`reply-form-${commentId}-text`);
            let off = document.getElementById("post-main-comment-"+postId);

            if(x.style.display === "none"){
                x.style.display = "block";
                input.innerText = `@${user}`;
                off.style.display= "none";
            }else{

                x.style.display = "none";
                off.style.display= "block";

            }
        }
    </script>

    <script>
        let tabHeader = document.querySelectorAll(".profile-tab-header > div");
        let tabIndicator = document.getElementsByClassName("profile-tab-indicator")[0];
        let tabBody = document.querySelectorAll(".profile-tab-body > div") ;

        let tab = document.getElementsByClassName("profile-tab")[0];


        var val = 0;
        for(let j =0; j < tabBody.length; j++){
            val = val + tabBody[j].offsetHeight;
        }
        tab.style.height = val + 100 + "px";

        if(window.innerWidth <= '960'){

            tab.style.height = val +100+ "px";
        }


        for(let i = 0; i < tabHeader.length; i++){
            tabHeader[i].addEventListener("click", function(){
                document.querySelector(".profile-tab-header > .active").classList.remove("active");
                tabHeader[i].classList.add("active");


                document.querySelector(".profile-tab-body > .active").classList.remove("active");
                tabBody[i].classList.add("active");
                var ok = tabBody[i].offsetHeight;
                console.log(ok);
                tabIndicator.style.left = `calc(calc(100% /4)* ${i})`;

                tab.style.height = ok +100+ "px";
            });
        }


    </script>

    <script>
        $(document).ready(function () {
            $(".three-dot").on('click', function () {
                var id = $(this).data('id');
                $('#post-simple-'+id).toggle();
            });
        });


        $(".post-edit-now-social").click(function () {
            let id = $(this).data('id');
            $('.wrappepost').css('display','none');
            $('#wrapper-'+id).toggle();

        });

        function myfunctionnow() {
            $('.wrappepost').css('display', 'none');
        }

    </script>

    <script>
        $(".comment-section-now-ok").click(function () {
            let id = $(this).data('id');
            $('#comment-section-'+id).css("display", "block");
        });

        function myfunctionnows() {
            $('.comment-section').css('display', 'none');
        }
    </script>
@endpush


