<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface FlutterwaveContract
{
    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(array &$queryParams, array|string &$formParams, array &$headers): void;

    /**
     * Set the access token for the request
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     */
    public function decodeResponse(): array|string;

    /**
     * Get the response
     */
    public function getResponse(): array;

    /**
     * Get the data from the response
     */
    public function getData(): array;
}
