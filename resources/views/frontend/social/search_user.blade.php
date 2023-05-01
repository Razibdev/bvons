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
@endpush
@section('content')

    <div class="main-profile">
        <div class="wrapper">
            <div class="caption">
                @if(!empty($user->cover_pic))
                <img src="{{asset('media/user/cover_pic/'.$user->id.'/'.$user->cover_pic)}}" alt="">
                @else
                    <img src="{{asset('media/favicons/ms-icon-310x310.png')}}" alt="">

                @endif
                <a href="#">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <div class="profile-cap">
                    <div class="single">
                        @if(!empty($user->profile_pic))
                        <img src="{{asset('media/user/profile_pic/'.$user->id.'/'.$user->profile_pic)}}" alt="">
                        @else
                            <img src="{{asset('media/favicons/ms-icon-310x310.png')}}" alt="">
                       @endif
                    </div>
                    <div class="single">
                        <h3>{{ Str::limit($user->name, 12) }}</h3>

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
                                    <img src="{{asset('media/post/'.$post->user_id.'/'.$post->id.'/'.$post->media)}}" alt="">
                                </div>

                                <div class="forth">
                                    <h3 class="like" data-id="{{$post->id}}"><i class="fas fa-heart" ></i>  {{$post->likes->count()}}</h3>
                                    <h3 data-id="{{$post->id}}" class="comment-section-now-ok"><i class="fas fa-comments"></i>  {!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h3>
                                    <h3><i class="fas fa-share"> &nbsp; 5</i>  <div class="socila-share mt-3">
                                            <div style="float: left; margin-top: 10px;" class="sharethis-inline-share-buttons"></div>
                                        </div></h3>
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
                            <div class="single">
                                <i class="fas fa-user"></i>
                                <h5>Known as</h5>
                                <h5>{{$user->name}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-briefcase"></i>
                                <h5>Work as</h5>
                                <h5>{{$user->occupation}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-birthday-cake"></i>
                                <h5>Birthday</h5>
                                <h5>{{$user->birthday}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-venus-mars"></i>
                                <h5>Gender</h5>
                                <h5>{{$user->gender}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-globe-asia"></i>
                                <h5>Follows</h5>
                                <h5>{{$user->religion}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-dungeon"></i>
                                <h5>Lives In</h5>
                                <h5>{{$user->lives_in}}</h5>
                            </div>

                            <div class="single">
                                <i class="fas fa-home"></i>
                                <h5>Hometown</h5>
                                <h5>{{$user->hometown}}</h5>
                            </div>


                        </div>
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
                window.location = "/social-profile";
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


