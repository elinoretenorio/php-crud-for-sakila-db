<?php

declare(strict_types=1);

namespace Sakila\Store;

interface IStoreService
{
    public function insert(StoreModel $model): int;

    public function update(StoreModel $model): int;

    public function get(int $storeId): ?StoreModel;

    public function getAll(): array;

    public function delete(int $storeId): int;

    public function createModel(array $row): ?StoreModel;
}