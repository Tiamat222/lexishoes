<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $currentAdmin = auth()->guard('admins')->user();
        if($currentAdmin->hasPermission($permission)){
            return $next($request);
        } 
        return abort(403);
    }
}
