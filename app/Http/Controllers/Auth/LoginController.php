<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Entities\Admin\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function customerLogin(Request $request)
    {
        if( auth()->guard('customer')->attempt($request->only('email', 'password')) ){
            return redirect()->route('order');
        }
        return view('auth.customer_login')->withErrors('invalid data');
        ;
    }
    public function FormCustomerLogin(Request $request)
    {
        if( auth()->guard('customer')->check() ){
            return redirect()->route('orders');
        }
        return view('auth.customer_login');
    }
    public function deliveryLogin(Request $request)
    {
        if( auth()->guard('delivery')->attempt($request->only('email', 'password')) ){
            return redirect()->route('order');
        }
        return view('auth.delivery_login')->withErrors('invalid data');
        ;
    }
    public function FormDeliveryLogin(Request $request)
    {
        if( auth()->guard('delivery')->check() ){
            return redirect()->route('orders');
        }
        return view('auth.delivery_login');
    }

    public function __construct()
    {

    }
}
