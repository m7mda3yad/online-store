<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Customer{

    public function handle(Request $request, Closure $next)
    {
        if(\Auth::guard('customer')->check()==false){
            return redirect()->route('customer.login');
        }
        return $next($request);
    }
}
