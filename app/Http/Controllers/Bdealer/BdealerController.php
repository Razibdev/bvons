<?php

namespace App\Http\Controllers\Bdealer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Ecommerce\OrderCommon;
use App\KuHelpers\Helpers;
use App\Model\Area\Zone;
use App\Model\Bdealer\Bdealer;
use App\Model\Bdealer\BdealerOrder;
use App\Model\Bdealer\BdealerOrderDetail;
use App\Model\Bdealer\BdealerProduct;
use App\Model\Bdealer\BdealerProductStock;
use App\Model\Bdealer\BdealerTransaction;
use App\Model\Bdealer\BdealerTransactionCategory;
use App\Model\Bdealer\BdealerType;
use App\Model\Ecommerce\EcoMedia;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Yajra\DataTables\DataTables;


class BdealerController extends Controller
{
    use BdealerTraits;
    protected function formatted_data($a) {
        return [
            "original" => $a,
            "human_readable" => Helpers::number_format_short($a)
        ];
    }

    public function create()
    {
        $bdealers = Bdealer::all()->pluck(['user_id'])->toArray();
        $premium_users = User::whereNotNull('referral_id')->whereNotIn('id', $bdealers)->where('name', '!=', 'Root User')->get();
        $zones = Zone::all();
        return view('ecommerce.b-dealer.b-dealer-create', compact('premium_users', 'zones'));
    }

    public function index()
    {
        $b_dealer_list = Bdealer::where('status', 'pending')->paginate(200);
        return view('ecommerce.b-dealer.b-dealer-request', compact('b_dealer_list'));
    }
    public function getActive()
    {
        $b_dealer_list = Bdealer::active()->paginate(200);
        return view('ecommerce.b-dealer.b-dealer-active', compact('b_dealer_list'));
    }




    public function dealerStock($id){


        $dealerStock = BdealerProductStock::join('eco_products', 'eco_products.id', '=', 'bdealer_product_stocks.product_id')->where('bdealer_id', $id)->get();
//        $dealerStock = json_decode(json_encode($dealerStock));
//        echo "<pre>"; print_r($dealerStock);die;
        return view('ecommerce.b-dealer.dealer_product_stock', compact('dealerStock'));
    }



    public function show(Bdealer $id)
    {

        $last_transaction = $id->transactions()->where('bdealer_transaction_category_id', 1)->orderBy('created_at', 'desc')->first();

        $dealeraccount = Bdealer::join('users', 'users.id', 'bdealers.user_id')->where('bdealers.id', $id->id)->first();

        $under_dealerc = Bdealer::where('id', $id->bdealer_reference_id)->count();
        $under_dealer = null;
        if($under_dealerc >0){
            $under_dealer = Bdealer::join('users', 'users.id', '=', 'bdealers.user_id')->where('bdealers.id', $id->bdealer_reference_id)->first();
        }

            $dealer = Bdealer::join('users', 'users.id', '=', 'bdealers.user_id')->where('bdealers.id', $id->bdealer_id)->first();

//        $dealer = json_decode(json_encode($dealer), true);
//        echo "<pre>";
//        print_r($dealer); die;


        return view('ecommerce.b-dealer.b-dealer-request-deatils')->with([
            "b_dealer"              => $id,
            "b_dealer_type"         =>  BdealerType::all(),
            "last_transaction"      => $last_transaction,
            "under"                 => $under_dealer,
            "dealer"                 => $dealer,
            "dealeraccount"                 => $dealeraccount,
        ]);
    }
    public function recharge(Bdealer $id, Request $request)
    {
        $request->validate([
            "recharge_amount" => "required|numeric",
            "bdealer_transaction_category_id" => "required|integer",
            'payment_method' => "required"
        ]);
        $message = "Your B-dealer wallet has been recharged";
//        echo"<pre>"; print_r($request->all());die;
        $created = BdealerTransaction::create([
           "bdealer_id"                         => $id->id,
           "bdealer_transaction_category_id"    => $request->bdealer_transaction_category_id,
           "type"                               => $request->payment_type,
           "amount"                             => $request->recharge_amount,
           "payment_method"                     => $request->payment_method,
           "message"                            => $request->message,
        ]);

//        if($created) {
//            try {
//                Helpers::send_push_notification([
//                    "fcm_token" => $id->user->fcm_token,
//                    "title" => "B-Dealer Wallet Recharge",
//                    "body" => $request->message
//                ]);
//                return back()->with(["success" => "Recharge Successful"]);
//            } catch (\Exception $e) {
//                return back();
//            }
//        }
        return redirect()->back();
    }
    public function active(Bdealer $id, Request $request)
    {
        $request->validate([
            "shop_name" => "required",
            "bdealer_type_id" => "required|integer",
        ]);

        $bdeals = Bdealer::where('id', $id->id)->first();
        $users = User::where('id', $bdeals->user_id)->first();

        if($id->status !== 'pending') return back()->with(["error" => "Cannot active this user. status is not pending."]);
        $updated = $id->update([
            "shop_name"            => $request->shop_name,
            "bdealer_type_id"      => $request->bdealer_type_id,
            "bdealer_id"           => $request->has('bdealer_id') ? $request->bdealer_id : NULL,
            "bdealer_reference_id" => $request->has('bdealer_reference_id') ? $request->bdealer_reference_id : ($request->has('bdealer_id') ? $request->bdealer_id : NULL),
            "status"               => 'active',
            "dealer_referral_id"              => $users->referral_id,

        ]);
        if($updated) {
            $fcm_token = $id->user->fcm_token;
            if($fcm_token) {
                Helpers::send_push_notification([
                    "fcm_token" => $fcm_token,
                    "title"     => 'B-Dealer - Bvon',
                    'body'  => 'Congratulations! Your B-Dearler request has been accepted.'
                ]);
            }

            // TODO:: give rejected notifaction
            // TODO:: create rejected panel


            return back()->with(["success" => "B-Dealer Actived successfully"]);
        }
    }
    public function orders(Request $request)
    {
        return view('ecommerce.b-dealer.orders')->with(["status" => $request->query('status')]);
    }
    public function ordersDatatables(Request $request)
    {
        $borders = BdealerOrder::all();
        if($request->query('status') === 'pending')  $borders = BdealerOrder::where('status', 'pending')->get();
        else if($request->query('status') === 'processing')  $borders = BdealerOrder::where('status', 'processing')->get();
        else if($request->query('status') === 'shipped')  $borders = BdealerOrder::where('status', 'shipped')->get();
        else if($request->query('status') === 'complete')  $borders = BdealerOrder::where('status', 'complete')->get();
        else if($request->query('status') === 'cancel')  $borders = BdealerOrder::where('status', 'cancel')->get();
        return Datatables::of($borders)
            ->addColumn('order_by', function($border) {
                return "<table class='table table-bordered' style='min-width: 250px'>
                            <tr>
                                <th>Bdealer Name</th>
                                <td>{$border->user()->name}</td>
                            </tr>
                            <tr>
                                <th>Bdealer Type</th>
                                <td>{$border->bdealer->type->name}</td>
                            </tr>
                        </table>";
            })
            ->addColumn('order_to', function($border){
                $assignType = null;
                if($border->bdealer_assign_to) {
                    $assignType = $border->bdealer_assign_to->type->name;
                }
                return $assignType ? "<table class='table table-bordered' style='min-width: 250px'>
                            <tr>
                                <th>Bdealer Name</th>
                                <td>{$border->user_assign_to()->name}</td>
                            </tr>
                            <tr>
                                <th>Bdealer Type</th>
                                <td>{$assignType}</td>
                            </tr>
                        </table>" : "<strong class='text-center'>Admin</strong>";
            })
            ->addColumn('created_at', function($border){
                return $border->created_at ? with(new Carbon($border->created_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('updated_at', function($border){
                return $border->updated_at ? with(new Carbon($border->updated_at))->format('d/m/Y - h:i a') : '';
            })
            ->addColumn('action', function($border){
                return "<a class='btn btn-alt-primary' href='". route('bdealer.orders.details', $border->id) ."'>View Details</a>";
            })
            ->rawColumns(['order_by', 'order_to', 'action'])
            ->make(true);
    }
    public function ordersDetails(BdealerOrder $border)
    {
        $bdealer = Bdealer::where('id', $border->bdealer_id)->first();
        $products = BdealerProduct::where('bdealer_type_id', $bdealer->bdealer_type_id )->with('products', 'media')->get();
//        echo "<pre>"; print_r(json_decode(json_encode($products)));die;
        return view('ecommerce.b-dealer.order_details', compact('border', 'products'));
    }
    public function completBdealerOrderByAdmin(Request $request)
    {
        $request->validate([
           "pin" => "required",
           "order_id" => "required"
        ]);
        $border = BdealerOrder::find($request->order_id);
        if($border->status === "complete") return back()->with(["error" => "This order already been completed"]);
        $order_details = $border->border_details->map(function($order_detail){
            $product_json = $order_detail->product_json = json_decode($order_detail->product_json);
            return $order_detail;
        });

        if($border->pin !== $request->pin) return back()->withErrors(["errors" => "pin doesn't match"]);
        $completed = DB::transaction(function() use ($border, $request, $order_details){
                        try {
                            $updated = $border->update([
                                "status" => 'complete'
                            ]);
                            foreach ($order_details as $order_detail) {
                                $product_id = $order_detail->product_json->product_details->id;
                                $product_name = $order_detail->product_json->product_details->product_name;
                                $order_quantity = $order_detail->quantity;
                                $data = [
                                    [
                                        "bdealer_id"    => $border->bdealer_id,
                                        "product_id"    => $product_id,
                                        "name"          => "purchase",
                                        "type"          => "add",
                                        "quantity"      => $order_quantity,
                                        "message"       => "{$product_name} has been purchased",
                                        "created_at"    => Carbon::now(),
                                        "updated_at"    => Carbon::now(),
                                    ]
                                ];
                                BdealerProductStock::insert($data);
                            }
                            return true;
                        } catch (\Exception $e) {
                            return false;
                        }

                    });

        $fcm_token = $border->user()->fcm_token;
        if($fcm_token) {
            Helpers::send_push_notification([
                "fcm_token" => $fcm_token,
                "title" => "B-Dealer order update",
                "body" => "You order {$border->serial} has been {$border->status}"
            ]);
        }


        if($completed) return back()->with(["success" => "Order has been complete successful"]);
    }
    public function forwardBdealerOrderByAdmin(Request $request)
    {
        $request->validate([
            "forward_dealer_id" => "required|integer",
            "order_id" => "required|integer"
        ]);
        $border = BdealerOrder::find($request->order_id);
        $forward_success = $border->update([
           "assigned_to" => $request->forward_dealer_id,
           "status" => 'pending',
        ]);

        $forward_dealer_token = Bdealer::find($request->forward_dealer_id)->user->fcm_token;

        if($forward_dealer_token) Helpers::send_push_notification([
            "fcm_token" => $forward_dealer_token,
            "title" => "B-Dealer order received",
            "body" => "You have received an order {$border->serial} forwarded by Admin"
        ]);

        return $forward_success ? back()->with(["success" => "Order has been successfully forwarded"]) : back()->with(["error" => "Somthing wrong! Please try latter"]);
    }
    public function cancelBdealerOrderByAdmin(Request $request)
    {
        $request->validate([
            "order_id" => "required|integer"
        ]);
        $border = BdealerOrder::find($request->order_id);
        if($border->status === "cancel") return back()->with(["error" => "This order already been cancelled"]);
        $order_cancel = $border->update([
            "status" => 'cancel'
        ]);
        $forward_dealer_token = $border->user()->fcm_token;
        if($forward_dealer_token) Helpers::send_push_notification([
            "fcm_token" => $forward_dealer_token,
            "title" => "B-Dealer order update",
            "body" => "You order {$border->serial} has been {$border->status}"
        ]);
        return $order_cancel ? back()->with(["success" => "Order has been successfully Canceled"]) : back()->with(["error" => "Somthing wrong! Please try latter"]);
    }
    public function changeBdealerOrderStatusByAdmin(Request $request)
    {
        $request->validate([
            "order_id"   => ["required", "integer"],
            "status"     => ["required"]
        ]);
        $b_orders = BdealerOrder::find($request->order_id);

        if($b_orders) {
            $dbStatusId = $this->getStatusId($b_orders->status);
            $reqStatusId = $this->getStatusId($request->status);
            if($reqStatusId === 0) return back()->with(["error" => "Invalid status"]);
            if($dbStatusId === $reqStatusId) return back()->with(["error" => "Status already: {$b_orders->status}"]);
            if(in_array($dbStatusId, [4,5])) return back()->with(["error" => "Cannot change status"]);
            if($dbStatusId > $reqStatusId) return back()->with(["error" => "Status cannot be reversed"]);

            if($reqStatusId === 4) {
                return back()->with(["error" => "Order cannot be cancel"]);
            } else if($reqStatusId === 5) {
                return back()->with(["error" => "Order cannot be complete"]);
            } else {
                $orderUpdated = $b_orders->update([
                    "status" => $request->status
                ]);
            }

            if($orderUpdated) {
                $fcm_token = $b_orders->user()->fcm_token;
                if($fcm_token) {
                    $notification = Helpers::send_push_notification([
                        "fcm_token" => $fcm_token,
                        "title" => "B-Dealer order update",
                        "body" => "You order {$b_orders->serial} has been {$b_orders->status}"
                    ]);
                }
            }
            return back()->with(["success" => "Order has been updated successfully"]);

        } else {
            return back()->with(["error" => "Something wrong! Please try later"]);
        }
    }


    /*all api request*/
    public function storeApi(Request $request)
    {
        $request->validate([
            "zone_id" => "required",
            "district_id" => "required",
            "thana_id" => "required",
            "village_id" => "required",
            "pic" => "required",
            "nid_pic_front" => "required",
            "nid_pic_back" => "required",
        ]);

        if(!$request->query('admin')) {
            if(!auth()->user()->check_user_is_verified()) return response()->json(["errors" => ["invalid_user" => "User is not a premium member"]], 422);
            if(Bdealer::where('user_id', auth()->id())->count() > 0) return response()->json(["errors" => ["already_register" => "Your already been request for B-Dealer"]], 422);
        }

        //TODO:: rejected can send request


        $created = Bdealer::create([
            "bdealer_id"                => $request->bdealer_id ?? null,
            "user_id"                   => $request->query('admin') ? $request->user_id : auth()->id(),
            "zone_id"                   => $request->zone_id,
            "district_id"               => $request->district_id,
            "thana_id"                  => $request->thana_id,
            "village_id"                => $request->village_id,
            "pic"                       => $request->file('pic')->storeAs(auth()->id() .'/bdealer',"pic.{$request->file('pic')->extension()}", 'user_upload'),
            "nid_pic_front"             => $request->file('nid_pic_front')->storeAs(auth()->id() .'/bdealer',"nid_pic_front.{$request->file('nid_pic_front')->extension()}", 'user_upload'),
            "nid_pic_back"              => $request->file('nid_pic_back')->storeAs(auth()->id() .'/bdealer',"nid_pic_back.{$request->file('nid_pic_back')->extension()}", 'user_upload'),
            "ecucation_cert_pic"        => $request->ecucation_cert_pic ? $request->file('ecucation_cert_pic')->storeAs(auth()->id() .'/bdealer',"ecucation_cert_pic.{$request->file('ecucation_cert_pic')->extension()}", 'user_upload') : null,
            "business_type"             => $request->business_type ?? null,
            "comment_about_business"    => $request->comment_about_business ?? null,
            "shop_name"                 => $request->shop_name ?? null,
            "shop_geo"                  => $request->shop_geo ?? null,
            "contact"                   => $request->contact ?? null,
        ]);

        return $request->query('admin') ? back()->with(["success"=>"B-Dealer Request has been successfully added"]): $created;
    }
    public function getBdealerDetailsApi()
    {
        return [
            "name" => auth()->user()->name,
            "type_id" => auth()->user()->b_dealer->type->id,
            "type" => auth()->user()->b_dealer->type->name,
            "profile_pic" => Storage::disk('user_profile')->url('/') . auth()->id() . '/' . auth()->user()->profile_pic,
        ];
    }
    public function statusApi()
    {
        return auth()->user()->b_dealer()->count() > 0 ? response()->json(["status" => auth()->user()->b_dealer->status]) :  response()->json(["status" => null]);
    }
    public function getBdealerApi()
    {
        //TODO:: make paginate
        //TODO:: only four data

        $thana_id = request()->query('thana_id') ?? null;
        $district_id = request()->query('district_id') ?? null;
        $bdealer = Bdealer::with(["thana", "district", "type"]);
        $bdealer->with(["thana", "district", "type"]);
        $bdealer->where('status', 'active');
        if($thana_id) $bdealer->where('thana_id', $thana_id);
        if($district_id) $bdealer->where('district_id', $district_id);
        return $bdealer->get(["shop_name", "thana_id", "district_id", "bdealer_type_id", "status"]);
    }
    public function balanceApi()
    {
        return [
            "recharge" => $this->formatted_data(auth()->user()->b_dealer->recharge()),
            "purchase" => $this->formatted_data(auth()->user()->b_dealer->purchase()),
            "sell" => $this->formatted_data(auth()->user()->b_dealer->sell()),
            "balance" => $this->formatted_data(auth()->user()->b_dealer->balance()),
        ];
    }
    public function transactionsApi()
    {
        $transaction = auth()->user()->b_dealer->transactions();
        if(request()->query('cat_id')) $transaction->where('bdealer_transaction_category_id', request()->cat_id);
        return $transaction->orderBy('created_at', 'desc')->with('category')->select(["id", "bdealer_transaction_category_id", "type", "amount", "message", "created_at", "updated_at"])->paginate(20);

    }
    public function transactionTypeApi()
    {
        return BdealerTransactionCategory::all();
    }
    public function getBdealerAjax(Request $request)
    {
        if($request->has('all_distributor')) {
            return $bdealer = Bdealer::with('user')->get();
        } else {
            $bdealer = Bdealer::where('zone_id', $request->zone_id);
        }
        if($request->has("district_id")) $bdealer->where('district_id', $request->district_id);
        if($request->has("district_id")) $bdealer->where('district_id', $request->district_id);
        return $bdealer->where('bdealer_type_id', $request->b_dealer_type_id)->active()->with('user')->get();
    }
    public function getBdealerOverViewApi()
    {
        $bdealer = auth()->user()->b_dealer;
        $products_in_stock = DB::table('bdealer_product_stocks')
            ->select('bdealer_product_stocks.product_id', 'eco_products.product_name', DB::raw('sum(bdealer_product_stocks.quantity) as total_stock'))
            ->distinct()
            ->join('eco_products','bdealer_product_stocks.product_id', '=', 'eco_products.id')
            ->where('bdealer_product_stocks.bdealer_id', "=", $bdealer->id)
            ->where('bdealer_product_stocks.type', '=','add')
            ->groupBy(['bdealer_product_stocks.product_id'])
            ->get();

        $products_out_stock = DB::table('bdealer_product_stocks')
            ->select('bdealer_product_stocks.product_id', DB::raw('sum(bdealer_product_stocks.quantity) as total_sold'))
            ->distinct()
            ->join('eco_products','bdealer_product_stocks.product_id', '=', 'eco_products.id')
            ->where('bdealer_product_stocks.bdealer_id', "=", $bdealer->id)
            ->where('bdealer_product_stocks.type', '=','sub')
            ->groupBy(['bdealer_product_stocks.product_id'])
            ->get();

        $product_images = EcoMedia::whereIn('product_id', $products_in_stock->pluck('product_id'))->groupBy('product_id')->get();

        $products = $products_in_stock->map(function($single_product_stock) use($products_out_stock, $product_images){
            if($product_images->contains('product_id', $single_product_stock->product_id)) {
                $product_image = $product_images->filter(function($single_product_image) use ($single_product_stock){
                    return $single_product_stock->product_id === $single_product_image->product_id;
                });
                $single_product_stock->product_image = url('storage/' . $product_image->first()->product_image);
            } else {
                $single_product_stock->product_image = Storage::disk('img_not_found')->url('/pro_img_not_found.png');
            }
            $single_product_stock->total_stock = (int) $single_product_stock->total_stock;
            if($products_out_stock->count()) {
                foreach ($products_out_stock as $single_product_out_stock) {
                    if($single_product_out_stock->product_id == $single_product_stock->product_id) {
                        $single_product_stock->total_sold = (int) $single_product_out_stock->total_sold;
                        break;
                    } else {
                        $single_product_stock->total_sold = 0;
                    }
                }
            } else {
                $single_product_stock->total_sold = 0;
            }
            return $single_product_stock;
        });

        return [
            "total_purchase_quantity"       =>  $bdealer->total_purchase_quantity(),
            "total_sell_quantity"           =>  $bdealer->total_sell_quantity(),
            "total_purchase_amount"         =>  $bdealer->total_purchase_amount(),
            "total_sell_amount"             =>  $bdealer->total_sell_amount(),
            "products"                      =>  $products,

        ];
    }



    //update single product quantity

    public function updateSingleProductQuantity(Request $request){
//        \Log::info($request);

        $orderDetailsCheck = BdealerOrderDetail::where('id', $request->id)->first();

        if($orderDetailsCheck->quantity <= $request->quantity){
            $qty = $request->quantity - $orderDetailsCheck->quantity;

            $price = $orderDetailsCheck->price * $qty;
            $dorder =  BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->first();
            $total = $dorder->amount + $price;

            BdealerOrderDetail::where('id', $request->id)->update(['quantity' => $request->quantity]);
            BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->update(['amount' => $total]);
        }else{

            $qty =  $orderDetailsCheck->quantity - $request->quantity;

            $price = $orderDetailsCheck->price * $qty;
            $dorder =  BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->first();
            $total = $dorder->amount - $price;

            BdealerOrderDetail::where('id', $request->id)->update(['quantity' => $request->quantity]);
            BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->update(['amount' => $total]);
        }

        return redirect('/b_dealer/orders/'.$dorder->id);
    }


    public function singleProductDelete(Request $request){
        $orderDetailsCheck = BdealerOrderDetail::where('id', $request->id)->first();
        $price = $orderDetailsCheck->quantity * $orderDetailsCheck->price;
        $dorder =  BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->first();
        $total = $dorder->amount - $price;
        BdealerOrder::where('id', $orderDetailsCheck->bdealer_order_id)->update(['amount' => $total]);
        BdealerOrderDetail::where('id', $request->id)->delete();
        return response()->json($orderDetailsCheck->bdealer_order_id);


    }

    public function addSingleProduct(Request $request){

        $bdProduct = BdealerProduct::where('id', $request->product_id)->with('products')->first();

        $product = array(
            'order_details' => array(
                'price' => $bdProduct->purchase_price,
                'product_id' => $bdProduct->product_id,
                'specification' =>  array(array(
                    'size' => $bdProduct->products->product_size,
                    'quantity' =>  $request->quantity
                ))

            ),
            'product_details' => array(
                'id' => $bdProduct->product_id,
                'product_name' =>  $bdProduct->products->product_name
            )
        );
//        \Log::info(json_encode($product));

        $dealerorderDetails = new BdealerOrderDetail();
        $dealerorderDetails->bdealer_order_id  = $request->id;
        $dealerorderDetails->product_json =json_encode($product);
        $dealerorderDetails->product_name =  $bdProduct->products->product_name;
        $dealerorderDetails->product_size =  $bdProduct->products->product_size;
        $dealerorderDetails->price = $bdProduct->purchase_price;
        $dealerorderDetails->quantity = $request->quantity;
        $dealerorderDetails->save();
        $price =  $request->quantity *  $bdProduct->purchase_price;
        $dorder =  BdealerOrder::where('id', $request->id)->first();
        $total = $dorder->amount + $price;
        BdealerOrder::where('id',$request->id)->update(['amount' => $total]);
        return redirect('/b_dealer/orders/'. $request->id);

        
    }
















}
