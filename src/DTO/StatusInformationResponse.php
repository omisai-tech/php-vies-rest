<?php

declare(strict_types=1);

namespace Omisai\ViesRest\DTO;

class StatusInformationResponse
{
    /** @param CountryStatus[] $countries */
    public function __construct(
        public readonly StatusInformationResponseVow $vow,
        public readonly array $countries,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromApiResponse(array $data): self
    {
        $vowData = is_array($data['vow'] ?? null) ? $data['vow'] : [];
        $countries = [];

        if (isset($data['countries']) && is_array($data['countries'])) {
            foreach ($data['countries'] as $country) {
                if (is_array($country)) {
                    $countries[] = CountryStatus::fromApiResponse($country);
                }
            }
        }

        return new self(
            StatusInformationResponseVow::fromApiResponse($vowData),
            $countries,
        );
    }
}
