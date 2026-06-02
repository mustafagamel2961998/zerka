<?php

namespace App\Http\Middleware\Dashboard;

use Closure;
use Illuminate\Http\Request;
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
            return redirect()->route('v1.dashboard.login.index')
                             ->with('error', __('dashboard.must_login_first'));
        }

        if (!auth()->user()->hasRole('Super Admin')) {
            // لو مش سوبر أدمن، اطرده بره ورجعه بـ رسالة خطأ (أو واديه صفحة 403)
            return redirect()->back()
                ->with('error', __('dashboard.not_have_permission'));
        }
        return $next($request);
    }
}
