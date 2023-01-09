<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Middleware;

use Closure;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class VerifyStripeWebhookSignature
{
    public function handle($request, Closure $next) {
        if ((! $request->isMethod('post')) || ! $request->header('HTTP_STRIPE_SIGNATURE', null)) {
            throw new AccessDeniedHttpException('Invalid HTTP method or missing signature header.');
        }

        try {
            $requestContent = $request->getContent();
            $stripeWebHookSecret = config('stripe.webhook_secret', env('STRIPE_WEBHOOK_SECRET'));

             $event  = Webhook::constructEvent(
                $requestContent,
                $request->header('stripe-signature'),
                $stripeWebHookSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            throw new AccessDeniedHttpException('Invalid payload.');
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            throw new AccessDeniedHttpException('Invalid signature, possible tampering detected.');
        }

        return $next($request);
    }
}
