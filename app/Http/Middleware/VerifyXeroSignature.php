<?php

namespace App\Http\Middleware;

use Closure;

class VerifyXeroSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $computedSignatureKey = base64_encode(hash_hmac('sha256', $request->getContent(), config('xero/config.signing_key'), true));
        
        if(!hash_equals($computedSignatureKey, $request->headers->get('x-xero-signature'))){
            $response = response()->json(null, 401);
            $response->setContent(null);
            return $response;
        }
        
        return $next($request);
    }
}
