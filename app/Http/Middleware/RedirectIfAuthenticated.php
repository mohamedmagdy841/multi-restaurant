<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as RedirectIfAuthenticatedMiddleware;

use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated extends RedirectIfAuthenticatedMiddleware
{

    public function handle(Request $request, Closure $next, string ...$guards): \Symfony\Component\HttpFoundation\Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && $guard == 'admin') {
                return to_route('admin.dashboard');
            }
            if (Auth::guard($guard)->check() && $guard == 'vendor') {
                return to_route('vendor.dashboard');
            }
            if (Auth::guard($guard)->check() && $guard == 'web') {
                return to_route('dashboard');
            }
        }

        return $next($request);
    }

}
