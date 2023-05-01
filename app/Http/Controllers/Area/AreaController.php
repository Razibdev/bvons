<?php

namespace App\Http\Controllers\Area;

use App\Http\Controllers\Controller;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Area\Village;
use App\Model\Area\Zone;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $zone_list = Zone::all();
        return view('ecommerce.b-dealer.index', compact('zone_list'));
    }
    public function districtCreate()
    {
        return view('ecommerce.b-dealer.district_thana_create')->with([
            'district_list' => District::all(),
            'zone_list' => Zone::all(),
            'thana_list' => Thana::all(),
        ]);
    }
    public function storeDistrictThana(Request $request)
    {
        if($request->query('req') == 'zone') {
            $request->validate([
                "zone_name" => "required|max:80|unique:zones,name"
            ]);
            Zone::create([
                "name" => $request->zone_name
            ]);
            return back()->with(["success" => "Zone has been created successfully"]);
        } else if($request->query('req') == 'district') {
            $request->validate([
                "zone_name_select" => "required|integer",
                "district_name" => "required|max:80|unique:districts,name"
            ]);
            District::create([
                "zone_id" => $request->zone_name_select,
                "name" => $request->district_name
            ]);
            return back()->with(["success" => "District has been created successfully"]);
        } else if($request->query('req') == 'thana') {
            $request->validate([
                "district_name_select" => "required|integer",
                "thana_name" => "required|max:80|unique:thanas,name"
            ]);
            Thana::create([
                "district_id" => $request->district_name_select,
                "name" => $request->thana_name,
            ]);
            return back()->with(["success" => "Thana has been created successfully"]);
        } else if($request->query('req') == 'village') {
            $request->validate([
                "thana_name_select" => "required|integer",
                "village_name" => "required|max:80|unique:villages,name"
            ]);
            Village::create([
                "thana_id" => $request->thana_name_select,
                "name" => $request->village_name,
            ]);
            return back()->with(["success" => "Village has been created successfully"]);
        }

    }


    /* api methods */
    public function areaApi()
    {

        return Zone::with(['districts' => function($query){
            return $query->with(['thanas' => function($query){
                return $query->with('villages');
            }]);
        }])->get();
    }


    /*ajax methods*/
    public function ajaxGetDistricts(Request $request) {
        $zone = Zone::where('id', $request->query('zone_id'));
        if($zone->count() < 1) return response()->json('zone not found', 404);
        return $zone->first()->districts;
    }

    public function ajaxGetThanas(Request $request) {
        $district = District::where('id', $request->query('district_id'));
        if($district->count() < 1) return response()->json('zone not found', 404);
        return $district->first()->thanas;
    }

    public function ajaxGetVillages(Request $request) {
        $thana = Thana::where('id', $request->query('thana_id'));
        if($thana->count() < 1) return response()->json('zone not found', 404);
        return $thana->first()->villages;
    }


}
