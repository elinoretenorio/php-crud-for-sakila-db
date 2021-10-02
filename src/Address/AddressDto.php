<?php

declare(strict_types=1);

namespace Sakila\Address;

class AddressDto 
{
    public int $addressId;
    public string $address;
    public string $address2;
    public string $district;
    public int $cityId;
    public string $postalCode;
    public string $phone;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->addressId = (int) ($row["address_id"] ?? 0);
        $this->address = $row["address"] ?? "";
        $this->address2 = $row["address2"] ?? "";
        $this->district = $row["district"] ?? "";
        $this->cityId = (int) ($row["city_id"] ?? 0);
        $this->postalCode = $row["postal_code"] ?? "";
        $this->phone = $row["phone"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}