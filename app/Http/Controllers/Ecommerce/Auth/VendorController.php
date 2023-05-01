<?php

namespace App\Http\Controllers\Ecommerce\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Ecommerce\Api\EcoProduct;
use App\Model\Ecommerce\Api\EcoCategory;
use App\Model\Ecommerce\Api\EcoSubCategory;
use App\Model\Ecommerce\EcoShop;


class VendorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:vendor')->except('logout');
    // }
    public function index()
    {
        $products = EcoProduct::where('vendor_id', auth()->id())->count();
        $shops = EcoShop::where('vendor_id', auth()->id())->count();
        return view('ecommerce.main.mainpage',compact(['products','shops']));
    }
}
