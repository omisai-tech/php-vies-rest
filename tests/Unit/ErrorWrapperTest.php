<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\ErrorWrapper;

it('creates ErrorWrapper from array', function (): void {
    $data = [
        'error' => 'INVALID_INPUT',
        'message' => 'Invalid country code',
    ];

    $wrapper = ErrorWrapper::fromArray($data);

    expect($wrapper->error)->toBe('INVALID_INPUT')
        ->and($wrapper->message)->toBe('Invalid country code');
});

it('handles missing message', function (): void {
    $data = ['error' => 'ERROR'];

    $wrapper = ErrorWrapper::fromArray($data);

    expect($wrapper->error)->toBe('ERROR')
        ->and($wrapper->message)->toBeNull();
});
