<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

use Omisai\ViesRest\Enum\VatMatch;

class CheckVatResponse
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $vatNumber,
        public readonly \DateTimeImmutable $requestDate,
        public readonly bool $valid,
        public readonly ?string $requestIdentifier,
        public readonly ?string $name,
        public readonly ?string $address,
        public readonly ?string $traderName,
        public readonly ?string $traderStreet,
        public readonly ?string $traderPostalCode,
        public readonly ?string $traderCity,
        public readonly ?string $traderCompanyType,
        public readonly ?VatMatch $traderNameMatch,
        public readonly ?VatMatch $traderStreetMatch,
        public readonly ?VatMatch $traderPostalCodeMatch,
        public readonly ?VatMatch $traderCityMatch,
        public readonly ?VatMatch $traderCompanyTypeMatch,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromApiResponse(array $data): self
    {
        $requestDate = new \DateTimeImmutable((string) ($data['requestDate'] ?? 'now'));

        return new self(
            (string) ($data['countryCode'] ?? ''),
            (string) ($data['vatNumber'] ?? ''),
            $requestDate,
            (bool) ($data['valid'] ?? false),
            isset($data['requestIdentifier']) ? (string) $data['requestIdentifier'] : null,
            isset($data['name']) ? (string) $data['name'] : null,
            isset($data['address']) ? (string) $data['address'] : null,
            isset($data['traderName']) ? (string) $data['traderName'] : null,
            isset($data['traderStreet']) ? (string) $data['traderStreet'] : null,
            isset($data['traderPostalCode']) ? (string) $data['traderPostalCode'] : null,
            isset($data['traderCity']) ? (string) $data['traderCity'] : null,
            isset($data['traderCompanyType']) ? (string) $data['traderCompanyType'] : null,
            self::parseMatch($data['traderNameMatch'] ?? null),
            self::parseMatch($data['traderStreetMatch'] ?? null),
            self::parseMatch($data['traderPostalCodeMatch'] ?? null),
            self::parseMatch($data['traderCityMatch'] ?? null),
            self::parseMatch($data['traderCompanyTypeMatch'] ?? null),
        );
    }

    private static function parseMatch(mixed $value): ?VatMatch
    {
        if ($value === null) {
            return null;
        }

        return VatMatch::tryFrom((string) $value);
    }
}
