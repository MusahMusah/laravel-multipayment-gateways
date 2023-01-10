<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use Illuminate\Contracts\Support\DeferrableProvider;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMultipaymentGatewaysServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-multipayment-gateways')
            ->hasRoute('web')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->bind(PaystackContract::class, PaystackService::class);
        $this->app->bind(StripeContract::class, StripeService::class);
    }

    public function provides(): array
    {
        return [PaystackContract::class, StripeContract::class];
    }
}
