<?php

declare(strict_types=1);

namespace Sakila\Payment;

class PaymentService implements IPaymentService
{
    private IPaymentRepository $repository;

    public function __construct(IPaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PaymentModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PaymentModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $paymentId): ?PaymentModel
    {
        $dto = $this->repository->get($paymentId);
        if ($dto === null) {
            return null;
        }

        return new PaymentModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PaymentDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PaymentModel($dto);
        }

        return $result;
    }

    public function delete(int $paymentId): int
    {
        return $this->repository->delete($paymentId);
    }

    public function createModel(array $row): ?PaymentModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PaymentDto($row);

        return new PaymentModel($dto);
    }
}