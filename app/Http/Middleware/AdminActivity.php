<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Shop\Admin\Admins\Admin;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use DateTime;

class AdminActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('admins')->check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . auth()->guard('admins')->id(), true, $expiresAt);
            Admin::where('id', auth()->guard('admins')->id())->update(['last_seen' => (new DateTime())->format("Y-m-d H:i:s")]);
        }
        return $next($request);
    }
}
