<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use \Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
       return view('admin-auth.login-custom');
    }

    /*
     * admin login
     * */
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required|min:4"
        ]);

        $auth = $this->guard()->attempt([
            "email" => $request->email,
            "password" => $request->password], $request->remember);
        if($auth) {
            return redirect()->intended(route('dashboard'));
        } else {
            return redirect()
                ->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    "email" => "Invalid Email credential",
                ]);
        }
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
