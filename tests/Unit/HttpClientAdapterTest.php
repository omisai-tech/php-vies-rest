<?php

declare(strict_types=1);

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Http\HttpClientAdapter;

it('implements HttpClientInterface', function (): void {
    $adapter = new HttpClientAdapter('https://example.com');

    expect($adapter)->toBeInstanceOf(HttpClientInterface::class);
});
