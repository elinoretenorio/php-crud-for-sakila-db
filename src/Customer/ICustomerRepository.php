<?php

declare(strict_types=1);

namespace Sakila\Customer;

interface ICustomerRepository
{
    public function insert(CustomerDto $dto): int;

    public function update(CustomerDto $dto): int;

    public function get(int $customerId): ?CustomerDto;

    public function getAll(): array;

    public function delete(int $customerId): int;
}