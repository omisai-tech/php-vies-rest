<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\CountryStatus;

it('creates CountryStatus from API response', function (): void {
    $data = [
        'countryCode' => 'DE',
        'availability' => 'Available',
    ];

    $status = CountryStatus::fromApiResponse($data);

    expect($status->countryCode)->toBe('DE')
        ->and($status->availability)->toBe('Available');
});

it('handles missing data', function (): void {
    $data = [];

    $status = CountryStatus::fromApiResponse($data);

    expect($status->countryCode)->toBe('')
        ->and($status->availability)->toBe('');
});
