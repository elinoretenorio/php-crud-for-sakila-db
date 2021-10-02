<?php

declare(strict_types=1);

namespace Sakila\Payment;

interface IPaymentService
{
    public function insert(PaymentModel $model): int;

    public function update(PaymentModel $model): int;

    public function get(int $paymentId): ?PaymentModel;

    public function getAll(): array;

    public function delete(int $paymentId): int;

    public function createModel(array $row): ?PaymentModel;
}