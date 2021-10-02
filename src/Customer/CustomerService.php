<?php

declare(strict_types=1);

namespace Sakila\Customer;

class CustomerService implements ICustomerService
{
    private ICustomerRepository $repository;

    public function __construct(ICustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CustomerModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CustomerModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $customerId): ?CustomerModel
    {
        $dto = $this->repository->get($customerId);
        if ($dto === null) {
            return null;
        }

        return new CustomerModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CustomerDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CustomerModel($dto);
        }

        return $result;
    }

    public function delete(int $customerId): int
    {
        return $this->repository->delete($customerId);
    }

    public function createModel(array $row): ?CustomerModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CustomerDto($row);

        return new CustomerModel($dto);
    }
}