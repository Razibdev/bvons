<?php

namespace App\Http\Controllers\Bcourier\Api;

use App\Http\Controllers\Controller;
use App\Model\Bcourier\BcoPercelType;
use Illuminate\Http\Request;

class BcoPercelTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return BcoPercelType::all();
    }

}
