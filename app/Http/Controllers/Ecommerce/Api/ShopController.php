<?php

namespace App\Http\Controllers\Ecommerce\APi;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopCollection;
use Illuminate\Http\Request;
use App\Model\Ecommerce\EcoShop;
use DB;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index(EcoShop $shops)
    {
        $search = request()->query('search') ?? null;

        if($search) {
            return ShopCollection::collection(EcoShop::where('status', 1)->where('shop_name', 'like', '%' . $search . '%')->get());
        }
        return ShopCollection::collection(EcoShop::real()->get());
    }
    public function create()
    {
        return view('ecommerce.shops.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            "shop_name" => ["required"],
            "shop_address" => ["required"],
            "shop_image" => ["required"],
        ]);

        if($request->hasFile('shop_image')){
            $product_id =  EcoShop::insertGetId([
                  'shop_name'       =>  $request->shop_name,
                  'shop_address'    =>  $request->shop_address,
                  'vendor_id'       =>  $request->vendor_id,

              ]);

              $path = $request->file('shop_image')->store('shop');
              EcoShop::find($product_id)->update([
                 'shop_image'=> $path
               ]);
                 return back()->with('success', 'Shop added Succesfully');
            }


    }
    public function show($id)
    {

        return ShopCollection::collection(EcoShop::where([
            'id' => $id,
            'status' => 1
        ])->get());
    }
    public function edit(EcoShop $shop)
    {
        return view('ecommerce.shops.edit',compact('shop'));

            // $shop_info = EcoShop::findOrFail($id);
            // return view('ecommerce.shops.edit',compact('shop_info'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "shop_name" => ["required"],
            "shop_address" => ["required"],
        ]);

        $ecoshops = EcoShop::find($id);

        $ecoshops->shop_name =  $request->get('shop_name');
        $ecoshops->shop_address = $request->get('shop_address');

        $ecoshops->save();


        // $g = $request->shop_name;
        // echo $g;
        // $myshops->update($request->all());
        return redirect()->route('shops.index')
                        ->with('success','Shops updated successfully');
    }
    public function destroy($id)
    {
        $ecoshops=EcoShop::find($id);
        $ecoshops->delete();

        // $myshops->delete();

        return redirect()->route('shops.index')
                        ->with('success','Shop deleted successfully');
    }
    public function shopToproduct($id)
    {
        $data = EcoShop::where('id', $id)->first()->shopToProducts->makeHidden(['updated_at', 'created_at', 'vendor_id','category_id','category_id','subcategory_id']);
        return  $data;
    }




}
