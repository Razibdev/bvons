<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Zone;
use App\Model\CreatePage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function index(){
        $zones = Zone::with("districts")->get();
        $district = District::with("thanas")->get();
        $thanas = Thana::with("villages")->get();
        $users = User::all();
        return view('admin.page.index', compact('zones', 'district', 'thanas', 'users'));
    }


    public function addPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'page_name' => 'required',
                'category_name' => 'required',
                'admin_id' => 'required',
                'sub_admin_id' => 'required',
                'media' => 'required',
            ]);

            if($request->hasFile('media')){
                $image_tmp = $request->file('media');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $large_image_path = "media/page/".$filename;
                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }

            $admin_id = implode(",", $data['admin_id']);
            $sub_admin_id = implode(",", $data['sub_admin_id']);
            $page = new CreatePage();
            $page->admin_id = $admin_id;
            $page->sub_admin_id =  $sub_admin_id;
            $page->page_name = $data['page_name'];
            $page->category_name = $data['category_name'];
            $page->page_description = $data['page_description'];
            $page->image = $filename;
            $page->save();
            return redirect()->back();
        }
    }

    public function view(){
        $pages = CreatePage::get();
        return view('admin.page.page_view', compact('pages'));
    }


    public function editPage(Request $request, $id){
        $page = CreatePage::where('id', $id)->first();

        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'page_name' => 'required',
                'category_name' => 'required',
                'admin_id' => 'required',
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

            $admin_id = implode(",", $data['admin_id']);
            $sub_admin_id = implode(",", $data['sub_admin_id']);

            CreatePage::where('id', $id)->update(['admin_id' => $admin_id, 'sub_admin_id' => $sub_admin_id, 'page_name' => $data['page_name'], 'category_name' => $data['category_name'], 'page_description' => $data['page_description'], 'image' => $filename]);
            return redirect()->back();
        }
        $users = User::all();
        return view('admin.page.page_edit', compact('page','users'));
    }


    public function deletePage($id){
        $deletePost = CreatePage::where('id', $id)->first();
        $large_image_path = "media/page/".$deletePost->image;

        if(File::exists($large_image_path)){
            File::delete($large_image_path);
        }

        $deletePost->delete();
        return redirect()->back();
    }
}
