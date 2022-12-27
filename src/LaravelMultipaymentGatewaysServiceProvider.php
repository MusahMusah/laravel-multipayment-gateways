<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use Illuminate\Contracts\Support\DeferrableProvider;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMultipaymentGatewaysServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-multipayment-gateways')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->bind(PaystackContract::class, PaystackService::class);
    }

    public function provides(): array
    {
        return [PaystackContract::class];
    }
}
