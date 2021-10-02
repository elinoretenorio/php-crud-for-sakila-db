<?php

declare(strict_types=1);

namespace Sakila\Payment;

class PaymentDto 
{
    public int $paymentId;
    public int $customerId;
    public int $staffId;
    public int $rentalId;
    public float $amount;
    public string $paymentDate;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->paymentId = (int) ($row["payment_id"] ?? 0);
        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->staffId = (int) ($row["staff_id"] ?? 0);
        $this->rentalId = (int) ($row["rental_id"] ?? 0);
        $this->amount = (float) ($row["amount"] ?? 0);
        $this->paymentDate = $row["payment_date"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}