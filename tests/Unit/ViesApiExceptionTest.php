<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\ErrorWrapper;
use Omisai\ViesRest\Exceptions\ViesApiException;

it('creates ViesApiException with error wrappers', function (): void {
    $wrappers = [new ErrorWrapper('ERROR', 'Message')];
    $exception = new ViesApiException('API error', 400, null, null, $wrappers);

    expect($exception->getMessage())->toBe('API error')
        ->and($exception->getStatusCode())->toBe(400)
        ->and($exception->getErrorWrappers())->toBe($wrappers);
});

it('parses error wrappers from response body', function (): void {
    $body = json_encode(['errorWrappers' => [['error' => 'INVALID', 'message' => 'Invalid']]]);
    $exception = new ViesApiException('Error', null, null, $body);

    $wrappers = $exception->getErrorWrappers();
    expect($wrappers)->toHaveCount(1)
        ->and($wrappers[0]->error)->toBe('INVALID');
});

it('returns empty wrappers for invalid body', function (): void {
    $exception = new ViesApiException('Error', null, null, 'invalid json');

    expect($exception->getErrorWrappers())->toBeEmpty();
});
