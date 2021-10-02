<?php

declare(strict_types=1);

namespace Sakila\Inventory;

use JsonSerializable;

class InventoryModel implements JsonSerializable
{
    private int $inventoryId;
    private int $filmId;
    private int $storeId;
    private string $lastUpdate;

    public function __construct(InventoryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->inventoryId = $dto->inventoryId;
        $this->filmId = $dto->filmId;
        $this->storeId = $dto->storeId;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getInventoryId(): int
    {
        return $this->inventoryId;
    }

    public function setInventoryId(int $inventoryId): void
    {
        $this->inventoryId = $inventoryId;
    }

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }

    public function getStoreId(): int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): void
    {
        $this->storeId = $storeId;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): InventoryDto
    {
        $dto = new InventoryDto();
        $dto->inventoryId = (int) ($this->inventoryId ?? 0);
        $dto->filmId = (int) ($this->filmId ?? 0);
        $dto->storeId = (int) ($this->storeId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "inventory_id" => $this->inventoryId,
            "film_id" => $this->filmId,
            "store_id" => $this->storeId,
            "last_update" => $this->lastUpdate,
        ];
    }
}