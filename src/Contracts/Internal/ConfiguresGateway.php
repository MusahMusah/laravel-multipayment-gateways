<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts\Internal;

interface ConfiguresGateway
{
    public function setPaymentGateway(): void;

    public function setBaseUri(): void;

    public function setSecret(): void;

    public function resolveAccessToken(): string;
}
