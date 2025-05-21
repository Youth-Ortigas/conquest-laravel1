<?php

namespace App\Http\Middleware;

use App\Traits\TraitsCommon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogCustom
{
    /**
     * [Traits] Common class
     * @var object
     */
    use TraitsCommon;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $assignUserID = Auth::user()->id ?? -1;
        $this->createUserActivityLogin($request, $assignUserID);
        return $next($request);
    }
}
