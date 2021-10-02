<?php

declare(strict_types=1);

namespace Sakila\Customer;

use JsonSerializable;

class CustomerModel implements JsonSerializable
{
    private int $customerId;
    private int $storeId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private int $addressId;
    private bool $active;
    private string $createDate;
    private string $lastUpdate;

    public function __construct(CustomerDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customerId = $dto->customerId;
        $this->storeId = $dto->storeId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->email = $dto->email;
        $this->addressId = $dto->addressId;
        $this->active = $dto->active;
        $this->createDate = $dto->createDate;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getCreateDate(): string
    {
        return $this->createDate;
    }

    public function setCreateDate(string $createDate): void
    {
        $this->createDate = $createDate;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): CustomerDto
    {
        $dto = new CustomerDto();
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->storeId = (int) ($this->storeId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->email = $this->email ?? "";
        $dto->addressId = (int) ($this->addressId ?? 0);
        $dto->active = (bool) $this->active;
        $dto->createDate = $this->createDate ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "customer_id" => $this->customerId,
            "store_id" => $this->storeId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "email" => $this->email,
            "address_id" => $this->addressId,
            "active" => $this->active,
            "create_date" => $this->createDate,
            "last_update" => $this->lastUpdate,
        ];
    }
}