<?php

namespace App\Http\Controllers\Ecommerce\Auth;

use App\EcoVendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Auth;

class VendorAuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest:vendor')->except('logout');
    // }
    public function index()
    {
        return view('ecommerce.vendor-auth.login-custom');
    }
    public function registerShow()
    {
        return view('ecommerce.vendor-auth.admin.register');
    }

    public function login(Request $request)
    {

        $request->validate([
            "email" => "required",
            "password" => "required|min:3"
        ]);

        $auth = $this->guard()->attempt([
            "email" => $request->email,
            "password" => $request->password], $request->remember);
        if($auth) {
            return redirect()->intended(route('mainpage'));
        } else {
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    "email" => "Invalid Email credential",
                ]);
        }
    }
    protected function guard()
    {
        return Auth::guard('vendor');
    }

    public function list()
    {
        $vendors = EcoVendor::all();
        return view('ecommerce.vendor-auth.admin.list', compact('vendors'));
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('vendor.login');
    }


}
