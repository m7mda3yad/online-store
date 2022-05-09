<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class SiteData{

    public function handle(Request $request, Closure $next)
    {
        if(session()->get('site_data')==null)
        {
            $site_data = \App\Entities\Admin\Site::first();
            session()->put('site_data',$site_data);
        }
        return $next($request);
    }
}
