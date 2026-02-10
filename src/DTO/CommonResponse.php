<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class CommonResponse
{
    /** @param ErrorWrapper[] $errorWrappers */
    public function __construct(
        public readonly bool $actionSucceed,
        public readonly array $errorWrappers = [],
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromApiResponse(array $data): self
    {
        $wrappers = [];
        if (isset($data['errorWrappers']) && is_array($data['errorWrappers'])) {
            foreach ($data['errorWrappers'] as $wrapper) {
                if (is_array($wrapper)) {
                    $wrappers[] = ErrorWrapper::fromArray($wrapper);
                }
            }
        }

        return new self(
            (bool) ($data['actionSucceed'] ?? false),
            $wrappers,
        );
    }
}
