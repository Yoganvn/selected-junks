<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek: Kalau belum login ATAU role-nya bukan admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Tendang ke halaman home / error
            abort(403, 'ANDA BUKAN ADMIN!');
        }

        return $next($request);
    }
}