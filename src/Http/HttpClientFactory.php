<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Http;

use Omisai\ViesRest\Contracts\HttpClientInterface;

class HttpClientFactory implements HttpClientFactoryInterface
{
    public function create(string $baseUrl, array $options = []): HttpClientInterface
    {
        return new HttpClientAdapter($baseUrl, $options);
    }
}
