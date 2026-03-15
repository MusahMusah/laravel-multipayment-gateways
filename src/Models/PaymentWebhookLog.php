<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;

class PaymentWebhookLog extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'request_headers' => 'array',
            'request_body' => 'array',
            'request_exception' => 'array',
        ];
    }

    public static function storePaymentWebhook(PaymentWebhookConfig $config, Request $request, string $requestHash): self
    {
        return self::create([
            'payment_gateway' => $config->name,
            'request_hash' => $requestHash,
            'request_url' => $request->fullUrl(),
            'request_ip' => $request->ip(),
            'request_headers' => $request->headers->all(),
            'request_body' => $request->input(),
        ]);
    }

    public function savePaymentWebhookException(Exception $exception): self
    {
        $this->setAttribute('request_exception', [
            'code' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        $this->save();

        return $this;
    }
}
