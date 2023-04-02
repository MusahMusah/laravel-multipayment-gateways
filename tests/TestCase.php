<?php

namespace MusahMusah\LaravelMultipaymentGateways\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGatewaysServiceProvider;
use MusahMusah\LaravelMultipaymentGateways\Services\HttpClientWrapper;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'MusahMusah\\LaravelMultipaymentGateways\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );


        $this->paystack = $this->instance('paystack', $this->mock(PaystackContract::class));
        $this->flutterwave = $this->instance('flutterwave', $this->mock(FlutterwaveContract::class));
        $this->stripe = $this->instance('stripe', $this->mock(StripeContract::class));

        $this->httpClientWrapper = $this->instance('httpClientWrapper', $this->mock(HttpClientWrapper::class));
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMultipaymentGatewaysServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-multipayment-gateways_table.php.stub';
        $migration->up();
        */
    }
}
