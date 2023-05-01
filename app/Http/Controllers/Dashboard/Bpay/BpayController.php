<?php

namespace App\Http\Controllers\Dashboard\Bpay;

use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\BpayCategory;
use App\Model\BpayMarchantShop;
use App\Model\Marchant;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BpayController extends Controller
{
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'category_name' => 'required',
                'logo' => 'required',
            ]);

            if($request->hasFile('logo')){
                $image_tmp = $request->file('logo');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $large_image_path = "bpay/category/".$filename;

                Image::make($image_tmp)->resize(150, 150)->save($large_image_path);
            }else{
                $filename = '';
            }


            $category = new BpayCategory();
            $category->category_name = $data['category_name'];
            $category->category_image = $filename;
            $category->save();
            Toastr::success('Bpay Category Added Successfully Done', 'Success');
            return redirect()->back();

        }

        return view('dashboard.bpay.add_category');
    }


    public function viewCategory(){
        $categories = BpayCategory::get();
        return view('dashboard.bpay.view_category', compact('categories'));
    }


    public function editCategory(Request $request, $id){
        $category = BpayCategory::where('id', $id)->first();
        if($request->isMethod('post')){
            $request->validate([
                'category_name' => 'required'
            ]);


            if($request->hasFile('logo')){
                $image_tmp = $request->file('logo');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;

                }
                if (isset($category->category_image)){
                    $large_image_path = "bpay/category/".$category->category_image;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }

                $large_image_path = "bpay/category/".$filename;

                // Resize Image
                Image::make($image_tmp)->resize(150, 150)->save($large_image_path);

            }else{
                $filename = $request->current_image;
            }

            BpayCategory::where('id', $id)->update(['category_name' => $request->category_name, 'category_image' => $filename]);
            return redirect('/dashboard/bvon-pay/bpay-view-categories');

        }
        return view('dashboard.bpay.edit_category', compact('category'));
    }




public function deleteCategory(Request $request){
    $category = BpayCategory::where('id', $request->id)->first();
    if (isset($category->category_image)){
        $large_image_path = "bpay/category/".$category->category_image;

        if(File::exists($large_image_path)){
            File::delete($large_image_path);
        }
    }

    $category->delete();
    return response()->json();
}



public function addMarchantShop(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'category_name' => 'required',
                'organize_name' => 'required',
                'organize_address' => 'required',
                'mobile' => 'required',
                'percentage' => 'required',
                'logo' => 'required',
                'username' => 'required',
                'district' => 'required',
                'upazilla' => 'required',
            ]);

            if($request->hasFile('logo')){
                $image_tmp = $request->file('logo');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $large_image_path = "bpay/marchant_shop/".$filename;

                Image::make($image_tmp)->resize(150, 150)->save($large_image_path);
            }else{
                $filename = '';
            }

            $marchant = new BpayMarchantShop();
            $marchant->category_id = $request->category_name;
            $marchant->user_id = $request->username;
            $marchant->district_id = $request->district;
            $marchant->thana_id = $request->upazilla;
            $marchant->name = $request->organize_name;
            $marchant->address = $request->organize_address;
            $marchant->mobile = $request->mobile;
            $marchant->percentage = $request->percentage;
            $marchant->logo = $filename;
            $marchant->save();

            $marchantBalance = Marchant::where('user_id', $request->username)->count();

            if($marchantBalance == 0){
                $user = User::where('id', $request->username)->first();
                $datas = explode("-", date('d-m-Y'));
                $merchant = new Marchant();
                $merchant->user_id = $request->username;
                $merchant->referral_id = $user->referral_id;
                $merchant->address = $data['organize_address'];
                $merchant->merchant_name = $data['organize_name'];
                $merchant->password = bcrypt('123456');
                $merchant->merchant_account = $datas[0].$datas[1].$datas[2]. rand(1111, 9999);
                $merchant->payment_charge = $data['percentage'];
                $merchant->save();
            }


            Toastr::success('New More Add Marchant Shop', 'Success');
            return redirect()->back();

        }
        $categories = BpayCategory::get();
        $users = User::where('type','!=', 'GU')->get();
        $districts = District::all();
        return view('dashboard.bpay.add_marchant_shop', compact('categories', 'users', 'districts'));
}



    public function viewMarchantShop(){
        $marchants = BpayMarchantShop::with('category')->get();
//        $marchants = json_decode(json_encode($marchants));
//        echo "<pre>";print_r($marchants);die;

        return view('dashboard.bpay.view_marchant_shop', compact('marchants'));
    }


    public function editMarchantShop(Request $request, $id){
        $marchant = BpayMarchantShop::where('id', $id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'organize_name' => 'required',
                'organize_address' => 'required',
                'mobile' => 'required',
                'percentage' => 'required'
            ]);

            if($request->hasFile('logo')){
                $image_tmp = $request->file('logo');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                if (isset($marchant->logo)){
                    $large_image_path = "bpay/marchant_shop/".$marchant->logo;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }

                $large_image_path = "bpay/marchant_shop/".$filename;

                Image::make($image_tmp)->resize(150, 150)->save($large_image_path);
            }else{
                $filename = $request->current_image;
            }

            BpayMarchantShop::where('id', $id)->update(['category_id' => $request->category_name,'name' => $data['organize_name'], 'address' => $data['organize_address'], 'mobile' => $data['mobile'], 'percentage' => $data['percentage'], 'logo' => $filename, 'user_id' => $data['username'], 'district_id' => $data['district'], 'thana_id' => $data['upazilla']]);


            Toastr::success('Update Marchant Shop', 'Success');
            return redirect('/dashboard/bvon-pay/view-marchant-shop');

        }
        $categories = BpayCategory::get();
        $users = User::where('type','!=', 'GU')->get();
        $districts = District::all();
        return view('dashboard.bpay.edit_marchant_shop', compact('marchant', 'categories', 'users', 'districts'));
    }


    public function deleteMarchantShop(Request $request){
        $marchant = BpayMarchantShop::where('id', $request->id)->first();
        if (isset($marchant->logo)){
            $large_image_path = "bpay/marchant_shop/".$marchant->logo;

            if(File::exists($large_image_path)){
                File::delete($large_image_path);
            }
        }

        $marchant->delete();
        return response()->json();
    }








}
