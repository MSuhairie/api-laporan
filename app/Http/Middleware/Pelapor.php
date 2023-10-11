<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pelapor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->roles == 'Pelapor') {
            return $next($request);
        }
            return response()->json(['message' => 'Maaf Anda Tidak diberi Akses']);
    }
}
