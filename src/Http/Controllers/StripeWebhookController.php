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
            return $this->{$method}($webhookPayload);
        }

        return $this->methodMissing();
    }

    protected function methodMissing(): JsonResponse
    {
        return new JsonResponse();
    }
}
