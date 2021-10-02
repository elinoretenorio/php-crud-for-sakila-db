<?php

declare(strict_types=1);

namespace Sakila\City;

class CityDto 
{
    public int $cityId;
    public string $city;
    public int $countryId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->cityId = (int) ($row["city_id"] ?? 0);
        $this->city = $row["city"] ?? "";
        $this->countryId = (int) ($row["country_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}