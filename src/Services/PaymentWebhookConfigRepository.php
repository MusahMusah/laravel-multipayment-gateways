<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

class PaymentWebhookConfigRepository
{
    protected array $webhookConfig;

    /**
     * Store the webhook configuration for a specific payment gateway
     */
    public function storeConfig(PaymentWebhookConfig $webhookConfig): void
    {
        $this->webhookConfig[$webhookConfig->name] = $webhookConfig;
    }

    /**
     * Retrieve the webhook configuration for a specific payment gateway
     *
     * @param  string  $name The name of the payment gateway
     */
    public function getConfig(string $name): ?PaymentWebhookConfig
    {
        return $this->webhookConfig[$name] ?? null;
    }
}
