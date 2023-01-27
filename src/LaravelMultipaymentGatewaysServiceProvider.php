<?php

namespace MusahMusah\LaravelMultipaymentGateways;

use Illuminate\Contracts\Support\DeferrableProvider;
use MusahMusah\LaravelMultipaymentGateways\Contracts\PaystackContract;
use MusahMusah\LaravelMultipaymentGateways\Contracts\StripeContract;
use MusahMusah\LaravelMultipaymentGateways\Gateways\PaystackService;
use MusahMusah\LaravelMultipaymentGateways\Gateways\StripeService;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidPaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfig;
use MusahMusah\LaravelMultipaymentGateways\Services\PaymentWebhookConfigRepository;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Illuminate\Support\Facades\Route;
use MusahMusah\LaravelMultipaymentGateways\Http\Controllers\PaymentWebhookController;

class LaravelMultipaymentGatewaysServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-multipayment-gateways')
            ->hasRoute('web')
            ->hasConfigFile()
            ->hasMigrations('create_payment_webhook_logs_table');
    }

    public function packageRegistered()
    {
        $this->app->bind(PaystackContract::class, PaystackService::class);
        $this->app->bind(StripeContract::class, StripeService::class);

        Route::macro('webhooks', function (string $url, string $name = 'default') {
            return Route::post($url, [PaymentWebhookController::class, '__invoke'])->name("{$name}-payment-webhook");
        });

        $webhookConfigs = config('multipayment-gateways.configs');
        $webhookConfigObjects = collect($webhookConfigs)->map(fn ($config) => new PaymentWebhookConfig($config));
        $configRepository = new PaymentWebhookConfigRepository();
        $webhookConfigObjects->each(fn ($webhookConfig) => $configRepository->storeConfig($webhookConfig));

        $this->app->bind(PaymentWebhookConfig::class, function () use ($configRepository) {
            $routeName = request()->route()->getName() ?? '';
            $configName = Str::before($routeName, '-payment-webhook');
            $paymentWebhookConfig = $configRepository->getConfig($configName);

            if (is_null($paymentWebhookConfig)) {
                throw InvalidPaymentWebhookConfig::webhookConfigMissing($configName);
            }

            return $paymentWebhookConfig;
        });
    }

    public function provides(): array
    {
        return [PaystackContract::class, StripeContract::class];
    }
}
