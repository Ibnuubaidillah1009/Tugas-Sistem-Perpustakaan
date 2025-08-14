<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class LastUserActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            Cache::put('user-is-online-' . auth()->id(), true, now()->addMinutes(5));
        }
        return $next($request);
    }
}
