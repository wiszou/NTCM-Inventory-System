<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SessionCheckerLogin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user_id') && $request->session()->has('user_name')) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}