<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\CheckVatResponse;
use Omisai\ViesRest\Enum\VatMatch;

it('creates CheckVatResponse from API response', function (): void {
    $data = [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2026-02-10T12:00:00+00:00',
        'valid' => true,
        'name' => 'Test Company',
        'address' => 'Test Address',
        'traderNameMatch' => 'VALID',
    ];

    $response = CheckVatResponse::fromApiResponse($data);

    expect($response->countryCode)->toBe('DE')
        ->and($response->vatNumber)->toBe('123456789')
        ->and($response->valid)->toBeTrue()
        ->and($response->name)->toBe('Test Company')
        ->and($response->traderNameMatch)->toBe(VatMatch::VALID);
});

it('handles missing fields in API response', function (): void {
    $data = [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2026-02-10T12:00:00+00:00',
        'valid' => false,
    ];

    $response = CheckVatResponse::fromApiResponse($data);

    expect($response->name)->toBeNull()
        ->and($response->traderNameMatch)->toBeNull();
});

it('parses match values correctly', function (): void {
    expect(CheckVatResponse::fromApiResponse(['countryCode' => 'DE', 'vatNumber' => '1', 'requestDate' => 'now', 'valid' => true, 'traderNameMatch' => 'INVALID'])->traderNameMatch)->toBe(VatMatch::INVALID)
        ->and(CheckVatResponse::fromApiResponse(['countryCode' => 'DE', 'vatNumber' => '1', 'requestDate' => 'now', 'valid' => true, 'traderNameMatch' => null])->traderNameMatch)->toBeNull();
});
