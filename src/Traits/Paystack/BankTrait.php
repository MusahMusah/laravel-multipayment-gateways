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
     * @throws GuzzleException|HttpMethodFoundException|InvalidConfigurationException
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
     * @throws GuzzleException
     * @throws HttpMethodFoundException
     */
    public function resolveAccountNumber(string $accountNumber, string $bankCode): mixed
    {
        return $this->makeRequest(
            method: 'GET',
            requestUrl: 'bank/resolve',
            queryParams: [
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
            ]
        );
    }
}
