<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\Http\Controllers\Controller;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Bdealer\BdealerType;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\EcoShop;
use App\Model\Ecommerce\EcoMedia;
use App\Model\Ecommerce\EcoBrand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use DB;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = EcoProduct::where('vendor_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('ecommerce.products.index',compact('products'));
    }
    public function create()
    {
        $categories = EcoCategory::all();
        $shops = EcoShop::real()->get();
        $brands = EcoBrand::all();
        return view('ecommerce.products.create',compact('categories','shops','brands'));
    }
    public function store(Request $request)
    {

        $request->validate([
            "product_name" => ["required",'max:40'],
            "user_price" => ["required", "numeric"],
            "product_quantity" => ["required", "numeric"],
            "category_id" => ["required", "numeric"],
            "subcategory_id" => ["required", "numeric"],
            "vendor_id" => ["required", "numeric"],
            "shop_id" => ["required", "numeric"],
            "inputFileWithColor" => ["required", "filled"],
            "description" => ["required"],
            "size" => ["required"],
            "product_model" => ["required"],
//            "inputFileWithColor.*.image" => ["required", "dimensions:width=800,height=800", "max:1024"],
            "inputFileWithColor.*.color" => ["required"],
        ],[
            "inputFileWithColor.required" => "Please add a product image with color (min:1 is required)",
            "inputFileWithColor.*.image.dimensions" => "Product Image must be :width x :height",
            "inputFileWithColor.*.image.required" => "Please add a product image with color"
        ]);


        $allMedia = $request->inputFileWithColor;

        $product = EcoProduct::create([
            'product_name'          =>$request->product_name,
            'user_price'            =>$request->user_price,
            'description'           =>$request->description,
            'product_size'          => implode(",",$request->size),
            'product_quantity'      =>$request->product_quantity,
            'category_id'           =>$request->category_id,
            'subcategory_id'        =>$request->subcategory_id,
            'vendor_id'             =>$request->vendor_id,
            'shop_id'               =>$request->shop_id,
            'brand_id'              =>$request->brand_id,
            'product_model'         =>$request->product_model,
            'product_url'         =>Str::slug($request->product_name),
        ]);

        foreach ($allMedia as $media) {
            if(isset($media['image']) && file_exists($media['image']) && isset($media['color'])) {
                $path = $media['image']->storeAs('product', Str::uuid() . '.' . $media['image']->extension());
                $product->media()->create([
                    'product_color'    =>$media['color'],
                    'product_image'=> $path
                ]);
            }
        }


        return back()->with('success','Product Add successfully');
    }
    public function show($id)
    {
         $products = EcoProduct::find($id);
         $medias = EcoProduct::find($id)->media;
        return view('ecommerce.products.single',compact('products','medias'));

    }
    public function edit($id)
    {
        if(!auth()->user()->hasRole('administrator')) {
            if(EcoProduct::findOrFail($id)->product_permision !== "pending") return response("cannot access this page", 500);
        }
        $categories = EcoCategory::all();
        $subcategories = EcoSubCategory::all();
        $shops = EcoShop::all();
        $allbrands = EcoBrand::all();
        $products = EcoProduct::findOrFail($id);
        return view('ecommerce.products.edit',compact('products','categories','subcategories','shops','allbrands'));
    }
    public function update(Request $request, $id)
    {
         $request->validate([
            "product_name"      => ["required",'max:40'],
            "premium_price"     => ["required"],
            "user_price"        => ["required"],
            "product_quantity"  => ["required"],
            "category_id"       => ["required"],
            "subcategory_id"    => ["required"],
            "shop_id"           => ["required"],
            "description"       => ["required"],
            "size"              => ["required"],
            "brand_id"          => ["required"],
            "product_model"     => ["required"],

        ]);
        $size =implode(" ,",$request->input('size'));

        $updated = EcoProduct::where('id',$id)->update([
            'product_name'    =>$request->product_name,
            'premium_price'    =>$request->premium_price,
            'user_price'    =>$request->user_price,
            'description'    =>$request->description,
            'product_quantity'    =>$request->product_quantity,
            'category_id'    =>$request->category_id,
            'subcategory_id'    =>$request->subcategory_id,
            'shop_id'    =>$request->shop_id,
            'product_size'    => $size,
            'brand_id'    =>$request->brand_id,
            'product_model'    =>$request->product_model,
        ]);

        if($updated) return back()->with(["success" => "Product has been updated successfully"]);
        return back()->with(["error" => "Product upadte failed. Please try later"]);

    }
    public function destroy($id)
    {
        $ecoproducts=EcoProduct::find($id);
        $ecoproducts->delete();
        return redirect()->back()
                        ->with('success','Product deleted successfully');
    }
    public function lowstock()
    {
         $products = DB::table('eco_products')
                ->where('vendor_id', auth()->id())
                ->where('product_quantity', '<=', 10)
                ->get();
      //  $products = DB::table('eco_products')->get();
        return view('ecommerce.stock.index',compact('products'));

    }
    public function all_stock()
    {
        //  $products = DB::table('eco_products')
        //         ->where('product_quantity', '<=', 10)
        //         ->get();
        $products = DB::table('eco_products')->where('vendor_id', auth()->id())->get();
        return view('ecommerce.stock.index',compact('products'));

    }
    public function multi()
    {
    // echo "Sdfg";
    // $data = EcoProduct::where('product_promote', 'yes')->paginate(5);
    // return $data;
     return view('ecommerce.products.multiple');
    }
    public function multiSubmit(Request $request)
    {
     $files = $request->file('product_images');
     foreach($files as $file){
         $timestamp = time();
       $filename   = $timestamp . "jpg";
       $file->move(public_path('product'),$filename);
     }
     return 'success';
    }
    public function productsNewAdd($id,$quantity)
    {
    EcoProduct::find($id)->increment('product_quantity',$quantity);
     return back();
    }
    public function mediadelete($id)
    {

    $media=EcoMedia::find($id);
    $media->delete();
    return redirect()->back()
                    ->with('success','Media deleted successfully');
    }
    public function mediaedit($id)
    {
    $media= EcoMedia::find($id);
    return view('ecommerce.products.media_edit',compact('media'));

    }
    public function mediaAddNew(Request $request)
    {
    $request->validate([
        "color" => ["required"],
        "product_image" => ["required"],
    ]);
    $color = $request->input('color');
    $productid = $request->input('productid');
    if($request->hasFile('product_image')){
          $path = $request->file('product_image')->store('product');
             EcoMedia::insert([
                       'product_color'    =>$color,
                        'product_id'    =>$productid,
                        'product_image'=> $path
                        ]);
             return redirect()->back()
                    ->with('success','Media deleted successfully');
        }

    }
    public function mediaupdate(Request $request,$id)
    {
    $request->validate([
        "product_color" => ["required",'max:40'],
    ]);
    // $ma = $request->all();
    // return $ma;

    if($request->hasFile('product_image')){
    $path = $request->file('product_image')->store('product');
    EcoMedia::where('id',$id)->update([
    'product_color'    =>$request->product_color,
    'product_image'    => $path,
    ]);
    return redirect()->back()
                    ->with('success','Media Updated successfully');
    }else{
    EcoMedia::where('id',$id)->update([
    'product_color'    =>$request->product_color,
    ]);
    return redirect()->back()
                    ->with('success','Media Updated successfully');
    }


    }
    public function pending()
    {
        return view('ecommerce.products.admin.pending');
    }
    public function pendingDatatables()
    {
        $products = EcoProduct::where('product_permision', 'pending')->with('media', 'vendor', 'shop');
        return Datatables::of($products)
            ->addColumn('thumbnail', function($product){
                if($product->media->first()) {
                    return '<img class="product-thumbnail" src="'. url('storage/' . $product->media->first()["product_image"]) .'" />';
                } else {
                    return '<img class="product-thumbnail" src="'. Storage::disk('img_not_found')->url('img-not-found/pro_img_not_found.png') .'" />';
                }
            })
            ->addColumn('action', function($product){
                return '<a class="btn btn-alt-primary" href="'. route("products.details",$product->id) .'">Details</a>';
            })
            ->rawColumns(['thumbnail', 'action'])
            ->make(true);
    }
    public function all()
    {
//        $products = EcoProduct::with('media', 'vendor', 'shop')->get();
//        $products = json_decode(json_encode($products));
//        echo"<pre>"; print_r($products); die;
//        return response()->json($products) ;
        return view('ecommerce.products.admin.all');
    }
    public function allDatatables()
    {
        $products = EcoProduct::with('media', 'vendor', 'shop');
        return Datatables::of($products)
            ->addColumn('thumbnail', function($product){
                $thumburl = '';
                if($product->media->first()) {
                    return '<img class="product-thumbnail" src="'. url('storage/' . $product->media->product_image) .'" />';
                } else {
                    return '<img class="product-thumbnail" src="'. Storage::url('img-not-found/pro_img_not_found.png') .'" />';
                }
                return '<img class="product-thumbnail" src="'. url('storage/' . $thumburl) .'" />';
            })
            ->addColumn('category_name', function($product){
                return $product->category->category_name;
            })
            ->addColumn('action', function($product){
                return '<a class="btn btn-alt-primary" href="'. route("products.details",$product->id) .'">Details</a>';
            })
            ->rawColumns(['thumbnail', 'action'])
            ->make(true);
    }
    public function details(EcoProduct $id)
    {
        $bdealer_type = BdealerType::all();
        $bdealer_product = BdealerProduct::where('product_id', $id->id);
        return view('ecommerce.products.details')->with(["product" => $id, "bdealer_type" => $bdealer_type, "bdealer_product" => $bdealer_product]);
    }
    public function approved(EcoProduct $id, Request $request)
    {
        $updated = $id->update([
            'production_price' => $request->production_price,
            'bvon_price' => $request->bvon_price,
            'store_amount' => $request->store_amount,
            'sr_amount' => $request->sr_amount,
            'premium_price' => $request->premium_price,
            'user_price' => $request->user_price,
            'can_use_cashback' => $request->can_use_cashback,
            'product_permision' => 'approved',
            'product_visibility' => 1,
        ]);

        if($updated) {
            return back()->with(['success' => 'Approved Succesfull']);
        }

    }
    public function showProductToDealer()
    {
        $categories = EcoCategory::all();
        return view('ecommerce.products.admin.show-product-to-dealer', compact('categories'));
    }
    public function updateProductToDealer(Request $request)
    {
        foreach ($request->showToDealer as $product_id => $show_to_dealer) {
            EcoProduct::where('id', $product_id)
                ->update(['show_to_dealers' => $show_to_dealer]);
        }

        return back()->with(["success" => "successfull add product to bdealer"]);
    }
    public function addBdealerPrice($id, Request $request)
    {

        $request->validate(
            [
                "bdealer_type.*.id" => "required|integer",
                "bdealer_type.*.price" => "required|numeric|min:0|not_in:0",
                "bdealer_type.*.minimum_quantity" => "required|numeric|min:0|not_in:0",
            ],
            [
                'bdealer_type.*.minimum_quantity.required' => 'Minimum Quantity is required',
                'bdealer_type.*.minimum_quantity.numeric' => 'Minimum Quantity must be a number',
                'bdealer_type.*.minimum_quantity.min' => 'Minimum Quantity cannot be zero or Negetive Number',
                'bdealer_type.*.minimum_quantity.not_in' => 'Minimum Quantity cannot be zero or Negetive Number',
                'bdealer_type.*.price.min' => 'Price cannot be zero or Negetive Number',
                'bdealer_type.*.price.not_in' => 'Price cannot be zero or Negetive Number',
            ]
        );

        $success = false;

        foreach ($request->bdealer_type as $bdealer_t) {
            $bdealer_product = BdealerProduct::where([
                'product_id' => $id,
                'bdealer_type_id' => $bdealer_t["id"],
            ]);

            if($bdealer_product->count()) {
                $success = $bdealer_product->update([
                    "purchase_price" => $bdealer_t["price"],
                    "minimum_quantity" => $bdealer_t["minimum_quantity"]
                ]);
            } else {
                $success = BdealerProduct::create([
                    "product_id" => $id,
                    'bdealer_type_id' => $bdealer_t["id"],
                    "purchase_price" => $bdealer_t["price"],
                    "minimum_quantity" => $bdealer_t["minimum_quantity"]
                ]);
            }
        }

        if($success) return back()->with(["success" => "Bdealer Price has been added Successfully"]);

    }
    public function ajaxGetProduct(Request $request)
    {
        $allProduct = EcoProduct::where([
            'category_id' => $request->query('cat_id'),
            'product_permision' => 'approved',
            'product_visibility' => 1
        ])->get();

        return array_values($allProduct->filter(function($product){
            return $product->hasBdealerProductPrice();
        })->toArray());


    }

    public function delete($id)
    {
        $deleted = EcoProduct::find($id)->delete();
        if($deleted) {
            return redirect()->route('products.all')->with(["success" => "Product has been successfully deleted"]);
        }

    }

    public function trashed()
    {
        $products = EcoProduct::onlyTrashed()->get();
        return view('ecommerce.products.trashed', compact('products'));
    }

    public function restoreProduct($product_id)
    {
        $product = EcoProduct::withTrashed()->findOrFail($product_id);
        $restored = $product->restore();
        if($restored) return back()->with(["success" => "Product has been restore successfully"]);
    }


    public function dealerStockAdd(Request $request){

        if($request->isMethod('post')){
            $product = explode("-", $request->product);

            if(empty($request->quantity)){

                $productStockDetails = BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->count();
                if ($productStockDetails > 0) {
                    $stock = BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->first();
                    $quantity = $stock->quantity - $request->quantity_minus;
                    BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->update(['quantity' => $quantity]);
                }

            }else {

                $productStockDetails = BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->count();
                if ($productStockDetails > 0) {
                    $stock = BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->first();
                    $quantity = $stock->quantity + $request->quantity;
                    BdealerProductStock::where(['bdealer_id' => $request->dealer, 'product_id' => $product[0]])->update(['quantity' => $quantity]);
                } else {
                    $stock = new BdealerProductStock();
                    $stock->bdealer_id = $request->dealer;
                    $stock->product_id = $product[0];
                    $stock->quantity = $request->quantity;
                    $stock->message = $product[1] . " has been purchase";
                    $stock->type = "add";
                    $stock->name = "purchase";
                    $stock->save();
                    return redirect()->back();
                }
            }
        }

    $dealers = Bdealer::join('users', 'users.id', '=', 'bdealers.user_id')->select('bdealers.id', 'users.name')->get();
    $products = EcoProduct::select('id', 'product_name')->get();

    return view('ecommerce.dealer-stock.add_dealer', compact('dealers', 'products'));
    }








}
