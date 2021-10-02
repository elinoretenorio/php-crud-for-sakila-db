<?php

declare(strict_types=1);

namespace Sakila\Inventory;

class InventoryDto 
{
    public int $inventoryId;
    public int $filmId;
    public int $storeId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->inventoryId = (int) ($row["inventory_id"] ?? 0);
        $this->filmId = (int) ($row["film_id"] ?? 0);
        $this->storeId = (int) ($row["store_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}