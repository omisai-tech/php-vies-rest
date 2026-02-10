<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\StatusInformationResponse;
use Omisai\ViesRest\DTO\StatusInformationResponseVow;

it('creates StatusInformationResponse from API response', function (): void {
    $data = [
        'vow' => ['available' => true],
        'countries' => [
            ['countryCode' => 'DE', 'availability' => 'Available'],
            ['countryCode' => 'FR', 'availability' => 'Unavailable'],
        ],
    ];

    $response = StatusInformationResponse::fromApiResponse($data);

    expect($response->vow)->toBeInstanceOf(StatusInformationResponseVow::class)
        ->and($response->vow->available)->toBeTrue()
        ->and($response->countries)->toHaveCount(2)
        ->and($response->countries[0]->countryCode)->toBe('DE');
});

it('handles empty countries', function (): void {
    $data = ['vow' => ['available' => false]];

    $response = StatusInformationResponse::fromApiResponse($data);

    expect($response->countries)->toBeEmpty();
});
