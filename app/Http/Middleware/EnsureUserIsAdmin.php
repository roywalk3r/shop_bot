<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user is an admin
            if (Auth::user()->role === 'admin') {
                // If the user is an admin, proceed with the request
                return $next($request);
            } else {
                // If the user is not an admin, and they are trying to access the admin login page, redirect them to the regular user login page
                if ($request->is('admin')) {
                    abort(403, 'Unauthorized');
                }
            }
        } else {
            // If the user is not authenticated, and they are trying to access the admin login page, proceed with the request
            if ($request->is('admin')) {
                return $next($request);
            }
        }

        // If the user is not authenticated or not an admin, redirect to the regular user login page
        return $next($request);
    }
}