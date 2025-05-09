<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KaryawanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $levelAkses = session('level_akses_name');
        if ($levelAkses) {
            return $next($request);
        }
        return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
