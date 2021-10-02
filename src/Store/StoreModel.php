<?php

declare(strict_types=1);

namespace Sakila\Store;

use JsonSerializable;

class StoreModel implements JsonSerializable
{
    private int $storeId;
    private int $managerStaffId;
    private int $addressId;
    private string $lastUpdate;

    public function __construct(StoreDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->storeId = $dto->storeId;
        $this->managerStaffId = $dto->managerStaffId;
        $this->addressId = $dto->addressId;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    public function getManagerStaffId(): int
    {
        return $this->managerStaffId;
    }

    public function setManagerStaffId(int $managerStaffId): void
    {
        $this->managerStaffId = $managerStaffId;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): StoreDto
    {
        $dto = new StoreDto();
        $dto->storeId = (int) ($this->storeId ?? 0);
        $dto->managerStaffId = (int) ($this->managerStaffId ?? 0);
        $dto->addressId = (int) ($this->addressId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "store_id" => $this->storeId,
            "manager_staff_id" => $this->managerStaffId,
            "address_id" => $this->addressId,
            "last_update" => $this->lastUpdate,
        ];
    }
}