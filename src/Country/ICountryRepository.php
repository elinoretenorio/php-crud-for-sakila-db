<?php

declare(strict_types=1);

namespace Sakila\Country;

interface ICountryRepository
{
    public function insert(CountryDto $dto): int;

    public function update(CountryDto $dto): int;

    public function get(int $countryId): ?CountryDto;

    public function getAll(): array;

    public function delete(int $countryId): int;
}