<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways;

use Illuminate\Support\Manager;
use MusahMusah\LaravelMultipaymentGateways\Gateways\FlutterwaveService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\KudaService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeService;

class PaymentManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return config('multipayment-gateways.default', 'paystack');
    }

    public function createPaystackDriver(): PaystackService
    {
        return $this->container->make(PaystackService::class);
    }

    public function createFlutterwaveDriver(): FlutterwaveService
    {
        return $this->container->make(FlutterwaveService::class);
    }

    public function createStripeDriver(): StripeService
    {
        return $this->container->make(StripeService::class);
    }

    public function createKudaDriver(): KudaService
    {
        return $this->container->make(KudaService::class);
    }
}
