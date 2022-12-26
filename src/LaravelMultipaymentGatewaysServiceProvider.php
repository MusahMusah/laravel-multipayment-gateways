<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMultipaymentGatewaysServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-multipayment-gateways')
            ->hasConfigFile();
//            ->hasViews()
//            ->hasMigration('create_laravel-multipayment-gateways_table')
//            ->hasCommand(LaravelMultipaymentGatewaysCommand::class);
    }

    public function register()
    {
        $this->app->singleton(PaystackContract::class, function () {
            return new Gateways\PaystackService;
        });
    }
}
