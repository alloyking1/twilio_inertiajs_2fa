<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Inertia\Inertia;


class TwoFactorAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dump($request->session()->get('phoneVerified'));
        if ($request->session()->get('phoneVerified') === "pending") {
            return redirect()->route('phone.verify');
        }
        return $next($request);
    }
}
