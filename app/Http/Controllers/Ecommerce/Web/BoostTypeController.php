<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\BoostType;
use App\Http\Controllers\Controller;
use App\Model\PageBoost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoostTypeController extends Controller
{
    public function addBoostType(Request $request){
        if($request->isMethod('post')){

            $data = $request->all();
            $request->validate([
                'boost_name' => 'required'
            ]);

            $boost = new BoostType();
            $boost->boost_name= $data['boost_name'];
            $boost->save();
            return redirect('/boost-type/view-type');
        }
        return view('admin.boost_type.boost_type_add');
    }


    public function viewBoostType(){
        $boosts = BoostType::orderBy('id','desc')->get();
        return view('admin.boost_type.boost_type', compact('boosts'));
    }


    public function editBoostType(Request $request, $id){

        $boost = BoostType::where('id', $id)->first();
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'boost_name' => 'required'
            ]);

            BoostType::where('id', $id)->update(['boost_name'=> $data['boost_name']]);
            return redirect('/boost-type/view-type');
        }
        return view('admin.boost_type.edit_boost_type', compact('boost'));
    }


    public function deleteBoostType($id){
        BoostType::where('id', $id)->delete();
        return redirect()->back();
    }




    public function boostHistoryView(){
        $boosts = PageBoost::with('user', 'page','boost')->get();
        return view('admin.boost.boost_history', compact('boosts'));
    }






}
