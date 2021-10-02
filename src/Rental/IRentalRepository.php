<?php

declare(strict_types=1);

namespace Sakila\Rental;

interface IRentalRepository
{
    public function insert(RentalDto $dto): int;

    public function update(RentalDto $dto): int;

    public function get(int $rentalId): ?RentalDto;

    public function getAll(): array;

    public function delete(int $rentalId): int;
}