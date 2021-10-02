<?php

declare(strict_types=1);

namespace Sakila\Country;

interface ICountryService
{
    public function insert(CountryModel $model): int;

    public function update(CountryModel $model): int;

    public function get(int $countryId): ?CountryModel;

    public function getAll(): array;

    public function delete(int $countryId): int;

    public function createModel(array $row): ?CountryModel;
}