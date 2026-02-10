<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class StatusInformationResponseVow
{
    public function __construct(
        public readonly bool $available,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromApiResponse(array $data): self
    {
        return new self((bool) ($data['available'] ?? false));
    }
}
