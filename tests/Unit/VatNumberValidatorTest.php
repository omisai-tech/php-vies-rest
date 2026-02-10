<?php

declare(strict_types=1);

use Omisai\ViesRest\Exceptions\ViesValidationException;
use Omisai\ViesRest\Validation\VatNumberValidator;

it('validates country code and VAT number', function (): void {
    $validator = new VatNumberValidator;

    [$country, $vat] = $validator->validate('de', '123456789');

    expect($country)->toBe('DE')
        ->and($vat)->toBe('123456789');
});

it('throws for invalid country code', function (): void {
    $validator = new VatNumberValidator;

    $validator->validateCountryCode('D1');
})->throws(ViesValidationException::class);

it('throws for invalid VAT number', function (): void {
    $validator = new VatNumberValidator;

    $validator->validateVatNumber('invalid@');
})->throws(ViesValidationException::class);

it('normalizes input', function (): void {
    $validator = new VatNumberValidator;

    expect($validator->validateCountryCode(' de '))->toBe('DE')
        ->and($validator->validateVatNumber(' 123 '))->toBe('123');
});
