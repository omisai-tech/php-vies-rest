<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Enum;

enum VatMatch: string
{
    case VALID = 'VALID';
    case INVALID = 'INVALID';
    case NOT_PROCESSED = 'NOT_PROCESSED';
}
