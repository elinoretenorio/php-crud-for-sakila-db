<?php

declare(strict_types=1);

namespace Sakila\Staff;

interface IStaffService
{
    public function insert(StaffModel $model): int;

    public function update(StaffModel $model): int;

    public function get(int $staffId): ?StaffModel;

    public function getAll(): array;

    public function delete(int $staffId): int;

    public function createModel(array $row): ?StaffModel;
}