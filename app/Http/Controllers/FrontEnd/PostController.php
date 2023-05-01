<?php

namespace App\Http\Controllers\FrontEnd;

use App\App\Model\ComisionBonus;
use App\App\Model\CommissionRegister;
use App\App\Model\Share;
use App\Http\Controllers\Controller;
use App\Modal\CommissionRelation;
use App\Model\Comment\Comment;
use App\Model\CommentRepliy;
use App\Model\Like;
use App\Model\Post\Post;
use App\Model\ShoppingVoucherTransaction;
use App\Model\Transaction\Transaction;
use App\Model\User\UserVerificationDetail;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    private  $commission ;

    public function __construct()
    {
        $this->commission = new CommissionRelation();
    }


    public function index(){
        $posts = Post::with('user', 'comments', 'replies', 'likes')->orderByDesc('id')->where('user_id', Auth::id())->get();
        $userDetails = User::where('id', Auth::id())->first();
        $sscInformation = UserVerificationDetail::where('user_id', Auth::id())->count();
        $sscInformationd = UserVerificationDetail::where('user_id', Auth::id())->first();
//        $posts = json_decode(json_encode($posts), true);
//        echo "<pre>"; print_r($posts); die;
        return view('frontend.social.post', compact('posts', 'userDetails', 'sscInformation', 'sscInformationd'));
    }




    public function updateUserInformation(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            User::where('id', Auth::id())->update(['name' => $data['name'], 'occupation' => $data['occupation'], 'birthday' => $data['birthday'], 'gender' => $data['gender'],'religion' => $data['religion'], 'lives_in' => $data['lives_in'], 'hometown' => $data['hometown']]);
            return redirect()->back();
        }
    }

    public function postEdit(Request $request, $id){
        $post = Post::where('id', $id)->first();
//        echo "<pre>"; print_r($request->all()); die;
        if($request->isMethod('post')){

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
                $filename = $request->current_image;
            }

            Post::where(['id'=>$id, 'user_id' => Auth::id()])->update(['body' => $request->body, 'media' => $filename]);
            return redirect()->back();
        }
    }


    public function deletePostOnuser($id){
        Post::where('id', $id)->delete();
        return redirect()->back();
    }




    public function commentPost(Request $request, $id){
        $commentsReplay = new CommentRepliy();
        $commentsReplay->comment_id = $id;
        $commentsReplay->user_id = Auth::id();
        $commentsReplay->post_id = $request->post_id;
        $commentsReplay->message = $request->comment;
        $commentsReplay->save();
        return redirect()->back();
    }


    public function commentMain(Request $request){
        $posts = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->post_id, 'premium_post' => 1])->count();
        $postget = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->post_id, 'premium_post' => 1])->first();


        if(Auth::user()->type != 'GU' && $posts > 0){
            $commentCount = Comment::where(['user_id'=> Auth::id(), 'post_id'=> $request->post_id])->count();
            if($commentCount == 0){
                $comment = new Comment();
                $comment->user_id = Auth::id();
                $comment->post_id = $request->post_id;
                $comment->body = $request->comment;
                $comment->save();

                Transaction::create([
                    "user_id"=> Auth::id(),
                    "category" => "bp_comment_bonus",
                    "amount_type" => "c",
                    "amount" => $this->commission->perUserCommentPerDayCommission(),
                    "data" => "",
                    "check_date" => date('y-m-d'),
                    "message" => ucfirst("you get Comment Bonus ")
                ]);


                    if($postget->action_page == 1){
                        ShoppingVoucherTransaction::create([
                            "user_id"=> Auth::id(),
                            "category" => "bp_action_page_comment_bonus",
                            "amount_type" => "c",
                            "amount" => 5,
                            "data" => "",
                            "check_date" => date('y-m-d'),
                            "message" => ucfirst("you get Action page Comment Bonus")
                        ]);
                    }


                return redirect()->back();
            }else{
                return redirect()->back();
            }

        }else{
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->post_id = $request->post_id;
            $comment->body = $request->message;
            $comment->save();
            return redirect()->back();
        }

    }


    public function postLike(Request $request){
        $likeDetails = Like::where(['user_id'=> Auth::id(), 'post_id' => $request->postId])->count();
        $likeDetail = Like::where(['user_id'=> Auth::id(), 'post_id' => $request->postId])->first();
        if($likeDetails > 0){
            return response()->json();
        }else{
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id =$request->postId;
            $like->like = $request->isLike;
            $like->save();
            return response()->json();
        }


    }




    public function getSocial(){

        $posts = Post::where('deleted_at', null)->with('user', 'comments', 'replies', 'likes', 'page')->where('action_page','!=', 1)->whereBetween('created_at', [now()->subDays(3), now()])->inRandomOrder()->get();

        $post = Post::with('user', 'comments', 'replies', 'likes')->where('deleted_at', null)->where('action_page', 1)->latest()->first();
        $postCount = Post::with('user', 'comments', 'replies', 'likes')->where('deleted_at', null)->where('action_page', 1)->latest()->count();
        $postp = Post::with('user', 'comments', 'replies', 'likes')->where('deleted_at', null)->where('premium_post', 1)->where('action_page','!=', 1)->latest()->first();
        $postpCount = Post::with('user', 'comments', 'replies', 'likes')->where('deleted_at', null)->where('premium_post', 1)->where('action_page','!=', 1)->latest()->count();
        return view('frontend.social.social', compact('posts', 'post', 'postp', 'postCount', 'postpCount'));
    }



    public function postLikeCommissionHitOk(Request $request){
      $posts = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->id, 'premium_post' => 1])->count();
      $postdetails = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->id, 'premium_post' => 1])->first();
      $users = User::where('id', Auth::id())->where('type' , '!=', 'GU')->count();
        $likeDetails = Like::where(['user_id'=> Auth::id(), 'post_id' => $request->id])->count();

      if($posts > 0 && $users > 0){

          if($likeDetails > 0){
              return response()->json();

          }else{
              $like = new Like();
              $like->user_id = Auth::id();
              $like->post_id =$request->id;
              $like->like = 1;
              $like->like_date = date('Y-m-d');
              $like->save();

              Transaction::create([
                  "user_id"=> Auth::id(),
                  "category" => "bp_like_bonus",
                  "amount_type" => "c",
                  "amount" => $this->commission->perUserLikePerDayCommission(),
                  "data" => "",
                  "check_date" => date('y-m-d'),
                  "message" => ucfirst("you get Like Bonus from  level ")
              ]);


                      if($postdetails->action_page == 1){
                          ShoppingVoucherTransaction::create([
                              "user_id"=> Auth::id(),
                              "category" => "bp_action_page_like_bonus",
                              "amount_type" => "c",
                              "amount" => 5,
                              "data" => "",
                              "check_date" => date('y-m-d'),
                              "message" => ucfirst("you get Action Page like Bonus")
                          ]);
                      }

              return response()->json();
          }

      }else{
          return false;
      }



    }

    public function postLikeGeneralHitOk(Request $request){
        $likeDetails = Like::where(['user_id'=> Auth::id(), 'post_id' => $request->id])->count();

        if($likeDetails > 0){
            Like::where(['user_id'=> Auth::id(), 'post_id' => $request->id])->delete();
            return response()->json();

        }else{
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id =$request->id;
            $like->like = 0;
            $like->save();
            return response()->json();
        }
    }


    public function postCommentGeneralHitOk(Request $request){
        $posts = Post::where(['now_date'=> date('Y-m-d'), 'id' => $request->id, 'premium_post' => 1])->count();
        $users = User::where('id', Auth::id())->where('type' , '!=', 'GU')->count();
        $shareDetails = Share::where(['user_id'=> Auth::id(), 'post_id' => $request->id])->count();
        $postg = Post::where(['id' => $request->id])->count();

        if($posts > 0 && $users > 0){

            if($shareDetails > 0){
                return response()->json();

            }else{
                $share = new Share();
                $share->user_id = Auth::id();
                $share->post_id =$request->id;
                $share->share = 1;
                $share->share_date = date('Y-m-d');
                $share->save();

                Transaction::create([
                    "user_id"=> Auth::id(),
                    "category" => "bp_share_bonus",
                    "amount_type" => "c",
                    "amount" => $this->commission->perUserLikePerDayCommission(),
                    "data" => "",
                    "check_date" => date('y-m-d'),
                    "message" => ucfirst("you get Share Bonus from  level ")
                ]);
                return response()->json();
            }

        }else if($postg == 0){
            $share = new Share();
            $share->user_id = Auth::id();
            $share->post_id =$request->id;
            $share->share = 0;
            $share->share_date = date('Y-m-d');
            $share->save();
            return response()->json();

        }else{
            return false;
        }
    }




    public function addPostOK(Request $request){
        $data = $request->all();
        if(empty($data['body'])){
            $data['body'] = '';
        }

        $post = Post::latest()->first();
        $post_id = $post->id+1;
        if($request->isMethod('post')) {

            if ($request->hasFile('media')) {
                $image_tmp = $request->file('media');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999) . '.' . $extension;

                }

                $path = 'media/post' . '/' . Auth::id() . '/' . $post_id;
                if (!File::isDirectory($path)) {

                    File::makeDirectory($path, 0777, true, true);

                }

                $large_image_path = "media/post/" . Auth::id() . "/" . $post_id . "/" . $filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = '';
            }

            $post = new Post();
            $post->user_id = Auth::id();
            $post->post_url = Str::slug($data['body']);
            $post->body =$data['body'];
            $post->media = $filename;
            $post->premium_post = 0;
            $post->now_date = date('Y-m-d');
            $post->save();
            return redirect()->back();
        }
    }

    public function searchUserListGet(Request $request){
        if($request->get('query')){
            $search_User = $request->get('query');
            $users = User::where(function ($query) use ($search_User){
                $query->where('name', 'like', '%'.$search_User.'%');
                $query->orWhere('phone', 'like', '%'.$search_User.'%');
                $query->orWhere('referral_id', 'like', '%'.$search_User.'%');
            })
                ->get();

            $output = ' <div class="search_user_list">';
            foreach($users as $user)
            {
                $output .= '
                 <div class="search_user.blade.php"><a href="#"><div class="search_list"><img width="65" height="65" src="media/user/profile_pic/'.$user->id.'/'. $user->profile_pic.'" alt=""></div><div class="search_list"><h3>'.$user->name.'</h3></div></a></div>
               ';
            }
            $output .= '</div>';
            echo $output;
        }
    }

    public function getSearchData(Request $request){

        $search_user = $request->get('query');
        $user = User::where(function ($query) use ($search_user){
            $query->where('name', 'like', '%'.$search_user.'%');
            $query->orWhere('phone', 'like', '%'.$search_user.'%');
        })->first();
        $posts = Post::where('user_id', $user->id)->get();
        return view('frontend.social.search_user',compact('user', 'posts'));

    }


    public function updateProfileUser(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'roll'=>'required',
            'registration'=>'required',
            'group'=>'required',
            'year'=>'required',
            'board'=>'required',
            'email'=>'required',
        ]);

        $userVD = UserVerificationDetail::where('user_id', Auth::id())->count();
        if($userVD > 0){
            UserVerificationDetail::where('user_id', Auth::id())->update(['roll'=> $data['roll'], 'reg_num' => $data['registration'], 'board' => $data['board'], 'email' => $data['email'], 'group' => $data['group'], 'year' => $data['year']]);
            Toastr::success('SSC Information Updated Successfully', 'Success');
            return redirect()->back();
        }else{
            Toastr::error('Some Thing Wrong', 'Error');
            return redirect()->back();
        }

    }


}
