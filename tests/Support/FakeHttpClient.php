<?php

declare(strict_types=1);

namespace Tests\Support;

use Omisai\ViesRest\Contracts\HttpClientInterface;

class FakeHttpClient implements HttpClientInterface
{
    /** @var array<string, mixed> */
    public array $lastParams = [];

    public ?string $lastMethod = null;

    public function __construct(
        private ?array $response = null,
        private ?\Throwable $exception = null,
    ) {}

    public function checkVat(array $payload): array
    {
        $this->lastMethod = 'checkVat';
        $this->lastParams = $payload;

        if ($this->exception !== null) {
            throw $this->exception;
        }

        return $this->response ?? [];
    }

    public function checkVatTest(array $payload): array
    {
        $this->lastMethod = 'checkVatTest';
        $this->lastParams = $payload;

        if ($this->exception !== null) {
            throw $this->exception;
        }

        return $this->response ?? [];
    }

    public function checkStatus(): array
    {
        $this->lastMethod = 'checkStatus';
        $this->lastParams = [];

        if ($this->exception !== null) {
            throw $this->exception;
        }

        return $this->response ?? [];
    }
}
