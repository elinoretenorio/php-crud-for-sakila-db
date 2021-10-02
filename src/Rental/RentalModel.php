<?php

declare(strict_types=1);

namespace Sakila\Rental;

use JsonSerializable;

class RentalModel implements JsonSerializable
{
    private int $rentalId;
    private string $rentalDate;
    private int $inventoryId;
    private int $customerId;
    private string $returnDate;
    private int $staffId;
    private string $lastUpdate;

    public function __construct(RentalDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->rentalId = $dto->rentalId;
        $this->rentalDate = $dto->rentalDate;
        $this->inventoryId = $dto->inventoryId;
        $this->customerId = $dto->customerId;
        $this->returnDate = $dto->returnDate;
        $this->staffId = $dto->staffId;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getRentalId(): int
    {
        return $this->rentalId;
    }

    public function setRentalId(int $rentalId): void
    {
        $this->rentalId = $rentalId;
    }

    public function getRentalDate(): string
    {
        return $this->rentalDate;
    }

    public function setRentalDate(string $rentalDate): void
    {
        $this->rentalDate = $rentalDate;
    }

    public function getInventoryId(): int
    {
        return $this->inventoryId;
    }

    public function setInventoryId(int $inventoryId): void
    {
        $this->inventoryId = $inventoryId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getReturnDate(): string
    {
        return $this->returnDate;
    }

    public function setReturnDate(string $returnDate): void
    {
        $this->returnDate = $returnDate;
    }

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): void
    {
        $this->staffId = $staffId;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): RentalDto
    {
        $dto = new RentalDto();
        $dto->rentalId = (int) ($this->rentalId ?? 0);
        $dto->rentalDate = $this->rentalDate ?? "";
        $dto->inventoryId = (int) ($this->inventoryId ?? 0);
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->returnDate = $this->returnDate ?? "";
        $dto->staffId = (int) ($this->staffId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "rental_id" => $this->rentalId,
            "rental_date" => $this->rentalDate,
            "inventory_id" => $this->inventoryId,
            "customer_id" => $this->customerId,
            "return_date" => $this->returnDate,
            "staff_id" => $this->staffId,
            "last_update" => $this->lastUpdate,
        ];
    }
}