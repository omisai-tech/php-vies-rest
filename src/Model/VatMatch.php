<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Model;

class VatMatch
{
    public const VALID = 'VALID';

    public const INVALID = 'INVALID';

    public const NOT_PROCESSED = 'NOT_PROCESSED';

    public static function getAllowableEnumValues(): array
    {
        return [
            self::VALID,
            self::INVALID,
            self::NOT_PROCESSED,
        ];
    }
}
