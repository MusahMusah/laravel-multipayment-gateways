<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Tests;

use Mockery\MockInterface;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGatewaysServiceProvider;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;
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

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        // Set up gateway configs so real service classes can be instantiated in Http::fake() tests
        config()->set('multipayment-gateways.paystack.base_uri', 'https://api.paystack.co');
        config()->set('multipayment-gateways.paystack.secret', 'sk_test_paystack_secret');
        config()->set('multipayment-gateways.paystack.currency', 'NGN');

        config()->set('multipayment-gateways.flutterwave.base_uri', 'https://api.flutterwave.com/v3');
        config()->set('multipayment-gateways.flutterwave.secret', 'FLWSECK_TEST_flutterwave_secret');

        config()->set('multipayment-gateways.stripe.base_uri', 'https://api.stripe.com');
        config()->set('multipayment-gateways.stripe.secret', 'sk_test_stripe_secret');

        config()->set('multipayment-gateways.kuda.base_uri', 'https://kuda-openapi.kuda.com/v2');
        config()->set('multipayment-gateways.kuda.secret', 'kuda_test_api_key');
        config()->set('multipayment-gateways.kuda.email', 'test@kuda.com');
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelMultipaymentGatewaysServiceProvider::class,
        ];
    }
}
