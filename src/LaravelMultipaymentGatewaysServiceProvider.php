<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use MusahMusah\LaravelMultipaymentGateways\Contracts\FlutterwaveContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Gateways\FlutterwaveService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeService;
use MusahMusah\LaravelMultipaymentGateways\Http\Controllers\PaymentWebhookController;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfigRepository;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelMultipaymentGatewaysServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-multipayment-gateways')
            ->hasConfigFile()
            ->hasMigrations('create_payment_webhook_logs_table');
    }

    public function packageRegistered()
    {
        $this->app->bind(PaystackContract::class, PaystackService::class);
        $this->app->bind(StripeContract::class, StripeService::class);
        $this->app->bind(FlutterwaveContract::class, FlutterwaveService::class);

        $this->registerWebHookConfig();
    }

    public function provides(): array
    {
        return [
            PaystackContract::class,
            StripeContract::class,
            PaymentWebhookConfigRepository::class,
            PaymentWebhookConfig::class,
            FlutterwaveContract::class
        ];
    }

    private function registerWebHookConfig()
    {
        $this->registerWebHookRoute();
        $this->registerWebHookBindings();
    }

    private function registerWebHookRoute()
    {
        Route::macro('webhooks', function (string $url, string $name = 'stripe') {
            return Route::post($url, PaymentWebhookController::class)->name("{$name}-payment-webhook");
        });
    }

    private function registerWebHookBindings()
    {
        $this->app->scoped(PaymentWebhookConfigRepository::class, function () {
            $configRepository = new PaymentWebhookConfigRepository();
            $webhookConfigs = config('multipayment-gateways.webhooks');

            collect($webhookConfigs)
                ->map(fn (array $config) => new PaymentWebhookConfig($config))
                ->each(fn (PaymentWebhookConfig $webhookConfig) => $configRepository->storeConfig($webhookConfig));

            return $configRepository;
        });

        $this->app->bind(PaymentWebhookConfig::class, function () {
            $routeName = request()->route()?->getName() ?? 'stripe-payment-webhook';
            $configName = Str::before($routeName, '-payment-webhook');

            $paymentWebhookConfig = app(PaymentWebhookConfigRepository::class)->getConfig($configName);

            if (is_null($paymentWebhookConfig)) {
                throw InvalidPaymentWebhookConfig::webhookConfigMissing($configName);
            }

            return $paymentWebhookConfig;
        });
    }
}
