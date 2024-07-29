<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, ...$roles): Response
    // {
    //     if (!Auth::check()) {
    //         return redirect('login.admin');
    //     }

    //     foreach ($roles as $role) {
    //         // Check if user has the role
    //         if ($request->user()->role === $role) {
    //             return $next($request);
    //         }
    //     }

    //     abort(403, 'Unauthorized action.');

    // }

    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return redirect()->route('login.admin')->withErrors('You do not have access to this section.');
        }

        return $next($request);
    }
}
