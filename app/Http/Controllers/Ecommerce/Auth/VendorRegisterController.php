<?php

namespace App\Http\Controllers\Ecommerce\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\EcoVendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class VendorRegisterController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MAINPAGE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    protected function vendorRegister(Request $request)
    {

        $request->validate([
            "name" => ["required"],
            "email" => ["required"],
            "password" => ["required"],
        ]);
        // return $request->input('name');
       $data = [
           'name'=> $request->input('name'),
           'email'=> $request->input('email'),
           'password'=> bcrypt($request->input('password')),
       ];

       try{
            $vendor = EcoVendor::create($data);
            if($request->has('role')) {
                $vendor->assignRole('administrator');
            } else {
                $vendor->assignRole('vendor');
            }
            return redirect()->route('vendor.login');
       }
       catch(Exception $e){
        return redirect()->back()->with('success', 'Error');
       }
    }
}




