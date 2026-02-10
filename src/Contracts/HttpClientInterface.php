<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Contracts;

interface HttpClientInterface
{
    /** @param array<string, string> $payload */
    public function checkVat(array $payload): array;

    /** @param array<string, string> $payload */
    public function checkVatTest(array $payload): array;

    public function checkStatus(): array;
}
