<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\EcoShop;
use DB;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        $shops = EcoShop::where('vendor_id', auth()->user()->id)->get();
        return view('ecommerce.shops.index',compact('shops'));
    }


    public function shopPending()
    {
        $shops = EcoShop::where('status', 0)->get();
        return view('ecommerce.shops.admin.pending',compact('shops'));
    }

    public function shopAccepted()
    {
        $shops = EcoShop::where('status', 1)->get();
        return view('ecommerce.shops.admin.accepted',compact('shops'));
    }

    public function shopAll()
    {
        $shops = EcoShop::all();
        return view('ecommerce.shops.admin.all',compact('shops'));
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
        if($request->hasFile('shop_image')) {
            $product_id =  EcoShop::insertGetId([
                'shop_name'    =>$request->shop_name,
                'shop_address'    =>$request->shop_address,
                'vendor_id'    =>$request->vendor_id,
                'url'       =>  Str::slug($request->shop_name)

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
        //
    }


    public function edit(EcoShop $shop)
    {
        return view('ecommerce.shops.edit',compact('shop'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "shop_name" => ["required"],
            "shop_address" => ["required"],
        ]);

        $path = null;
        $shop = EcoShop::find($id);
        if($request->hasFile('shop_image')) $path = $request->file('shop_image')->store('shop');
        $shop->update([
            'shop_name'     => $request->shop_name,
            'shop_address'  => $request->shop_address,
            "priority"      => $request->has('shop_priority') ? $request->shop_priority : $shop->priority,
            'shop_image'    => $path ?? $shop->shop_image
        ]);
        return back()->with('success','Shops updated successfully');
    }


    public function destroy($id)
    {
        $ecoshops=EcoShop::find($id);
        $ecoshops->delete();
        return redirect()->back()->with('success','Shop deleted successfully');
    }


    public function acceptShop(EcoShop $id)
    {
        $id->status = 1;
        $id->save();
        return redirect()->back()->with('success','Shop Approved Successful');

    }


    public function updateShopUrl(Request $request){
        EcoShop::where('id', $request->id)->update(['url' => Str::slug($request->url)]);
        return response()->json();

    }


}
