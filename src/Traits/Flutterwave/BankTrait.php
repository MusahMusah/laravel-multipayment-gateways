<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Traits\Flutterwave;

use MusahMusah\LaravelMultipaymentGateways\Data\PaymentResponse;

trait BankTrait
{
    /**
     * Get list of banks for a given country by shortcode.
     */
    public function getBanks(string $countryCode): PaymentResponse
    {
        $raw = $this->httpClient()->get(url: '/banks/'.$countryCode);

        // sort banks by name
        $data = $raw['data'] ?? [];
        $names = array_column($data, 'name');
        array_multisort($names, SORT_ASC, $data);
        $raw['data'] = $data;

        return PaymentResponse::fromArray($raw);
    }

    /**
     * Get all branches of a bank
     *
     * @param  int  $bankId  The ID of the bank for which to retrieve branches
     */
    public function getBankBranches(int $bankId): PaymentResponse
    {
        return PaymentResponse::fromArray(
            $this->httpClient()->get(
                url: '/banks/'.$bankId.'/branches',
            )
        );
    }
}
