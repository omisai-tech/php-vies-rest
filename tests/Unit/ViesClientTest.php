<?php

declare(strict_types=1);

use Omisai\ViesRest\DTO\CheckVatRequest;
use Omisai\ViesRest\DTO\CheckVatResponse;
use Omisai\ViesRest\DTO\StatusInformationResponse;
use Omisai\ViesRest\Enum\VatMatch;
use Omisai\ViesRest\Exceptions\ViesApiException;
use Omisai\ViesRest\Exceptions\ViesValidationException;
use Omisai\ViesRest\ViesClient;
use Omisai\ViesRest\ViesConfig;
use Tests\Support\FakeHttpClient;
use Tests\Support\FakeHttpClientFactory;
use Tests\Support\RecordingHttpClientFactory;

it('checks VAT numbers and normalizes country codes', function (): void {
    $apiResponse = [
        'countryCode' => 'DE',
        'vatNumber' => '123456789',
        'requestDate' => '2026-02-10T12:00:00+00:00',
        'valid' => true,
        'name' => 'Test Company GmbH',
        'address' => 'Test Street 123, 12345 Berlin',
    ];

    $fakeClient = new FakeHttpClient($apiResponse);
    $client = new ViesClient(clientFactory: new FakeHttpClientFactory($fakeClient));

    $response = $client->checkVat('de', '123456789');

    expect($response)->toBeInstanceOf(CheckVatResponse::class)
        ->and($response->countryCode)->toBe('DE')
        ->and($response->vatNumber)->toBe('123456789')
        ->and($response->valid)->toBeTrue()
        ->and($response->name)->toBe('Test Company GmbH')
        ->and($response->address)->toBe('Test Street 123, 12345 Berlin')
        ->and($fakeClient->lastMethod)->toBe('checkVat')
        ->and($fakeClient->lastParams['countryCode'])->toBe('DE');
});

it('checks VAT numbers with approximate data', function (): void {
    $apiResponse = [
        'countryCode' => 'FR',
        'vatNumber' => '12345678901',
        'requestDate' => '2026-02-10T12:00:00+00:00',
        'valid' => true,
        'traderName' => 'Example SARL',
        'traderStreet' => '1 Rue Example',
        'traderPostalCode' => '75001',
        'traderCity' => 'Paris',
        'traderNameMatch' => 'VALID',
    ];

    $fakeClient = new FakeHttpClient($apiResponse);
    $client = new ViesClient(clientFactory: new FakeHttpClientFactory($fakeClient));

    $request = new CheckVatRequest(
        countryCode: 'fr',
        vatNumber: '12345678901',
        traderName: 'Example SARL',
        traderStreet: '1 Rue Example',
        traderPostalCode: '75001',
        traderCity: 'Paris',
        requesterMemberStateCode: 'DE',
        requesterNumber: '123456789',
    );

    $response = $client->checkVatApprox($request);

    expect($response->traderName)->toBe('Example SARL')
        ->and($response->traderStreet)->toBe('1 Rue Example')
        ->and($response->traderPostalCode)->toBe('75001')
        ->and($response->traderCity)->toBe('Paris')
        ->and($response->traderNameMatch)->toBe(VatMatch::VALID)
        ->and($fakeClient->lastParams['requesterMemberStateCode'])->toBe('DE')
        ->and($fakeClient->lastParams['requesterNumber'])->toBe('123456789');
});

it('uses test service when configured', function (): void {
    $apiResponse = [
        'countryCode' => 'DE',
        'vatNumber' => '100',
        'requestDate' => '2026-02-10T12:00:00+00:00',
        'valid' => true,
    ];

    $fakeClient = new FakeHttpClient($apiResponse);
    $client = new ViesClient(
        config: ViesConfig::test(),
        clientFactory: new FakeHttpClientFactory($fakeClient)
    );

    $client->checkVat('DE', '100');

    expect($fakeClient->lastMethod)->toBe('checkVatTest');
});

it('creates clients with configured base URL', function (): void {
    $fakeClient = new FakeHttpClient([]);
    $factory = new RecordingHttpClientFactory($fakeClient);

    $client = new ViesClient(
        config: ViesConfig::production(options: ['timeout' => 10], baseUrl: 'https://example.com'),
        clientFactory: $factory
    );

    $client->checkStatus();

    expect($factory->lastBaseUrl)->toBe('https://example.com')
        ->and($factory->lastOptions)->toBe(['timeout' => 10]);
});

it('returns service status', function (): void {
    $apiResponse = [
        'vow' => ['available' => true],
        'countries' => [
            ['countryCode' => 'DE', 'availability' => 'Available'],
        ],
    ];

    $fakeClient = new FakeHttpClient($apiResponse);
    $client = new ViesClient(clientFactory: new FakeHttpClientFactory($fakeClient));

    $response = $client->checkStatus();

    expect($response)->toBeInstanceOf(StatusInformationResponse::class)
        ->and($response->vow->available)->toBeTrue()
        ->and($response->countries[0]->countryCode)->toBe('DE');
});

it('throws validation exception for invalid inputs', function (): void {
    $client = new ViesClient(clientFactory: new FakeHttpClientFactory(new FakeHttpClient([])));

    $client->checkVat('D1', '123');
})->throws(ViesValidationException::class);

it('propagates API exceptions', function (): void {
    $exception = new ViesApiException('API error', 400);
    $fakeClient = new FakeHttpClient(null, $exception);
    $client = new ViesClient(clientFactory: new FakeHttpClientFactory($fakeClient));

    $client->checkVat('DE', '123456789');
})->throws(ViesApiException::class);
