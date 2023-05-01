@extends('layouts.front_layout.front_layout')
@push('css')

    <style>
        /*body {*/
            /*margin: 5%;*/
            /*font-family: Helvetica;*/
            /*-moz-osx-font-smoothing: grayscale;*/
            /*-webkit-font-smoothing: antialiased;*/
        /*}*/

        .fb-share-button {
            background: #3b5998;
            border-radius: 3px;
            font-weight: 600;
            padding: 5px 8px;
            display: inline-block;
            position: static;
        }

        .fb-share-button:hover {
            cursor: pointer;
            background: #213A6F
        }

        .fb-share-button svg {
            width: 18px;
            fill: white;
            vertical-align: middle;
            border-radius: 2px
        }

        .fb-share-button span {
            vertical-align: middle;
            color: white;
            font-size: 14px;
            padding: 0 3px
        }
    </style>
    <style>
        .images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 1em;
            margin: 0 1em;
        }
        .images img {
            cursor: pointer;
            transition: 0.3s all ease;
        }
        .images img:hover {
            transform: scale(0.9);
        }
        .modal {
            position: fixed;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            z-index: 1;
            overflow: auto;
            opacity: 0;
            pointer-events: none;
        }
        .modalContent {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .modalImg {
            width: 80%;
            min-width: 1400px;
        }
        .modalTxt {
            margin-top: 1em;
        }
        .close {
            position: absolute;
            top: 1em;
            right: 1.5em;
            font-size: 1.5em;
            cursor: pointer;
        }
        .modal.appear {
            opacity: 1;
            pointer-events: all;
        }
        .modal.appear .modalImg,
        .modal.appear .modalTxt {
            animation: zoom 0.3s linear;
        }
        @keyframes zoom {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        @media screen and (max-width: 768px){
            .modalImg {
                width: 80%;
                min-width: 400px;
            }

        }


    </style>
@endpush

@section('content')
    <div class="main-social">

        @if($postCount > 0)
        <div class="social-wrapper">

            <div class="social-profile">
                <div class="profile-single">
                    @if(isset($post->user->cover_pic))
                        <img src="{{asset('media/user/cover_pic/'.$post->user_id.'/'.$post->user->cover_pic)}}" alt="">
                    @else
                        <img src="{{asset('media/avatars/avatar0.jpg')}}" alt="">
                    @endif
                </div>

                <div class="profile-single">
                    <h3>@if(isset($post->user->name))  {{ $post->user->name}} @endif
                        <span>
                    @if(isset($post->user->verified))
                                @if($post->user->verified == 1)
                                    <img title="Verified User" src="{{asset('frontend/image/download.png')}}" alt="">
                                @else
                                    <div style="width: 200px; height: 10px; display: block"></div>
                                @endif
                            @endif

                </span>
                    </h3>
                    <p style="font-size: 12px"> @if($post->premium_post == 1 && $post->action_page == 1) Action @elseif($post->premium_post == 1) Sponsored @endif &nbsp;{{$post->created_at->diffForhumans()}} </p>
                </div>

                <div class="profile-single">

                </div>

                <div class="profile-single">
                    @if(\Illuminate\Support\Facades\Auth::id() == $post->user_id)
                        <h3 class="three-dot-package" data-id="{{$post->id}}"><i class="fas fa-ellipsis-v"></i></h3>
                    @else
                        <h3><i class="fas fa-ellipsis-v"></i></h3>

                    @endif
                </div>

                <div class="edit-wrapper">
                    <div class="social-edit-wrapper" id="post_edit_now_ok{{$post->id}}">
                        <h3 id="closeEditPost" class="edit_button_now_click" data-id="{{$post->id}}">Edit</h3>
                        <form action="{{ route('social.post.delete', $post->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="edit-post">
                    <div class="edit-post-wrapper" id="edit-post-wrapper-{{$post->id}}">
                        <div class="text-header">
                            <h3>Edit Post</h3>
                            <h3><i class="fas fa-times" onclick="editPostclick()"></i></h3>
                        </div>
                        <div class="text-body">
                            <form action="{{url('/social-edit-post/'.$post->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="body" cols="30" rows="6">{{$post->body}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="media" id="media">
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


            <div class="profile-second">
                <h6 class="body-first" id="body-first{{$post->id}}" style="text-align: justify">{{Str::limit( $post->body, 160)}} <?php if(strlen($post->body) > 160){ ?> <p style="cursor: pointer;"  data-id="{{$post->id}}" id="read_more-{{$post->id}}" href="#" class="read_more" data-body="{{$post->body}}">Read More</p> <?php
                    } ?> </h6>

                <h6 id="body-second{{$post->id}}" class="body-second" style="text-align: justify">{{ $post->body}}  <p style="cursor: pointer;" href="#" class="read_less" id="read_less{{$post->id}}" data-id="{{$post->id}}" >Read Less</p>  </h6>
            </div>
            <div class="profile-third">
                @if(!empty($post->media) || $post->media != null)

                    <img src="{{asset('media/post/'.$post->user_id.'/'.$post->id.'/'.$post->media)}}" width="300" height="300" alt="">
                @else
                    <div style="width: 618px; height: 300px;"></div>
                @endif
            </div>
            <div class="modal">
                <span class="close"><i style="color: #fff;" class="fas fa-times"></i></span>
                <div class="modalContent">
                    <p>X</p>

                    <img src="" class="modalImg" />
                    <span class="modalTxt"></span>
                </div>
            </div>
            <div class="profile-forth">

                <div class="forth-singl">
                    @if($post->premium_post == 1 && $post->now_date == date('Y-m-d') )
                        <h5 class="like-button-commission" data-id="{{$post->id}}"><a href="#"><i class="far fa-thumbs-up"></i></a> &nbsp; {{$post->likes->count()}}</h5>
                    @else
                        <h5 class="like-button-general" data-id="{{$post->id}}"><i class="far fa-thumbs-up"></i> &nbsp; {{$post->likes->count()}}</h5>
                    @endif
                </div>


                <div class="forth-singl">
                    @if($post->premium_post == 1 && $post->now_date == date('Y-m-d'))
                        <h5 class="premium_post_comment" style="cursor:pointer;" data-id="{{$post->id}}"><i class="fas fa-comments"></i> &nbsp;{!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h5>
                    @else
                        <h5 style="cursor:pointer;" data-id="{{$post->id}}" class="comment-section-now-ok"><i class="fas fa-comments"></i> &nbsp;{!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h5>
                    @endif
                </div>

                <div class="forth-singl">
                    {{--<h5 style="float: right;"><a href="#"><i class="fas fa-share-alt"></i></a> &nbsp; 6</h5>--}}
                    <div style="float:right;" class="fb-share-button" id="fb-share-button{{$post->id}}" data-url="{{$post->post_url}}">
                        <svg viewBox="0 0 12 12" preserveAspectRatio="xMidYMid meet">
                            <path class="svg-icon-path" d="M9.1,0.1V2H8C7.6,2,7.3,2.1,7.1,2.3C7,2.4,6.9,2.7,6.9,3v1.4H9L8.8,6.5H6.9V12H4.7V6.5H2.9V4.4h1.8V2.8 c0-0.9,0.3-1.6,0.7-2.1C6,0.2,6.6,0,7.5,0C8.2,0,8.7,0,9.1,0.1z"></path>
                        </svg>
                        <span>Share</span>
                    </div>
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
        </div>
        @endif

        @if($postpCount > 0)
        <div class="social-wrapper">

            <div class="social-profile">
                <div class="profile-single">
                    @if(isset($postp->user->cover_pic))
                        <img src="{{asset('media/user/cover_pic/'.$postp->user_id.'/'.$postp->user->cover_pic)}}" alt="">
                    @else
                        <img src="{{asset('media/avatars/avatar0.jpg')}}" alt="">
                    @endif
                </div>

                <div class="profile-single">
                    <h3>@if(isset($postp->user->name))  {{ $postp->user->name}} @endif
                        <span>
                    @if(isset($postp->user->verified))
                                @if($postp->user->verified == 1)
                                    <img title="Verified User" src="{{asset('frontend/image/download.png')}}" alt="">
                                @else
                                    <div style="width: 200px; height: 10px; display: block"></div>
                                @endif
                            @endif

                </span>
                    </h3>
                    <p style="font-size: 12px"> @if($postp->premium_post == 1 && $postp->action_page == 1) Action @elseif($postp->premium_post == 1) Sponsored @endif &nbsp;{{$postp->created_at->diffForhumans()}} </p>
                </div>

                <div class="profile-single">

                </div>

                <div class="profile-single">
                    @if(\Illuminate\Support\Facades\Auth::id() == $postp->user_id)
                        <h3 class="three-dot-package" data-id="{{$postp->id}}"><i class="fas fa-ellipsis-v"></i></h3>
                    @else
                        <h3><i class="fas fa-ellipsis-v"></i></h3>

                    @endif
                </div>

                <div class="edit-wrapper">
                    <div class="social-edit-wrapper" id="post_edit_now_ok{{$postp->id}}">
                        <h3 id="closeEditPost" class="edit_button_now_click" data-id="{{$postp->id}}">Edit</h3>
                        <form action="{{ route('social.post.delete', $postp->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="edit-post">
                    <div class="edit-post-wrapper" id="edit-post-wrapper-{{$postp->id}}">
                        <div class="text-header">
                            <h3>Edit Post</h3>
                            <h3><i class="fas fa-times" onclick="editPostclick()"></i></h3>
                        </div>
                        <div class="text-body">
                            <form action="{{url('/social-edit-post/'.$postp->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="body" cols="30" rows="6">{{$postp->body}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="media" id="media">
                                    <input type="hidden" name="current_image" value="@if(isset($postp->media)) {{$postp->media}} @endif">
                                </div>
                                <div class="form-group">
                                    <button type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="profile-second">
                <h6 class="body-first" id="body-first{{$postp->id}}" style="text-align: justify">{{Str::limit( $postp->body, 160)}} <?php if(strlen($postp->body) > 160){ ?> <p style="cursor: pointer;"  data-id="{{$postp->id}}" id="read_more-{{$postp->id}}" href="#" class="read_more" data-body="{{$post->body}}">Read More</p> <?php
                    } ?> </h6>

                <h6 id="body-second{{$postp->id}}" class="body-second" style="text-align: justify">{{ $postp->body}}  <p style="cursor: pointer;" href="#" class="read_less" id="read_less{{$postp->id}}" data-id="{{$postp->id}}" >Read Less</p>  </h6>
            </div>
            <div class="profile-third">
                @if(!empty($postp->media) || $postp->media != null)

                    <img src="{{asset('media/post/'.$postp->user_id.'/'.$postp->id.'/'.$postp->media)}}" width="300" height="300" alt="">
                @else
                    <div style="width: 618px; height: 300px;"></div>
                @endif
            </div>
            <div class="modal">
                <span class="close"><i style="color: #fff;" class="fas fa-times"></i></span>
                <div class="modalContent">
                    <p>X</p>

                    <img src="" class="modalImg" />
                    <span class="modalTxt"></span>
                </div>
            </div>
            <div class="profile-forth">

                <div class="forth-singl">
                    @if($postp->premium_post == 1 && $postp->now_date == date('Y-m-d') )
                        <h5 class="like-button-commission" data-id="{{$postp->id}}"><a href="#"><i class="far fa-thumbs-up"></i></a> &nbsp; {{$postp->likes->count()}}</h5>
                    @else
                        <h5 class="like-button-general" data-id="{{$postp->id}}"><i class="far fa-thumbs-up"></i> &nbsp; {{$postp->likes->count()}}</h5>
                    @endif
                </div>


                <div class="forth-singl">
                    @if($postp->premium_post == 1 && $postp->now_date == date('Y-m-d'))
                        <h5 class="premium_post_comment" style="cursor:pointer;" data-id="{{$postp->id}}"><i class="fas fa-comments"></i> &nbsp;{!! $postp->total_comment + $postp->totalCommentRepliy($postp->id) !!}</h5>
                    @else
                        <h5 style="cursor:pointer;" data-id="{{$postp->id}}" class="comment-section-now-ok"><i class="fas fa-comments"></i> &nbsp;{!! $postp->total_comment + $postp->totalCommentRepliy($postp->id) !!}</h5>
                    @endif
                </div>

                <div class="forth-singl">
                    {{--<h5 style="float: right;"><a href="#"><i class="fas fa-share-alt"></i></a> &nbsp; 6</h5>--}}
                    <div style="float:right;" class="fb-share-button" id="fb-share-button{{$postp->id}}" data-url="{{$postp->post_url}}">
                        <svg viewBox="0 0 12 12" preserveAspectRatio="xMidYMid meet">
                            <path class="svg-icon-path" d="M9.1,0.1V2H8C7.6,2,7.3,2.1,7.1,2.3C7,2.4,6.9,2.7,6.9,3v1.4H9L8.8,6.5H6.9V12H4.7V6.5H2.9V4.4h1.8V2.8 c0-0.9,0.3-1.6,0.7-2.1C6,0.2,6.6,0,7.5,0C8.2,0,8.7,0,9.1,0.1z"></path>
                        </svg>
                        <span>Share</span>
                    </div>
                </div>




                <div class="main-comment">
                    <div class="comment-section" id="comment-section-{{$postp->id}}">
                        <p onclick="myfunctionnows()" style="float:right;">X</p>
                        <div class="comment-total">
                            @foreach($postp->comments as $comment)
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

                        <div class="comment-form" id="post-main-comment-{{$postp->id}}">
                            <form action="{{url('post/comment')}}" method="post" > {{csrf_field()}}
                                <input type="hidden" name="post_id" value="{{$postp->id}}">
                                <div class="form-group">
                                    <textarea name="comment"  cols="30" rows="3"></textarea>
                                    <button type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endif



        @foreach($posts as $post)
        <div class="social-wrapper">

            @if($post->page_id == null)
                <div class="social-profile">
                <div class="profile-single">
                    @if(isset($post->user->cover_pic))
                    <img src="{{asset('media/user/cover_pic/'.$post->user_id.'/'.$post->user->cover_pic)}}" alt="">
                    @else
                        <img src="{{asset('media/avatars/avatar0.jpg')}}" alt="">
                    @endif
                </div>

                <div class="profile-single">
                    <h3>@if(isset($post->user->name))  {{ $post->user->name}} @endif
                        <span>
                    @if(isset($post->user->verified))
                                @if($post->user->verified == 1)
                                    <img title="Verified User" src="{{asset('frontend/image/download.png')}}" alt="">
                                @else
                                    <div style="width: 200px; height: 10px; display: block"></div>
                                @endif
                            @endif

                </span>
                    </h3>
                    <p style="font-size: 12px"> @if($post->premium_post == 1 && $post->action_page == 1) Action @elseif($post->premium_post == 1) Sponsored @endif &nbsp;{{$post->created_at->diffForhumans()}} </p>
                </div>

                <div class="profile-single">

                </div>

                <div class="profile-single">
                    @if(\Illuminate\Support\Facades\Auth::id() == $post->user_id)
                    <h3 class="three-dot-package" data-id="{{$post->id}}"><i class="fas fa-ellipsis-v"></i></h3>
                     @else
                        <h3><i class="fas fa-ellipsis-v"></i></h3>

                    @endif
                </div>

                <div class="edit-wrapper">
                    <div class="social-edit-wrapper" id="post_edit_now_ok{{$post->id}}">
                        <h3 id="closeEditPost" class="edit_button_now_click" data-id="{{$post->id}}">Edit</h3>
                        <form action="{{ route('social.post.delete', $post->id) }}" method="POST">@csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="edit-post">
                    <div class="edit-post-wrapper" id="edit-post-wrapper-{{$post->id}}">
                        <div class="text-header">
                            <h3>Edit Post</h3>
                            <h3><i class="fas fa-times" onclick="editPostclick()"></i></h3>
                        </div>
                        <div class="text-body">
                            <form action="{{url('/social-edit-post/'.$post->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                <div class="form-group">
                                    <textarea name="body" cols="30" rows="6">{{$post->body}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="media" id="media">
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
            @else
                <div class="social-profile">
                    <div class="profile-single">
                        @if(isset($post->page->image))
                            <img src="{{asset('media/page/'.$post->page->image)}}" alt="">
                        @else
                            <img src="{{asset('media/avatars/avatar0.jpg')}}" alt="">
                        @endif
                    </div>

                    <div class="profile-single">
                        <h3>@if(isset($post->page->page_name))  {{ $post->page->page_name}} @endif
                            {{--<span>--}}
                    {{--@if(isset($post->user->verified))--}}
                                    {{--@if($post->user->verified == 1)--}}
                                        {{--<img title="Verified User" src="{{asset('frontend/image/download.png')}}" alt="">--}}
                                    {{--@else--}}
                                        {{--<div style="width: 200px; height: 10px; display: block"></div>--}}
                                    {{--@endif--}}
                                {{--@endif--}}

                {{--</span>--}}
                        </h3>
                        <p style="font-size: 12px">&nbsp;{{$post->created_at->diffForhumans()}} </p>
                    </div>

                    <div class="profile-single">

                    </div>

                    <div class="profile-single">
                        @if(\Illuminate\Support\Facades\Auth::id() == $post->user_id)
                            <h3 class="three-dot-package" data-id="{{$post->id}}"><i class="fas fa-ellipsis-v"></i></h3>
                        @else
                            <h3><i class="fas fa-ellipsis-v"></i></h3>

                        @endif
                    </div>

                    <div class="edit-wrapper">
                        <div class="social-edit-wrapper" id="post_edit_now_ok{{$post->id}}">
                            <h3 id="closeEditPost" class="edit_button_now_click" data-id="{{$post->id}}">Edit</h3>
                            <form action="{{ route('social.post.delete', $post->id) }}" method="POST">@csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="edit-post">
                        <div class="edit-post-wrapper" id="edit-post-wrapper-{{$post->id}}">
                            <div class="text-header">
                                <h3>Edit Post</h3>
                                <h3><i class="fas fa-times" onclick="editPostclick()"></i></h3>
                            </div>
                            <div class="text-body">
                                <form action="{{url('/social-edit-post/'.$post->id)}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}
                                    <div class="form-group">
                                        <textarea name="body" cols="30" rows="6">{{$post->body}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="media" id="media">
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
            @endif


            <div class="profile-second">
                <h6 class="body-first" id="body-first{{$post->id}}" style="text-align: justify">{{Str::limit( $post->body, 160)}} <?php if(strlen($post->body) > 160){ ?> <p style="cursor: pointer;"  data-id="{{$post->id}}" id="read_more-{{$post->id}}" href="#" class="read_more" data-body="{{$post->body}}">Read More</p> <?php
               } ?> </h6>

                <h6 id="body-second{{$post->id}}" class="body-second" style="text-align: justify">{{ $post->body}}  <p style="cursor: pointer;" href="#" class="read_less" id="read_less{{$post->id}}" data-id="{{$post->id}}" >Read Less</p>  </h6>
            </div>
            <div class="profile-third">
                @if(!empty($post->media) || $post->media != null)

                <img src="{{asset('media/post/'.$post->user_id.'/'.$post->id.'/'.$post->media)}}" width="300" height="300" alt="">
                @else
                    <div style="width: 618px; height: 300px;"></div>
                @endif
            </div>
            <div class="modal">
                <span class="close"><i style="color: #fff;" class="fas fa-times"></i></span>
                <div class="modalContent">
                    <p>X</p>

                    <img src="" class="modalImg" />
                    <span class="modalTxt"></span>
                </div>
            </div>
            <div class="profile-forth">

                <div class="forth-singl">
                    @if($post->premium_post == 1 && $post->now_date == date('Y-m-d') )
                    <h5 class="like-button-commission" data-id="{{$post->id}}"><a href="#"><i class="far fa-thumbs-up"></i></a> &nbsp; {{$post->likes->count()}}</h5>
                    @else
                            <h5 class="like-button-general" data-id="{{$post->id}}"><i class="far fa-thumbs-up"></i> &nbsp; {{$post->likes->count()}}</h5>
                    @endif
                </div>


                <div class="forth-singl">
                    @if($post->premium_post == 1 && $post->now_date == date('Y-m-d'))
                    <h5 class="premium_post_comment" style="cursor:pointer;" data-id="{{$post->id}}"><i class="fas fa-comments"></i> &nbsp;{!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h5>
                    @else
                         <h5 style="cursor:pointer;" data-id="{{$post->id}}" class="comment-section-now-ok"><i class="fas fa-comments"></i> &nbsp;{!! $post->total_comment + $post->totalCommentRepliy($post->id) !!}</h5>
                   @endif
                </div>

                <div class="forth-singl">
                    {{--<h5 style="float: right;"><a href="#"><i class="fas fa-share-alt"></i></a> &nbsp; 6</h5>--}}
                    <div style="float:right;" class="fb-share-button" id="fb-share-button{{$post->id}}" data-url="{{$post->post_url}}">
                        <svg viewBox="0 0 12 12" preserveAspectRatio="xMidYMid meet">
                            <path class="svg-icon-path" d="M9.1,0.1V2H8C7.6,2,7.3,2.1,7.1,2.3C7,2.4,6.9,2.7,6.9,3v1.4H9L8.8,6.5H6.9V12H4.7V6.5H2.9V4.4h1.8V2.8 c0-0.9,0.3-1.6,0.7-2.1C6,0.2,6.6,0,7.5,0C8.2,0,8.7,0,9.1,0.1z"></path>
                        </svg>
                        <span>Share</span>
                    </div>
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
        </div>


        @endforeach
    </div>
@endsection

@push('js')

    <script>
      $(document).ready(function () {
          const images = document.querySelectorAll(".profile-third img");
          const modal = document.querySelector(".modal");
          const modalImg = document.querySelector(".modalImg");
          const modalTxt = document.querySelector(".modalTxt");
          const close = document.querySelector(".close");

          images.forEach((image) => {
              image.addEventListener("click", () => {
                  modalImg.src = image.src;
          modalTxt.innerHTML = image.alt;
          modal.classList.add("appear");

          close.addEventListener("click", () => {
              modal.classList.remove("appear");
      });
      });
      });
      });
    </script>

    <script>
        $('.read_more').on('click', function () {
            var id = $(this).data('id');
            $('#body-first'+id).css('display', 'none');
            $('.read_less').css('display', 'none');
            $('#read_less'+id).css('display', 'block');
            $('#body-second'+id).css('display', 'block');


        });

        $('.read_less').on('click', function () {
            var id = $(this).data('id');
            $('.body-second').css('display', 'none');
            $('.read_less').css('display', 'none');
            $('#read_less'+id).css('display', 'none');
            $('#body-first'+id).css('display', 'block');

        });

        $(document).ready(function () {
            $('.like-button-commission').click(function () {
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('post-like-commission-hit-ok')}}",
                    method: "post",
                    data:{'id':id, '_token':_token},
                    success:function(data){
                        console.log(data);
                        window.location = '/social';
                    }
                })
            });
        });


        $(document).ready(function () {
            $('.like-button-general').click(function () {
                var id = $(this).data('id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('post-like-general-hit-ok')}}",
                    method: "post",
                    data:{'id':id, '_token':_token},
                    success:function(data){
                        console.log(data);
                        window.location = '/social';
                    }
                })
            });
        });


        $(document).ready(function () {
            $(".three-dot-package").on('click', function () {
                var id = $(this).data('id');
                $('#post_edit_now_ok'+id).toggle();
            });

            $('.edit_button_now_click').on('click', function () {
                var id = $(this).data('id');
                $('.edit-post-wrapper').css('display', 'none');
                $('#edit-post-wrapper-'+id).toggle();
            });
        });



        $(".comment-section-now-ok").click(function () {
            let id = $(this).data('id');
            $('.comment-section').css('display', 'none');
            $('#comment-section-'+id).css("display", "block");
        });

        $(".premium_post_comment").click(function () {
            let id = $(this).data('id');
            $('.comment-section').css('display', 'none');
            $('#comment-section-'+id).css("display", "block");
        });


        function myfunctionnows() {
            $('.comment-section').css('display', 'none');
        }



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



        $('#socialedit-wrapper').click(function(){
            $('.social-edit-wrapper ').toggle();
        });

        function editPostclick(){
            $('.edit-post-wrapper').css('display', 'none');
        }

        $('#closeEditPost').click(function(){
            $('.edit-post-wrapper').toggle();
        });
        $('#post-comment').click(function(){
            $('.comment-section').toggle();
        });
    </script>


    {{--<script>--}}
        {{--var fbButton = document.getElementById('fb-share-button'+"{{$post->id}}");--}}
        {{--var main_url = window.location.href;--}}

        {{--fbButton.addEventListener('click', function() {--}}
            {{--var post_url = $(this).data('url');--}}
            {{--url = main_url+'/'+post_url;--}}
            {{--window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,--}}
                {{--'facebook-share-dialog',--}}
                {{--'width=800,height=600'--}}
            {{--);--}}
            {{--return false;--}}
        {{--});--}}

        {{--$('.layerConfirm').on('click', function () {--}}
            {{--var id = "{{$post->id}}";--}}
            {{--var _token = $('input[name="_token"]').val();--}}
            {{--$.ajax({--}}
                {{--url: "{{url('post-share-commission-hit-ok')}}",--}}
                {{--method: "post",--}}
                {{--data:{'id':id, '_token':_token},--}}
                {{--success:function(data){--}}
                    {{--console.log(data);--}}
                    {{--window.location = '/social';--}}
                {{--}--}}
            {{--})--}}
        {{--});--}}
    {{--</script>--}}
@endpush