<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Exceptions;

use Omisai\ViesRest\DTO\ErrorWrapper;
use Psr\Http\Message\ResponseInterface;

class ViesApiException extends ViesException
{
    private ?int $statusCode;

    /** @var null|array<string, string[]> */
    private ?array $responseHeaders;

    private ?string $responseBody;

    /** @var ErrorWrapper[] */
    private array $errorWrappers;

    /** @param ErrorWrapper[] $errorWrappers */
    public function __construct(
        string $message,
        ?int $statusCode = null,
        ?array $responseHeaders = null,
        ?string $responseBody = null,
        array $errorWrappers = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode ?? 0, $previous);

        if ($errorWrappers === [] && $responseBody !== null) {
            $errorWrappers = self::parseErrorWrappers($responseBody);
        }

        $this->statusCode = $statusCode;
        $this->responseHeaders = $responseHeaders;
        $this->responseBody = $responseBody;
        $this->errorWrappers = $errorWrappers;
    }

    public static function fromResponse(string $message, ?ResponseInterface $response = null, ?\Throwable $previous = null): self
    {
        $statusCode = $response?->getStatusCode();
        $headers = $response?->getHeaders();
        $body = $response ? (string) $response->getBody() : null;
        $errorWrappers = self::parseErrorWrappers($body);

        return new self($message, $statusCode, $headers, $body, $errorWrappers, $previous);
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /** @return null|array<string, string[]> */
    public function getResponseHeaders(): ?array
    {
        return $this->responseHeaders;
    }

    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }

    /** @return ErrorWrapper[] */
    public function getErrorWrappers(): array
    {
        return $this->errorWrappers;
    }

    /** @return ErrorWrapper[] */
    private static function parseErrorWrappers(?string $body): array
    {
        if ($body === null) {
            return [];
        }

        $decoded = json_decode($body, true);
        if (!is_array($decoded) || !isset($decoded['errorWrappers']) || !is_array($decoded['errorWrappers'])) {
            return [];
        }

        $wrappers = [];
        foreach ($decoded['errorWrappers'] as $wrapper) {
            if (is_array($wrapper)) {
                $wrappers[] = ErrorWrapper::fromArray($wrapper);
            }
        }

        return $wrappers;
    }
}
