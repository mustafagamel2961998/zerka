<?php

namespace App\Http\Middleware\Dashboard;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('dashboard.v1.login')
                             ->with('error', __('dashboard.must_login_first'));
        }

        if (auth()->user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('dashboard.v1.login')
                ->with('error', __('dashboard.not_have_permission'));
        }
        return $next($request);
    }
}
