<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface GatewayContract
{
    public function withConfig(array $config): static;
}
