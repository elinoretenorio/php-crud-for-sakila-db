<?php

declare(strict_types=1);

namespace Sakila\Country;

class CountryDto 
{
    public int $countryId;
    public string $country;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->countryId = (int) ($row["country_id"] ?? 0);
        $this->country = $row["country"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}