<?php

declare(strict_types=1);

namespace Sakila\City;

interface ICityService
{
    public function insert(CityModel $model): int;

    public function update(CityModel $model): int;

    public function get(int $cityId): ?CityModel;

    public function getAll(): array;

    public function delete(int $cityId): int;

    public function createModel(array $row): ?CityModel;
}