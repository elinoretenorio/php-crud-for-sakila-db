<?php

declare(strict_types=1);

namespace Sakila\Inventory;

class InventoryService implements IInventoryService
{
    private IInventoryRepository $repository;

    public function __construct(IInventoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(InventoryModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(InventoryModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $inventoryId): ?InventoryModel
    {
        $dto = $this->repository->get($inventoryId);
        if ($dto === null) {
            return null;
        }

        return new InventoryModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var InventoryDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new InventoryModel($dto);
        }

        return $result;
    }

    public function delete(int $inventoryId): int
    {
        return $this->repository->delete($inventoryId);
    }

    public function createModel(array $row): ?InventoryModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new InventoryDto($row);

        return new InventoryModel($dto);
    }
}