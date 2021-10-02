<?php

declare(strict_types=1);

namespace Sakila\Payment;

use JsonSerializable;

class PaymentModel implements JsonSerializable
{
    private int $paymentId;
    private int $customerId;
    private int $staffId;
    private int $rentalId;
    private float $amount;
    private string $paymentDate;
    private string $lastUpdate;

    public function __construct(PaymentDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->paymentId = $dto->paymentId;
        $this->customerId = $dto->customerId;
        $this->staffId = $dto->staffId;
        $this->rentalId = $dto->rentalId;
        $this->amount = $dto->amount;
        $this->paymentDate = $dto->paymentDate;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getPaymentId(): int
    {
        return $this->paymentId;
    }

    public function setPaymentId(int $paymentId): void
    {
        $this->paymentId = $paymentId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getStaffId(): int
    {
        return $this->staffId;
    }

    public function setStaffId(int $staffId): void
    {
        $this->staffId = $staffId;
    }

    public function getRentalId(): int
    {
        return $this->rentalId;
    }

    public function setRentalId(int $rentalId): void
    {
        $this->rentalId = $rentalId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getPaymentDate(): string
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(string $paymentDate): void
    {
        $this->paymentDate = $paymentDate;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): PaymentDto
    {
        $dto = new PaymentDto();
        $dto->paymentId = (int) ($this->paymentId ?? 0);
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->staffId = (int) ($this->staffId ?? 0);
        $dto->rentalId = (int) ($this->rentalId ?? 0);
        $dto->amount = (float) ($this->amount ?? 0);
        $dto->paymentDate = $this->paymentDate ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "payment_id" => $this->paymentId,
            "customer_id" => $this->customerId,
            "staff_id" => $this->staffId,
            "rental_id" => $this->rentalId,
            "amount" => $this->amount,
            "payment_date" => $this->paymentDate,
            "last_update" => $this->lastUpdate,
        ];
    }
}