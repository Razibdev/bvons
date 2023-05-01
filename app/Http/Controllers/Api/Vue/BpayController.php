<?php

namespace App\Http\Controllers\Api\Vue;

use App\Http\Controllers\Controller;
use App\Model\BpayCategory;
use App\Model\BpayMarchantShop;
use Illuminate\Http\Request;

class BpayController extends Controller
{
    public function bpayCategory(){
        return BpayCategory::get();
    }

    public function bpayServiceList($id){
        return BpayMarchantShop::where('category_id', $id)->get();
    }

    public function bpayServiceFilterDistrict(Request $request){
        return BpayMarchantShop::where('district_id', $request->district_id)->get();
    }

     public function bpayServiceFilterThana(Request $request){
            return BpayMarchantShop::where('thana_id', $request->thana_id)->get();
     }

    public function bpayServiceFilterPhone($phone){
        \Log::info($phone);
            $searchWildcard = '%' . $phone . '%';
            return BpayMarchantShop::where('mobile', 'LIKE', $searchWildcard)->get();
    }







}
