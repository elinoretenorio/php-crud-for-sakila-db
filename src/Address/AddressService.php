<?php

declare(strict_types=1);

namespace Sakila\Address;

class AddressService implements IAddressService
{
    private IAddressRepository $repository;

    public function __construct(IAddressRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(AddressModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(AddressModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $addressId): ?AddressModel
    {
        $dto = $this->repository->get($addressId);
        if ($dto === null) {
            return null;
        }

        return new AddressModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var AddressDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new AddressModel($dto);
        }

        return $result;
    }

    public function delete(int $addressId): int
    {
        return $this->repository->delete($addressId);
    }

    public function createModel(array $row): ?AddressModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new AddressDto($row);

        return new AddressModel($dto);
    }
}