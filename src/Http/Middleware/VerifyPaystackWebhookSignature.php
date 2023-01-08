<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyPaystackWebhookSignature
{
    /**
     * Handle the incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ((! $request->isMethod('post')) || ! $request->header('HTTP_X_PAYSTACK_SIGNATURE', null)) {
            throw new AccessDeniedHttpException("Invalid HTTP method or missing signature header.");
        }

        $requestContent = $request->getContent();
        $paystackSecret = config('paystackwebhooks.secret', env('PAYSTACK_SECRET'));
        $signature = hash_hmac('sha512', $requestContent, $paystackSecret);

        if ($signature !== $request->header('HTTP_X_PAYSTACK_SIGNATURE')) {
            throw new AccessDeniedHttpException("Invalid signature, possible tampering detected.");
        }

        return $next($request);
    }
}
