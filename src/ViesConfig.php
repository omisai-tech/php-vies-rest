<?php

declare(strict_types=1);

namespace Omisai\ViesRest;

class ViesConfig
{
    public const PRODUCTION_BASE_URL = 'https://ec.europa.eu/taxation_customs/vies/rest-api';

    public const TEST_BASE_URL = 'https://ec.europa.eu/taxation_customs/vies/rest-api';

    /** @param array<string, mixed> $options */
    public function __construct(
        private string $baseUrl = self::PRODUCTION_BASE_URL,
        private array $options = [],
        private bool $useTestService = false,
    ) {}

    /** @param array<string, mixed> $options */
    public static function production(array $options = [], ?string $baseUrl = null): self
    {
        return new self($baseUrl ?? self::PRODUCTION_BASE_URL, $options, false);
    }

    /** @param array<string, mixed> $options */
    public static function test(array $options = [], ?string $baseUrl = null): self
    {
        return new self($baseUrl ?? self::TEST_BASE_URL, $options, true);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /** @return array<string, mixed> */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function usesTestService(): bool
    {
        return $this->useTestService;
    }
}
