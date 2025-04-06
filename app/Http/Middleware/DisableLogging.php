<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class DisableLogging
{
    public function handle($request, Closure $next)
    {
        Log::swap(new \Monolog\Logger('null'));
        return $next($request);
    }
}