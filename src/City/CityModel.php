<?php

declare(strict_types=1);

namespace Sakila\City;

use JsonSerializable;

class CityModel implements JsonSerializable
{
    private int $cityId;
    private string $city;
    private int $countryId;
    private string $lastUpdate;

    public function __construct(CityDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->cityId = $dto->cityId;
        $this->city = $dto->city;
        $this->countryId = $dto->countryId;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): CityDto
    {
        $dto = new CityDto();
        $dto->cityId = (int) ($this->cityId ?? 0);
        $dto->city = $this->city ?? "";
        $dto->countryId = (int) ($this->countryId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "city_id" => $this->cityId,
            "city" => $this->city,
            "country_id" => $this->countryId,
            "last_update" => $this->lastUpdate,
        ];
    }
}