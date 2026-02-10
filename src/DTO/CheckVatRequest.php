<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class CheckVatRequest
{
    public function __construct(
        public readonly string $countryCode,
        public readonly string $vatNumber,
        public readonly ?string $requesterMemberStateCode = null,
        public readonly ?string $requesterNumber = null,
        public readonly ?string $traderName = null,
        public readonly ?string $traderStreet = null,
        public readonly ?string $traderPostalCode = null,
        public readonly ?string $traderCity = null,
        public readonly ?string $traderCompanyType = null,
    ) {}

    /** @return array<string, string> */
    public function toArray(): array
    {
        $payload = [
            'countryCode' => $this->countryCode,
            'vatNumber' => $this->vatNumber,
            'requesterMemberStateCode' => $this->requesterMemberStateCode,
            'requesterNumber' => $this->requesterNumber,
            'traderName' => $this->traderName,
            'traderStreet' => $this->traderStreet,
            'traderPostalCode' => $this->traderPostalCode,
            'traderCity' => $this->traderCity,
            'traderCompanyType' => $this->traderCompanyType,
        ];

        return array_filter(
            $payload,
            static fn (?string $value): bool => $value !== null
        );
    }
}
