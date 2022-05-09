<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class emailValidat
{

    public function handle(Request $request, Closure $next)
    {
            if(auth()->user()->email_verified_at==null)
            return \App\Http\Traits\GeneralTrait::returnError(203,'please verify your email');
        return $next($request);
    }
}
