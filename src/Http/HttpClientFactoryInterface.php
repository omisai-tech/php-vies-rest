<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Http;

use Omisai\ViesRest\Contracts\HttpClientInterface;

interface HttpClientFactoryInterface
{
    /** @param array<string, mixed> $options */
    public function create(string $baseUrl, array $options = []): HttpClientInterface;
}
