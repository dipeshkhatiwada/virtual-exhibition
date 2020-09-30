<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cache;
use Carbon\Carbon;

class EmployeeActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'employee')
    {
        if(Auth::guard($guard)->check()) {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . auth()->guard($guard)->user()->id, true, $expiresAt);
        }
        return $next($request);
    }
}