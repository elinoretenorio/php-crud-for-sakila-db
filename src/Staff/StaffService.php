<?php

declare(strict_types=1);

namespace Sakila\Staff;

class StaffService implements IStaffService
{
    private IStaffRepository $repository;

    public function __construct(IStaffRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(StaffModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(StaffModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $staffId): ?StaffModel
    {
        $dto = $this->repository->get($staffId);
        if ($dto === null) {
            return null;
        }

        return new StaffModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var StaffDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new StaffModel($dto);
        }

        return $result;
    }

    public function delete(int $staffId): int
    {
        return $this->repository->delete($staffId);
    }

    public function createModel(array $row): ?StaffModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new StaffDto($row);

        return new StaffModel($dto);
    }
}