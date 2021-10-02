<?php

declare(strict_types=1);

namespace Sakila\City;

interface ICityRepository
{
    public function insert(CityDto $dto): int;

    public function update(CityDto $dto): int;

    public function get(int $cityId): ?CityDto;

    public function getAll(): array;

    public function delete(int $cityId): int;
}