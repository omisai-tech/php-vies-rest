<?php

declare(strict_types=1);

namespace Omisai\ViesRest\Http;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\Exceptions\ViesApiException;

class HttpClientAdapter implements HttpClientInterface
{
    private ClientInterface $client;

    /** @param array<string, mixed> $options */
    public function __construct(
        private string $baseUrl,
        array $options = [],
        ?ClientInterface $client = null,
    ) {
        $defaults = [
            'base_uri' => rtrim($this->baseUrl, '/').'/',
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        $this->client = $client ?? new Client(array_replace_recursive($defaults, $options));
    }

    public function checkVat(array $payload): array
    {
        return $this->request('POST', 'check-vat-number', $payload);
    }

    public function checkVatTest(array $payload): array
    {
        return $this->request('POST', 'check-vat-test-service', $payload);
    }

    public function checkStatus(): array
    {
        return $this->request('GET', 'check-status');
    }

    /** @param null|array<string, string> $payload */
    private function request(string $method, string $path, ?array $payload = null): array
    {
        $options = [];

        if ($payload !== null) {
            $options['json'] = $payload;
        }

        try {
            $response = $this->client->request($method, $path, $options);
        } catch (ConnectException $exception) {
            throw new ViesApiException('Connection error while contacting VIES REST API.', 0, null, null, [], $exception);
        } catch (RequestException $exception) {
            $response = $exception->getResponse();

            throw ViesApiException::fromResponse(
                $exception->getMessage(),
                $response,
                $exception
            );
        }

        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($statusCode < 200 || $statusCode > 299) {
            throw ViesApiException::fromResponse('Unexpected API response.', $response);
        }

        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            throw new ViesApiException('Unable to decode API response.', $statusCode, $response->getHeaders(), $body);
        }

        return $decoded;
    }
}
