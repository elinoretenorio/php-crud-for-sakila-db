<?php

declare(strict_types=1);

namespace Sakila\Rental;

interface IRentalService
{
    public function insert(RentalModel $model): int;

    public function update(RentalModel $model): int;

    public function get(int $rentalId): ?RentalModel;

    public function getAll(): array;

    public function delete(int $rentalId): int;

    public function createModel(array $row): ?RentalModel;
}