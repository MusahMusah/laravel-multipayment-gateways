<?php

namespace MusahMusah\LaravelMultipaymentGateways\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MusahMusah\LaravelMultipaymentGateways\Models\PaymentWebhookLog;

class ProcessPaymentWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $webhookPayload,
        public PaymentWebhookLog $paymentWebhookLog)
    {
    }
}
