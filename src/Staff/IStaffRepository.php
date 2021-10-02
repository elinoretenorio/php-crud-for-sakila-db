<?php

declare(strict_types=1);

namespace Sakila\Staff;

interface IStaffRepository
{
    public function insert(StaffDto $dto): int;

    public function update(StaffDto $dto): int;

    public function get(int $staffId): ?StaffDto;

    public function getAll(): array;

    public function delete(int $staffId): int;
}