<?php

namespace App\Http\Controllers\Api\Vue;

use App\CommentReaction;
use App\Events\CommentEvent;
use App\Events\LikeEvent;
use App\Events\PostDeleteEvent;
use App\Events\PostEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Modal\CommissionRelation;
use App\Model\Comment\Comment;
use App\Model\CommentRepliy;
use App\Model\Dashboard\AdminSetting\AdminSetting;
use App\Model\Ecommerce\Api\EcoOrder;
use App\Model\Like;
use App\Model\Post\Post;
use App\Model\Reaction;
use App\Model\ShoppingVoucherTransaction;
use App\Model\Transaction\Transaction;
use App\Notifications\newPostNotification;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{

    private  $commission ;

    public function __construct()
    {
        $this->commission = new CommissionRelation();
    }


    public function getAllUser(){
        return User::where('type', '!=', 'GU')->select('id','name')->get();
    }

    public function getPost(){

        $posts = PostResource::collection(Post::where('deleted_at', null)->where('action_page','!=', 1)->whereBetween('created_at', [now()->subDays(3), now()])->inRandomOrder()->get());
        $post = PostResource::collection(Post::where('deleted_at', null)->where('action_page', 1)->latest()->limit(1)->get()) ;
        $postp = PostResource::collection(Post::where('deleted_at', null)->where('premium_post', 1)->where('action_page','!=', 1)->latest()->limit(1)->get());

        return response()->json([
            'posta' => $post,
            'postp' => $postp,
             'randomPost' => $posts,

        ]);
    }

    public function authUserAllPost($id){
        \Log::info(Post::where('user_id', Auth::id())->orderByDesc('id')->get());
        return PostResource::collection(Post::where('user_id', Auth::id())->orderByDesc('id')->get());
    }


    public function authUserCreatePost(Request $request, $id){
        $data = $request->all();
//        dump($data);
        if(empty($data['body'])){
            $data['body'] = '';
        }

        $post = Post::latest()->first();
        $post_id = $post->id+1;

            if ($request->hasFile('media')) {
                $image_tmp = $request->file('media');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;
                }
                $path = 'media/post' . '/' . $id . '/' . $post_id;
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                $large_image_path = "media/post/" . Auth::id() . "/" . $post_id . "/" . $filename;

                Image::make($image_tmp)->resize(574, 264)->save($large_image_path);
            }else{
                $filename = null;
            }

            $data = [
                'user_id' => $id,
                'post_url' => Str::slug($data['body']),
                'body' => $data['body'],
                'media' => $filename,
                'premium_post' => 0,
                'action_page' => 0,
                'now_date' => date('Y-m-d'),
            ];

            $posts = Post::create($data);
//            $user = Auth::user();
//            $user->notify(new newPostNotification($posts));
        broadcast(new PostEvent($posts->id))->toOthers();


        return response(new PostResource($posts), Response::HTTP_CREATED);

    }


    public function socialEditPost(Request $request, $id){
        $post = Post::where('id', $id)->first();
//        echo "<pre>"; print_r($request->all()); die;
            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;

                }
                if (isset($post->media)){
                    $large_image_path = "media/post/".$post->user_id."/".$post->id."/".$post->media;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }

                $large_image_path = "media/post/".$post->user_id."/".$post->id."/".$filename;

                // Resize Image
                Image::make($image_tmp)->save($large_image_path);

            }else{
                $filename = $post->media;
            }

            Post::where('id',$id)->update(['body' => $request->body, 'media' => $filename]);
            broadcast(new PostEvent($id))->toOthers();
            return response()->json();

    }

    public function updateUserPostNow(Request $request, $id){
        $post = Post::where('id', $id)->first();
//        echo "<pre>"; print_r($request->all()); die;
        if($request->hasFile('media')){
            $image_tmp = $request->file('media');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = rand(111111, 999999).'.'.$extension;

            }
            if (isset($post->media)){
                $large_image_path = "media/post/".$post->user_id."/".$post->id."/".$post->media;

                if(File::exists($large_image_path)){
                    File::delete($large_image_path);
                }
            }

            $large_image_path = "media/post/".$post->user_id."/".$post->id."/".$filename;

            // Resize Image
            Image::make($image_tmp)->save($large_image_path);

        }else{
            $filename = $post->media;
        }

        Post::where('id',$id)->update(['body' => $request->body, 'media' => $filename]);
        broadcast(new PostEvent($id))->toOthers();
        return response()->json();
    }

    public function deletePost($id){
        $deletePost = Post::where('id', $id)->first();
        $directory = "media/post/".$deletePost->user_id."/".$id;
        File::deleteDirectory(public_path($directory));
        broadcast(new PostDeleteEvent($id))->toOthers();
        $deletePost->delete();
        return response()->json();
    }

    public function toggle( $id, Request $request){

        $posts = Post::where(['now_date'=> date('Y-m-d'), 'id' => $id, 'premium_post' => 1])->count();
        $postdetails = Post::where(['now_date'=> date('Y-m-d'), 'id' => $id, 'premium_post' => 1])->first();
        $users = User::where('id', Auth::id())->where('type' , '!=', 'GU')->count();
        $likeDetails = Like::where(['user_id'=> Auth::id(), 'post_id' => $id])->count();

        if($likeDetails == 0){
                $like = new Like();
                $like->user_id = Auth::id();
                $like->post_id =$request->id;
                $like->like = 1;
                $like->like_date = date('Y-m-d');
                $like->save();

                if($posts > 0 && $users > 0) {
                    Transaction::create([
                        "user_id" => Auth::id(),
                        "category" => "bp_like_bonus",
                        "amount_type" => "c",
                        "amount" => $this->commission->perUserLikePerDayCommission(),
                        "data" => "",
                        "check_date" => date('y-m-d'),
                        "message" => ucfirst("you get Like Bonus from  level ")
                    ]);


                    if ($this->lastMonthTotalBuy(Auth::id()) >= $this->action_active_value() && Auth::user()->action_active == 1) {
                        if ($postdetails->action_page == 1) {
                            ShoppingVoucherTransaction::create([
                                "user_id" => Auth::id(),
                                "category" => "bp_action_page_like_bonus",
                                "amount_type" => "c",
                                "amount" => $this->action_like_value(),
                                "data" => "",
                                "check_date" => date('y-m-d'),
                                "message" => ucfirst("you get Action page Like Bonus")
                            ]);
                        }

                    } elseif (Auth::user()->created_at >= Carbon::now()->subMonth()) {
                        if ($postdetails->action_page == 1) {
                            ShoppingVoucherTransaction::create([
                                "user_id" => Auth::id(),
                                "category" => "bp_action_page_like_bonus",
                                "amount_type" => "c",
                                "amount" => $this->action_like_value(),
                                "data" => "",
                                "check_date" => date('y-m-d'),
                                "message" => ucfirst("you get Action page Like Bonus")
                            ]);
                        }
                    } else {
                        Toastr::error('Your Action is Inactive! Please Purchase Product Up to:- ' . $this->action_active_value(), 'Error');
                        return redirect()->back();

                    }
                }
            }

        $post = Post::where('id', $id)->first();
        $reactions = DB::table('reactions')->where(['user_id' => Auth::id(), 'reactable_id' => $id])->count();
        $reactionfirst = DB::table('reactions')->where(['user_id' => Auth::id(), 'reactable_id' => $id])->first();
        if($reactions){
            broadcast(new LikeEvent($post->id, $reactionfirst->type, $request->reaction))->toOthers();

        }else{
            broadcast(new LikeEvent($post->id, null, $request->reaction))->toOthers();

        }
        return $post->toggleReaction($request->reaction);


    }


    public function lastMonthTotalBuy($userId){
        return EcoOrder::where(['user_id'=> $userId, 'order_status' => 'complete'])->where('created_at', '>=', Carbon::now()->subMonth())->pluck('order_amount')->sum();
    }


    public function action_active_value(){
        return AdminSetting::where('setting_name', 'Action Active Setting')->pluck('setting_value')->sum();
    }

    public function action_like_value(){
        $like = AdminSetting::where('setting_name', 'Daily Action Bonus Shopping Wallet')->first();
        $like = explode(",", $like->setting_value);
        return $like[0];

    }

    public function action_comment_value(){
        $like = AdminSetting::where('setting_name', 'Daily Action Bonus Shopping Wallet')->first();
        $like = explode(",", $like->setting_value);
        return $like[1];
    }

    public function getReaction($id, $user){
//        $post = Post::where('id', $id)->first();
        $react = DB::table('reactions')->where('user_id', $user)->where('reactable_id', $id)->first();
        return response()->json($react->type);
    }


    public function summaryReactions($id){
        $post = Post::where('id', $id)->first();
//       return $post->reaction_summary;
        return response()->json($post->reaction_summary);
    }


    public function likeReactUser($id){
        $likeReactUserLike = Reaction::select('id', 'user_id', 'reactable_id', 'type')->with('user')->where('reactable_id', $id)->get();
        return response()->json(
            $likeReactUserLike
        );
    }

    public function likeReactUserLove($id, $reaction){
        $likeReactUserLike = Reaction::select('id', 'user_id', 'reactable_id', 'type')->with('user')->where(['reactable_id'=> $id, 'type'=>$reaction])->paginate(6);
        return $likeReactUserLike;

    }











    //comment section

    public function userMainComment(Request $request){

        $comments = Comment::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
//        $posts = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->post_id, 'premium_post' => 1])->count();
        $postget = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->post_id, 'premium_post' => 1])->first();
        $postaction = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->post_id, 'premium_post' => 1, 'action_page' => 1])->count();


        if($comments){
            return response()->json(['message' => 'Your are already comment this post!']);
        }else{
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->post_id = $request->post_id;
            $comment->body = $request->body;
            $comment->save();

            broadcast(new CommentEvent( $request->post_id, Auth::id(), $request->body))->toOthers();

            Transaction::create([
                "user_id"=> Auth::id(),
                "category" => "bp_comment_bonus",
                "amount_type" => "c",
                "amount" => $this->commission->perUserCommentPerDayCommission(),
                "data" => "",
                "check_date" => date('y-m-d'),
                "message" => ucfirst("you get Comment Bonus ")
            ]);

            if ($postaction == 1){
                if($this->lastMonthTotalBuy(Auth::id()) >= $this->action_active_value() && Auth::user()->action_active === 1){

                    ShoppingVoucherTransaction::create([
                        "user_id"=> Auth::id(),
                        "category" => "bp_action_page_comment_bonus",
                        "amount_type" => "c",
                        "amount" => $this->action_comment_value(),
                        "data" => "",
                        "check_date" => date('y-m-d'),
                        "message" => ucfirst("you get Action page Comment Bonus")
                    ]);


                }elseif(Auth::user()->created_at >= Carbon::now()->subMonth()){

                    ShoppingVoucherTransaction::create([
                        "user_id"=> Auth::id(),
                        "category" => "bp_action_page_comment_bonus",
                        "amount_type" => "c",
                        "amount" => $this->action_comment_value(),
                        "data" => "",
                        "check_date" => date('y-m-d'),
                        "message" => ucfirst("you get Action page Comment Bonus")
                    ]);

//                    return response(new CommentResource($comment), Response::HTTP_CREATED);

                }else{
                    Toastr::error('Your Action is Inactive! Please Purchase Product Up to:- '.$this->action_active_value(), 'Error');
                    return response()->json(['comment' => new CommentResource($comment), 'message' => 'Your Action is Inactive! Please Purchase Product Up to:- '.$this->action_active_value()]);
                }
            }

            return response()->json(['comment' => new CommentResource($comment)]);
        }
    }

    public function getUserMainComment($id){
        $comments = Comment::where('post_id', $id)->with('user', 'replies')->orderByDesc('id')->paginate(6);
        return CommentResource::collection($comments);
    }


    public function getUserSingleComment($id){
        $comments = Comment::where('id', $id)->with('user', 'replies')->orderByDesc('id')->paginate(6);
        return response(CommentResource::collection($comments));
    }






    public function newReplyComment(Request $request, $id){
        $replyComment = new CommentRepliy();
        $replyComment->user_id = $request->user_id;
        $replyComment->post_id = $request->post_id;
        $replyComment->comment_id = $id;
        $replyComment->message = $request->message;
        $replyComment->save();
        $comment = Comment::where('id', $id)->get();
        broadcast(new CommentEvent( $request->post_id, Auth::id(), $request->message))->toOthers();
        return response(CommentResource::collection($comment));
    }








    public function toggleCommentReaction(Request $request){
        $commentRecd = CommentReaction::where(['user_id'=> $request->user_id, 'comment_id' => $request->comment_id, 'type' => $request->reaction])->first();

        if($commentRecd){
            broadcast(new LikeEvent($commentRecd->comment_id, $commentRecd->type, $request->reaction))->toOthers();

            $commentRecd->delete();
        }else{
            $commentRec = CommentReaction::where(['user_id'=> $request->user_id, 'comment_id' => $request->comment_id])->first();

            if($commentRec){
                broadcast(new LikeEvent($commentRec->comment_id, $commentRec->type, $request->reaction))->toOthers();

                $commentRec->delete();
                $commentReact = new CommentReaction();
                $commentReact->user_id = $request->user_id;
                $commentReact->comment_id = $request->comment_id;
                $commentReact->type = $request->reaction;
                $commentReact->save();
            }else {

                $commentReact = new CommentReaction();
                $commentReact->user_id = $request->user_id;
                $commentReact->comment_id = $request->comment_id;
                $commentReact->type = $request->reaction;
                $commentReact->save();
                broadcast(new LikeEvent( $request->comment_id, null, $request->reaction))->toOthers();

            }



        }



    }

    public function getCommentReaction($id, $user){
        $react = CommentReaction::where('user_id', $user)->where('comment_id', $id)->first();
        return response()->json($react->type);
    }

    public function getCommentReactionAllUsers($id){
        $users = CommentReaction::where(['comment_id'=> $id])->with('user')->get();
        return $users;
    }






}
