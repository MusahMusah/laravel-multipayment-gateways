<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface GatewayContract
{
    public function setPaymentGateway(): void;

    public function setBaseUri(): void;

    public function setSecret(): void;

    public function resolveAuthorization(array &$queryParams, array|string &$formParams, array &$headers): void;

    public function resolveAccessToken(): string;

    public function decodeResponse(): array|string;

    public function getResponse(): array;

    public function getData(): array;
}
