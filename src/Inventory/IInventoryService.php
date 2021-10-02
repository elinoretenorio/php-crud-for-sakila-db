<?php

declare(strict_types=1);

namespace Sakila\Inventory;

interface IInventoryService
{
    public function insert(InventoryModel $model): int;

    public function update(InventoryModel $model): int;

    public function get(int $inventoryId): ?InventoryModel;

    public function getAll(): array;

    public function delete(int $inventoryId): int;

    public function createModel(array $row): ?InventoryModel;
}