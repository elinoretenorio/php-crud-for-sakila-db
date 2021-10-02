<?php

declare(strict_types=1);

namespace Sakila\Rental;

class RentalService implements IRentalService
{
    private IRentalRepository $repository;

    public function __construct(IRentalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(RentalModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(RentalModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $rentalId): ?RentalModel
    {
        $dto = $this->repository->get($rentalId);
        if ($dto === null) {
            return null;
        }

        return new RentalModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var RentalDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new RentalModel($dto);
        }

        return $result;
    }

    public function delete(int $rentalId): int
    {
        return $this->repository->delete($rentalId);
    }

    public function createModel(array $row): ?RentalModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new RentalDto($row);

        return new RentalModel($dto);
    }
}