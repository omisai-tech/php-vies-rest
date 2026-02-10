<?php

declare(strict_types=1);

use Omisai\ViesRest\Exceptions\ViesValidationException;

it('is instance of ViesException', function (): void {
    $exception = new ViesValidationException('Validation error');

    expect($exception)->toBeInstanceOf(ViesValidationException::class)
        ->and($exception)->toBeInstanceOf(\Omisai\ViesRest\Exceptions\ViesException::class);
});
