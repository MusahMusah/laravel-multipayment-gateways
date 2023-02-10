<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface FlutterwaveContract
{
    /**
     * Resolve the authorization URL / Endpoint
     *
     * @param $queryParams
     * @param $formParams
     * @param $headers
     * @return void
     */
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void;

    /**
     * Set the access token for the request
     *
     * @return string
     */
    public function resolveAccessToken(): string;

    /**
     * Decode the response
     *
     * @return mixed
     */
    public function decodeResponse(): mixed;

    /**
     * Get the response
     *
     * @return mixed
     */
    public function getResponse(): mixed;

    /**
     * Get the data from the response
     *
     * @return mixed
     */
    public function getData(): mixed;
}
