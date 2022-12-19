<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MusahMusah\LaravelMultipaymentGateways\Commands\LaravelMultipaymentGatewaysCommand;

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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-multipayment-gateways_table')
            ->hasCommand(LaravelMultipaymentGatewaysCommand::class);
    }
}
