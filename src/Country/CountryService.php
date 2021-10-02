<?php

declare(strict_types=1);

namespace Sakila\Country;

class CountryService implements ICountryService
{
    private ICountryRepository $repository;

    public function __construct(ICountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CountryModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CountryModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $countryId): ?CountryModel
    {
        $dto = $this->repository->get($countryId);
        if ($dto === null) {
            return null;
        }

        return new CountryModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CountryDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CountryModel($dto);
        }

        return $result;
    }

    public function delete(int $countryId): int
    {
        return $this->repository->delete($countryId);
    }

    public function createModel(array $row): ?CountryModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CountryDto($row);

        return new CountryModel($dto);
    }
}