<?php

declare(strict_types=1);

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Http\HttpClientFactory;

it('creates HttpClientInterface instance', function (): void {
    $factory = new HttpClientFactory;

    $client = $factory->create('https://example.com', ['timeout' => 10]);

    expect($client)->toBeInstanceOf(HttpClientInterface::class);
});
