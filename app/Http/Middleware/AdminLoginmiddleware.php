<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminLoginmiddleware
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
        if (Auth::check('admin')){
            if (Auth::guard('admin')){
                return $next($request);
            }
            return redirect()->route('admin.layout.login')->with('error', 'Permission denied');
        };
        return redirect()->route('admin.layout.login')->with('error', 'Permission denied');
    }
}
