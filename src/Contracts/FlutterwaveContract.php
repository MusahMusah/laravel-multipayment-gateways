<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface FlutterwaveContract
{
    /**
     * Resolve the authorization URL / Endpoint
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void;

    /**
     * Set the access token for the request
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     */
    public function decodeResponse(): mixed;

    /**
     * Get the response
     */
    public function getResponse(): mixed;

    /**
     * Get the data from the response
     */
    public function getData(): mixed;
}
