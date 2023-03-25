<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Paystack;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\InvalidConfigurationException;

trait BankTrait
{
    /**
     * Hit Paystack's API to get all the Banks
     *
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getBanks(): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'bank'
        );
    }

    /**
     * Hit Paystack's API to resolve a bank account
     *
     *
     * @param array $payload
     * @return array
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function resolveAccountNumber(array $payload): array
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'bank/resolve',
            queryParams: $payload
        );
    }
}
