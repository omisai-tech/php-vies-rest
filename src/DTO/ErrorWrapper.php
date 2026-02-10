<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class ErrorWrapper
{
    public function __construct(
        public readonly string $error,
        public readonly ?string $message = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            (string) ($data['error'] ?? ''),
            isset($data['message']) ? (string) $data['message'] : null,
        );
    }
}
