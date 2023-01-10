<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class StripeWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $webhookPayload = json_decode($request->getContent(), true);
        $eventName = Str::studly(str_replace('.', '_', $webhookPayload['type']));
        $method = "handle{$eventName}";

        if (method_exists($this, $method)) {
            $response = $this->{$method}($webhookPayload);
            info("Stripe webhook {$eventName} handled successfully");

            return $response;
        }

        return $this->methodMissing();
    }

    protected function methodMissing(): JsonResponse
    {
        return new JsonResponse();
    }
}
