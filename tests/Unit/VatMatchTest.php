<?php

declare(strict_types=1);

use Omisai\ViesRest\Enum\VatMatch;

it('has correct cases', function (): void {
    expect(VatMatch::cases())->toHaveCount(3)
        ->and(VatMatch::VALID->value)->toBe('VALID')
        ->and(VatMatch::INVALID->value)->toBe('INVALID')
        ->and(VatMatch::NOT_PROCESSED->value)->toBe('NOT_PROCESSED');
});

it('can be created from string', function (): void {
    expect(VatMatch::from('VALID'))->toBe(VatMatch::VALID)
        ->and(VatMatch::tryFrom('INVALID'))->toBe(VatMatch::INVALID)
        ->and(VatMatch::tryFrom('UNKNOWN'))->toBeNull();
});
