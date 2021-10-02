<?php

declare(strict_types=1);

namespace Sakila\City;

class CityService implements ICityService
{
    private ICityRepository $repository;

    public function __construct(ICityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CityModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CityModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $cityId): ?CityModel
    {
        $dto = $this->repository->get($cityId);
        if ($dto === null) {
            return null;
        }

        return new CityModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CityDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CityModel($dto);
        }

        return $result;
    }

    public function delete(int $cityId): int
    {
        return $this->repository->delete($cityId);
    }

    public function createModel(array $row): ?CityModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CityDto($row);

        return new CityModel($dto);
    }
}