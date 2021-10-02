<?php

declare(strict_types=1);

namespace Sakila\Country;

use JsonSerializable;

class CountryModel implements JsonSerializable
{
    private int $countryId;
    private string $country;
    private string $lastUpdate;

    public function __construct(CountryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->countryId = $dto->countryId;
        $this->country = $dto->country;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): CountryDto
    {
        $dto = new CountryDto();
        $dto->countryId = (int) ($this->countryId ?? 0);
        $dto->country = $this->country ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "country_id" => $this->countryId,
            "country" => $this->country,
            "last_update" => $this->lastUpdate,
        ];
    }
}