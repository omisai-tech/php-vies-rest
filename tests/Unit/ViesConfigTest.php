<?php

declare(strict_types=1);

use Omisai\ViesRest\ViesConfig;

it('creates production config', function (): void {
    $config = ViesConfig::production();

    expect($config->getBaseUrl())->toBe(ViesConfig::PRODUCTION_BASE_URL)
        ->and($config->usesTestService())->toBeFalse();
});

it('creates test config', function (): void {
    $config = ViesConfig::test();

    expect($config->getBaseUrl())->toBe(ViesConfig::TEST_BASE_URL)
        ->and($config->usesTestService())->toBeTrue();
});

it('creates config with custom base URL', function (): void {
    $config = ViesConfig::production(baseUrl: 'https://custom.com');

    expect($config->getBaseUrl())->toBe('https://custom.com');
});

it('creates config with options', function (): void {
    $options = ['timeout' => 30];
    $config = ViesConfig::production(options: $options);

    expect($config->getOptions())->toBe($options);
});

it('creates config with test service', function (): void {
    $config = new ViesConfig(baseUrl: 'https://test.com', options: [], useTestService: true);

    expect($config->usesTestService())->toBeTrue();
});
