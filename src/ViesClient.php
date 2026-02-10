<?php

declare(strict_types=1);

namespace Omisai\ViesRest;

use Omisai\ViesRest\Contracts\HttpClientInterface;
use Omisai\ViesRest\DTO\CheckVatRequest;
use Omisai\ViesRest\DTO\CheckVatResponse;
use Omisai\ViesRest\DTO\StatusInformationResponse;
use Omisai\ViesRest\Http\HttpClientFactory;
use Omisai\ViesRest\Http\HttpClientFactoryInterface;
use Omisai\ViesRest\Validation\VatNumberValidator;

class ViesClient
{
    private HttpClientInterface $client;

    private VatNumberValidator $validator;

    public function __construct(
        private ViesConfig $config = new ViesConfig,
        ?HttpClientFactoryInterface $clientFactory = null,
        ?VatNumberValidator $validator = null,
    ) {
        $this->validator = $validator ?? new VatNumberValidator;

        $clientFactory ??= new HttpClientFactory;
        $this->client = $clientFactory->create($this->config->getBaseUrl(), $this->config->getOptions());
    }

    public function checkVat(string $countryCode, string $vatNumber): CheckVatResponse
    {
        [$countryCode, $vatNumber] = $this->validator->validate($countryCode, $vatNumber);

        $payload = [
            'countryCode' => $countryCode,
            'vatNumber' => $vatNumber,
        ];

        $response = $this->config->usesTestService()
            ? $this->client->checkVatTest($payload)
            : $this->client->checkVat($payload);

        return CheckVatResponse::fromApiResponse($response);
    }

    public function checkVatApprox(CheckVatRequest $request): CheckVatResponse
    {
        $payload = $request->toArray();

        $payload['countryCode'] = $this->validator->validateCountryCode($payload['countryCode']);
        $payload['vatNumber'] = $this->validator->validateVatNumber($payload['vatNumber']);

        if (array_key_exists('requesterMemberStateCode', $payload)) {
            $payload['requesterMemberStateCode'] = $this->validator->validateCountryCode($payload['requesterMemberStateCode']);
        }

        if (array_key_exists('requesterNumber', $payload)) {
            $payload['requesterNumber'] = $this->validator->validateVatNumber($payload['requesterNumber']);
        }

        $response = $this->config->usesTestService()
            ? $this->client->checkVatTest($payload)
            : $this->client->checkVat($payload);

        return CheckVatResponse::fromApiResponse($response);
    }

    public function checkStatus(): StatusInformationResponse
    {
        $response = $this->client->checkStatus();

        return StatusInformationResponse::fromApiResponse($response);
    }

    public function getConfig(): ViesConfig
    {
        return $this->config;
    }
}
