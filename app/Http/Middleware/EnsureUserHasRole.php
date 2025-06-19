<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param \Illuminate\Http\Request  $request
     * @param string ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(Auth::check()) {
            if(in_array(Auth::user()->role, $roles)) {
                return $next($request);
            }
            Alert::error('Access Denied', 'You do not have permission to access this page.');
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
}
