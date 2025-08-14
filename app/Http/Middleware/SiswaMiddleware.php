<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'siswa') {
            return $next($request);
        }

        return redirect('/'); // Kalau bukan siswa, diarahkan ke beranda
    }
}