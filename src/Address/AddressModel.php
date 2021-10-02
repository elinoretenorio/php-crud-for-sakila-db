<?php

declare(strict_types=1);

namespace Sakila\Address;

use JsonSerializable;

class AddressModel implements JsonSerializable
{
    private int $addressId;
    private string $address;
    private string $address2;
    private string $district;
    private int $cityId;
    private string $postalCode;
    private string $phone;
    private string $lastUpdate;

    public function __construct(AddressDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->addressId = $dto->addressId;
        $this->address = $dto->address;
        $this->address2 = $dto->address2;
        $this->district = $dto->district;
        $this->cityId = $dto->cityId;
        $this->postalCode = $dto->postalCode;
        $this->phone = $dto->phone;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAddress2(): string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function setDistrict(string $district): void
    {
        $this->district = $district;
    }

    public function getCityId(): int
    {
        return $this->cityId;
    }

    public function setCityId(int $cityId): void
    {
        $this->cityId = $cityId;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): AddressDto
    {
        $dto = new AddressDto();
        $dto->addressId = (int) ($this->addressId ?? 0);
        $dto->address = $this->address ?? "";
        $dto->address2 = $this->address2 ?? "";
        $dto->district = $this->district ?? "";
        $dto->cityId = (int) ($this->cityId ?? 0);
        $dto->postalCode = $this->postalCode ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "address_id" => $this->addressId,
            "address" => $this->address,
            "address2" => $this->address2,
            "district" => $this->district,
            "city_id" => $this->cityId,
            "postal_code" => $this->postalCode,
            "phone" => $this->phone,
            "last_update" => $this->lastUpdate,
        ];
    }
}