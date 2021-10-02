<?php

declare(strict_types=1);

namespace Sakila\Staff;

use JsonSerializable;

class StaffModel implements JsonSerializable
{
    private int $staffId;
    private string $firstName;
    private string $lastName;
    private int $addressId;
    private string $picture;
    private string $email;
    private int $storeId;
    private bool $active;
    private string $username;
    private string $password;
    private string $lastUpdate;

    public function __construct(StaffDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->staffId = $dto->staffId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->addressId = $dto->addressId;
        $this->picture = $dto->picture;
        $this->email = $dto->email;
        $this->storeId = $dto->storeId;
        $this->active = $dto->active;
        $this->username = $dto->username;
        $this->password = $dto->password;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): void
    {
        $this->staffId = $staffId;
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

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): StaffDto
    {
        $dto = new StaffDto();
        $dto->staffId = (int) ($this->staffId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->addressId = (int) ($this->addressId ?? 0);
        $dto->picture = $this->picture ?? "";
        $dto->email = $this->email ?? "";
        $dto->storeId = (int) ($this->storeId ?? 0);
        $dto->active = (bool) $this->active;
        $dto->username = $this->username ?? "";
        $dto->password = $this->password ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "staff_id" => $this->staffId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "address_id" => $this->addressId,
            "picture" => $this->picture,
            "email" => $this->email,
            "store_id" => $this->storeId,
            "active" => $this->active,
            "username" => $this->username,
            "password" => $this->password,
            "last_update" => $this->lastUpdate,
        ];
    }
}