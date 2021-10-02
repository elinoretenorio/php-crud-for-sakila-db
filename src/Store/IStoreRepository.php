<?php

declare(strict_types=1);

namespace Sakila\Store;

interface IStoreRepository
{
    public function insert(StoreDto $dto): int;

    public function update(StoreDto $dto): int;

    public function get(int $storeId): ?StoreDto;

    public function getAll(): array;

    public function delete(int $storeId): int;
}