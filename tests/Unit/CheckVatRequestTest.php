<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\CheckVatRequest;

it('creates CheckVatRequest with required fields', function (): void {
    $request = new CheckVatRequest(
        countryCode: 'DE',
        vatNumber: '123456789'
    );

    expect($request->countryCode)->toBe('DE')
        ->and($request->vatNumber)->toBe('123456789')
        ->and($request->requesterMemberStateCode)->toBeNull();
});

it('creates CheckVatRequest with all fields', function (): void {
    $request = new CheckVatRequest(
        countryCode: 'DE',
        vatNumber: '123456789',
        requesterMemberStateCode: 'FR',
        requesterNumber: '987654321',
        traderName: 'Test Company',
        traderStreet: 'Test Street',
        traderPostalCode: '12345',
        traderCity: 'Test City',
        traderCompanyType: 'Ltd'
    );

    expect($request->countryCode)->toBe('DE')
        ->and($request->vatNumber)->toBe('123456789')
        ->and($request->requesterMemberStateCode)->toBe('FR')
        ->and($request->traderName)->toBe('Test Company');
});

it('converts to array filtering nulls', function (): void {
    $request = new CheckVatRequest(
        countryCode: 'DE',
        vatNumber: '123456789',
        traderName: 'Test Company',
        traderStreet: null
    );

    $array = $request->toArray();

    expect($array)->toHaveKey('countryCode')
        ->and($array)->toHaveKey('vatNumber')
        ->and($array)->toHaveKey('traderName')
        ->and($array)->not->toHaveKey('traderStreet')
        ->and($array['traderName'])->toBe('Test Company');
});
