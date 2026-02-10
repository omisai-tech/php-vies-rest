<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class CountryStatus
{
    public const AVAILABILITY_AVAILABLE = 'Available';

    public const AVAILABILITY_UNAVAILABLE = 'Unavailable';

    public const AVAILABILITY_MONITORING_DISABLED = 'Monitoring Disabled';

    public function __construct(
        public readonly string $countryCode,
        public readonly string $availability,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromApiResponse(array $data): self
    {
        return new self(
            (string) ($data['countryCode'] ?? ''),
            (string) ($data['availability'] ?? ''),
        );
    }
}
