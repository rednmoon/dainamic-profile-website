<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // ইউজার যদি অ্যাডমিন হয়, তাকে অ্যাডমিন ড্যাশবোর্ডে রিডাইরেক্ট করবে
        if (Auth::check() && Auth::user()->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}