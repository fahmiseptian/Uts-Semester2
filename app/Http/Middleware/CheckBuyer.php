<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBuyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah ID ada di sesi
        if (!$request->session()->has('is_buyer')) {
            // Jika tidak ada, redirect ke halaman login
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
