<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Zone;
use App\Model\CreatePage;
use App\Model\Post\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PagePostController extends Controller
{
    public function createPost(){
        $pages = CreatePage::all();
        $page = array();
        foreach ($pages as $pag){
            $admin_id = explode(",", $pag->admin_id);

            for ($i = 0; $i<count($admin_id); $i++){
                if($admin_id[$i] == Auth::id()){
                    $page[] = CreatePage::where('admin_id',$pag->admin_id)->get();
                }else{
                    continue;
                }
            }

            $subAdmin_id = explode(",", $pag->sub_admin_id);
            for ($j = 0; $j < count($subAdmin_id); $j++){
                if($subAdmin_id[$j] == Auth::id()){
                    $page[] = CreatePage::where('sub_admin_id',$pag->sub_admin_id)->get();
                }else{
                    continue;
                }
            }
        }



//        $page = json_decode(json_encode($page));
//        echo "<pre>";print_r($page); die;
        return view('admin.page-post.create', compact('page'));
    }

    public function addPagePost(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $request->validate([
                'page_name' => 'required',
                'post_title' => 'required',
            ]);


            $post = Post::latest()->first();
            $post_id = $post->id +1;

            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/post/page/'.$post_id;
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }
                $large_image_path = "media/post/page/".$post_id."/".$filename;
                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = '';
            }

            $post = new Post();
            $post->user_id = Auth::id();
            $post->page_id = $data['page_name'];
            $post->post_url = Str::slug($data['post_title']);
            $post->body = $data['post_title'];
            $post->media = $filename;
            $post->premium_post = 0;
            $post->now_date = date('Y-m-d');
            $post->action_page = 0;
            $post->save();
            return redirect()->back();
        }
    }


    public function view(){

        $pages = CreatePage::all();
        $pagea = [];
        foreach ($pages as $pag){
            $admin_id = explode(",", $pag->admin_id);

            for ($i = 0; $i<count($admin_id); $i++){
                if($admin_id[$i] == Auth::id()){
                    $pagea = CreatePage::where('admin_id',$pag->admin_id)->get();
                }else{
                    continue;
                }
            }

            $subAdmin_id = explode(",", $pag->sub_admin_id);
            for ($j = 0; $j < count($subAdmin_id); $j++){
                if($subAdmin_id[$j] == Auth::id()){
                    $pagea = CreatePage::where('sub_admin_id',$pag->sub_admin_id)->get();
                }else{
                    continue;
                }
            }
        }
        return view('admin.page-post.post', compact('pagea'));
    }



    public function viewPagePost($id){
        $posts = Post::where(['user_id'=> Auth::id(), 'page_id' => $id])->with('page', 'user')->get();
        return view('admin.page-post.page_post', compact('posts'));
    }


    public function editPagePost(Request $request, $id){

        $post = Post::where(['id'=> $id, 'user_id'=> Auth::id()])->first();

        $pages = CreatePage::all();
        $page = array();
        foreach ($pages as $pag){
            $admin_id = explode(",", $pag->admin_id);

            for ($i = 0; $i<count($admin_id); $i++){
                if($admin_id[$i] == Auth::id()){
                    $page[] = CreatePage::where('admin_id',$pag->admin_id)->get();
                }else{
                    continue;
                }
            }

            $subAdmin_id = explode(",", $pag->sub_admin_id);
            for ($j = 0; $j < count($subAdmin_id); $j++){
                if($subAdmin_id[$j] == Auth::id()){
                    $page[] = CreatePage::where('sub_admin_id',$pag->sub_admin_id)->get();
                }else{
                    continue;
                }
            }
        }

        $data = $request->all();
        if($request->isMethod('post')){
            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                if (isset($post->media)){
                    $large_image_path = "media/post/page/".$post->id."/".$post->media;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }

                $large_image_path = "media/post/page/".$post->id."/".$filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = $data['current_image'];
            }


            Post::where('id', $id)->update(['page_id' => $data['page_name'], 'body' => $data['post_title'], 'media' => $filename]);
        }

        return view('admin.page-post.edit_page_post', compact('post', 'page'));
    }


    public function deletePagePost($id){
        $deletePost = Post::where('id', $id)->first();
        $directory = "media/post/page/".$id;
        File::deleteDirectory(public_path($directory));
        $deletePost->delete();
        return redirect()->back();
    }



public function editUserPost(Request $request, $id){
    $page = CreatePage::where('id', $id)->first();

    if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'page_name' => 'required',
                'category_name' => 'required',
                'sub_admin_id' => 'required',
            ]);

            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }
                if (isset($page->image)){
                    $large_image_path = "media/page/".$page->image;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }
                $large_image_path = "media/page/".$filename;
                // Resize Image
                Image::make($image_tmp)->save($large_image_path);

            }else{
                $filename = $request->current_image;
            }


            $sub_admin_id = implode(",", $data['sub_admin_id']);
            CreatePage::where('id', $id)->update(['sub_admin_id' => $sub_admin_id, 'page_name' => $data['page_name'], 'category_name' => $data['category_name'], 'page_description' => $data['page_description'], 'image' => $filename]);
            return redirect()->back();
        }
        $users = User::all();
        return view('admin.page-post.page_edit', compact('page','users'));
    }



    public function deleteUserPost($id){
        CreatePage::where('id', $id)->delete();
        $posts = Post::where('page_id', $id)->get();
        foreach ($posts as $post){
            $directory = "media/post/page/".$id;
            File::deleteDirectory(public_path($directory));
            $post->delete();
        }
        return redirect()->back();
    }








}
