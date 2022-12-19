<?php

namespace MusahMusah\LaravelMultipaymentGateways\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use MusahMusah\LaravelMultipaymentGateways\LaravelMultipaymentGatewaysServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'MusahMusah\\LaravelMultipaymentGateways\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
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
