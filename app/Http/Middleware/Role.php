<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role_id): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->user()->role_id == $role_id) {
            return $next($request);
        }
        return redirect()->back();
    }
}