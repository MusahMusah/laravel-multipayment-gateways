<?php

// config for MusahMusah/LaravelMultipaymentGateways
return [
    'paystack' => [
        'base_uri' => env('PAYSTACK_BASE_URI'),
        'secret' => env('PAYSTACK_SECRET'),
        'currency' => env('PAYSTACK_CURRENCY'),
    ],

    'stripe' => [
        'base_uri' => env('STRIPE_BASE_URI'),
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        'currency' => env('STRIPE_CURRENCY'),
        'plans' => [
            'monthly' => env('STRIPE_MONTHLY_PLAN'),
            'yearly' => env('STRIPE_YEARLY_PLAN'),
        ],
    ],
];
