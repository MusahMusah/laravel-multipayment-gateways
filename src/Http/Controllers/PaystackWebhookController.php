<?php

namespace MusahMusah\LaravelMultipaymentGateways\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class PaystackWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $webhookPayload = json_decode($request->getContent(), true);
        $eventName = Str::studly(str_replace('.', '_', $webhookPayload['event']));
        $method  = "handle{$eventName}";

        // TODO: Dispatch event of webhook received

        if (method_exists($this, $method)) {
            $response = $this->{$method}($webhookPayload);
            info("Paystack webhook {$eventName} handled successfully");
            // TODO: Dispatch event of webhook handled and create db record of it

            return $response;
        }

        return $this->methodMissing();
    }

    protected function methodMissing(): JsonResponse
    {
        return new JsonResponse();
    }
}
