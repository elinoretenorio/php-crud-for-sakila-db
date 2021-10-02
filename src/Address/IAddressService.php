<?php

declare(strict_types=1);

namespace Sakila\Address;

interface IAddressService
{
    public function insert(AddressModel $model): int;

    public function update(AddressModel $model): int;

    public function get(int $addressId): ?AddressModel;

    public function getAll(): array;

    public function delete(int $addressId): int;

    public function createModel(array $row): ?AddressModel;
}