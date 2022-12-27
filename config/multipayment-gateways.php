<?php

// config for MusahMusah/LaravelMultipaymentGateways
return [
    'paystack' => [
        'base_uri' => env('PAYSTACK_BASE_URI'),
        'secret' => env('PAYSTACK_SECRET'),
        'currency' => env('PAYSTACK_CURRENCY'),
    ],
];
