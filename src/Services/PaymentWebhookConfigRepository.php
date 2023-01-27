<?php

namespace MusahMusah\LaravelMultipaymentGateways\Services;

class PaymentWebhookConfigRepository
{
    protected array $webhookConfig;

    /**
    * Store the webhook configuration for a specific payment gateway
    *
    * @param PaymentWebhookConfig $webhookConfig
    */
    public function storeConfig(PaymentWebhookConfig $webhookConfig)
    {
        $this->webhookConfig[$webhookConfig->name] = $webhookConfig;
    }

    /**
    * Retrieve the webhook configuration for a specific payment gateway
    *
    * @param string $name The name of the payment gateway
    * @return PaymentWebhookConfig|null
    */
    public function getConfig(string $name)
    {
        return $this->webhookConfig[$name] ?? null;
    }
}
