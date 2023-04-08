<?php

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use GuzzleHttp\Exception\GuzzleException;
use MusahMusah\LaravelMultipaymentGateways\Constants\FlutterwaveConstant;
use MusahMusah\LaravelMultipaymentGateways\Exceptions\HttpMethodFoundException;

trait BankTrait
{
    /**
     * Get list of banks for a given country by shortcode.
     */
    public function getBanks(string $countryCode): array
    {

        $banks = flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::BANK_ENDPOINT.$countryCode,
        );

        // sort banks by name
        array_multisort(array_column($banks['data'], 'name'), SORT_ASC, $banks['data']);

        return $banks;
    }

    /**
     * Get all branches of a bank
     *
     * @param  int  $bankId The ID of the bank for which to retrieve branches
     *
     * @throws GuzzleException|HttpMethodFoundException
     */
    public function getBankBranches(int $bankId): array
    {
        return flutterwave()->httpClient()->get(
            url: FlutterwaveConstant::BANK_ENDPOINT.$bankId.'/branches',
        );
    }
}
