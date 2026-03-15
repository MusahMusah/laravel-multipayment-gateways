<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface KudaContract extends GatewayContract
{
    /**
     * Retrieve the API token from Kuda, with caching
     */
    public function retrieveApiToken(): mixed;
}
