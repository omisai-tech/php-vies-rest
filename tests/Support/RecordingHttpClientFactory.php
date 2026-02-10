<?php

declare(strict_types=1);

namespace Tests\Support;

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;

class RecordingHttpClientFactory implements HttpClientFactoryInterface
{
    public ?string $lastBaseUrl = null;

    /** @var null|array<string, mixed> */
    public ?array $lastOptions = null;

    public function __construct(private HttpClientInterface $client) {}

    public function create(string $baseUrl, array $options = []): HttpClientInterface
    {
        $this->lastBaseUrl = $baseUrl;
        $this->lastOptions = $options;

        return $this->client;
    }
}
