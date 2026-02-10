<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\StatusInformationResponseVow;

it('creates StatusInformationResponseVow from API response', function (): void {
    $data = ['available' => true];

    $vow = StatusInformationResponseVow::fromApiResponse($data);

    expect($vow->available)->toBeTrue();
});

it('defaults to false', function (): void {
    $data = [];

    $vow = StatusInformationResponseVow::fromApiResponse($data);

    expect($vow->available)->toBeFalse();
});
