<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Tests;

use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGatewaysServiceProvider;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;
use Mockery\MockInterface;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected PaystackContract&MockInterface $paystack;

    protected FlutterwaveContract&MockInterface $flutterwave;

    protected StripeContract&MockInterface $stripe;

    protected HttpClientWrapper&MockInterface $httpClientWrapper;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var PaystackContract&MockInterface $paystack */
        $paystack = $this->mock(PaystackContract::class);
        $this->paystack = $paystack;
        $this->instance('paystack', $paystack);

        /** @var FlutterwaveContract&MockInterface $flutterwave */
        $flutterwave = $this->mock(FlutterwaveContract::class);
        $this->flutterwave = $flutterwave;
        $this->instance('flutterwave', $flutterwave);

        /** @var StripeContract&MockInterface $stripe */
        $stripe = $this->mock(StripeContract::class);
        $this->stripe = $stripe;
        $this->instance('stripe', $stripe);

        /** @var HttpClientWrapper&MockInterface $httpClientWrapper */
        $httpClientWrapper = $this->mock(HttpClientWrapper::class);
        $this->httpClientWrapper = $httpClientWrapper;
        $this->instance('httpClientWrapper', $httpClientWrapper);
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelMultipaymentGatewaysServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-multipayment-gateways_table.php.stub';
        $migration->up();
        */
    }
}
