<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;


trait BankTrait
{
    /**
     * Get list of banks for a given country by shortcode.
     */
    public function getBanks(string $countryCode): array
    {
        $banks = $this->httpClient()->get(
            url: '/banks/'.$countryCode,
        );

        // sort banks by name
        $names = array_column($banks['data'], 'name');
        array_multisort($names, SORT_ASC, $banks['data']);

        return $banks;
    }

    /**
     * Get all branches of a bank
     *
     * @param  int  $bankId  The ID of the bank for which to retrieve branches
     */
    public function getBankBranches(int $bankId): array
    {
        return $this->httpClient()->get(
            url: '/banks/'.$bankId.'/branches',
        );
    }
}
