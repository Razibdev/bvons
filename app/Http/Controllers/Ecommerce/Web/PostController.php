<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
//use App\KuHelpers\UploadFacades\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Upload;
use App\Model\Comment\Comment;
use App\Model\Post\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function post(){
        $posts = Post::with('user', 'likes', 'comment')->where('deleted_at', null)->orderByDesc('id')->get();
//        $posts = json_decode( json_encode($posts));
//        echo "<pre>"; print_r($posts); die;
        return view('post.post', compact('posts'));
    }



    public function addPost(Request $request){
        $post = Post::latest()->first();
        $post_id = $post->id+1;
//       echo "<pre>"; print_r($post_id); die;
        if($request->isMethod('post')){

            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/post/'. 21 .'/' .$post_id;
                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0777, true, true);

                }

                $large_image_path = "media/post/". 21 ."/".$post_id."/".$filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }

            if(empty($request->premium)){
                $premium = 0;
            }else{
                $premium = 1;

            }


            if(empty($request->action_page)){
                $action = 0;
            }else{
                $action = 1;

            }

            Post::create(['user_id'=> 21, 'body' => $request->body, 'media' => $filename, 'post_url'=> Str::slug($request->body), 'premium_post'=> $premium, 'action_page'=> $action, 'now_date'=> date('Y-m-d')]);
            return redirect()->back();
        }
    }


    public function comment(){
        $comments = Comment::with( 'user','post')->orderByDesc('id')->get();
//        $comments = json_decode(json_encode($comments));
//        echo "<pre>"; print_r($comments); die;
        return view('post.comment', compact('comments'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function editPost(Request $request, $id){
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

            Post::where('id',$id)->update(['body' => $request->body, 'media' => $filename]);
            return redirect()->back();
        }

    }

    public function postHide($id){
        Post::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->back();
    }

    public  function postHideShow(){
        $posts = Post::where('deleted_at' , '!=', NULL)->get();
        return view('post.hide_post', compact('posts'));
    }


    public function postRestore($id){
        Post::where('id', $id)->update(['deleted_at' => NULL]);
        return redirect()->back();
    }


    public function deletePost($id){
        $deletePost = Post::where('id', $id)->first();
        $directory = "media/post/".$deletePost->user_id."/".$id;
        File::deleteDirectory(public_path($directory));
        $deletePost->delete();
        return redirect()->back();
    }



    public function editComment(Request $request, $id){
        if($request->isMethod('post')){
            Comment::where('id',$id)->update(['body' => $request->body]);
            return redirect()->back();
        }
    }


    public function deleteComment($id){
        Comment::where('id', $id)->delete();
        return redirect()->back();
    }





}
