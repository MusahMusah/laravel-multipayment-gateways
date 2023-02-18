<?php

namespace MusahMusah\LaravelMultipaymentGateways\Contracts;

interface GatewayContract
{
    public function setPaymentGateway(): void;

    public function setBaseUri(): void;

    public function setSecret(): void;

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers): void;

    public function resolveAccessToken(): string;

    public function decodeResponse(): array|string;

    public function getResponse(): array;

    public function getData(): array;
}
