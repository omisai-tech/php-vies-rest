<?php

declare(strict_types=1);

namespace Tests\Support;

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;

class FakeHttpClientFactory implements HttpClientFactoryInterface
{
    public function __construct(private HttpClientInterface $client) {}

    public function create(string $baseUrl, array $options = []): HttpClientInterface
    {
        return $this->client;
    }
}
