<?php

declare(strict_types=1);

namespace Sakila\Customer;

interface ICustomerService
{
    public function insert(CustomerModel $model): int;

    public function update(CustomerModel $model): int;

    public function get(int $customerId): ?CustomerModel;

    public function getAll(): array;

    public function delete(int $customerId): int;

    public function createModel(array $row): ?CustomerModel;
}