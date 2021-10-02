<?php

declare(strict_types=1);

namespace Sakila\Address;

interface IAddressRepository
{
    public function insert(AddressDto $dto): int;

    public function update(AddressDto $dto): int;

    public function get(int $addressId): ?AddressDto;

    public function getAll(): array;

    public function delete(int $addressId): int;
}