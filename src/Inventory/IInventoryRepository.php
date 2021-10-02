<?php

declare(strict_types=1);

namespace Sakila\Inventory;

interface IInventoryRepository
{
    public function insert(InventoryDto $dto): int;

    public function update(InventoryDto $dto): int;

    public function get(int $inventoryId): ?InventoryDto;

    public function getAll(): array;

    public function delete(int $inventoryId): int;
}