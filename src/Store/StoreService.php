<?php

declare(strict_types=1);

namespace Sakila\Store;

class StoreService implements IStoreService
{
    private IStoreRepository $repository;

    public function __construct(IStoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(StoreModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(StoreModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $storeId): ?StoreModel
    {
        $dto = $this->repository->get($storeId);
        if ($dto === null) {
            return null;
        }

        return new StoreModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var StoreDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new StoreModel($dto);
        }

        return $result;
    }

    public function delete(int $storeId): int
    {
        return $this->repository->delete($storeId);
    }

    public function createModel(array $row): ?StoreModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new StoreDto($row);

        return new StoreModel($dto);
    }
}