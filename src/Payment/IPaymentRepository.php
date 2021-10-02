<?php

declare(strict_types=1);

namespace Sakila\Payment;

interface IPaymentRepository
{
    public function insert(PaymentDto $dto): int;

    public function update(PaymentDto $dto): int;

    public function get(int $paymentId): ?PaymentDto;

    public function getAll(): array;

    public function delete(int $paymentId): int;
}