<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheBrowser
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->header('Cache-Control', 'public, max-age=3600');

        return $response;
    }
}