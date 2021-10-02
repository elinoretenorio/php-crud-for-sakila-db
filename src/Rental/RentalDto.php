<?php

declare(strict_types=1);

namespace Sakila\Rental;

class RentalDto 
{
    public int $rentalId;
    public string $rentalDate;
    public int $inventoryId;
    public int $customerId;
    public string $returnDate;
    public int $staffId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->rentalId = (int) ($row["rental_id"] ?? 0);
        $this->rentalDate = $row["rental_date"] ?? "";
        $this->inventoryId = (int) ($row["inventory_id"] ?? 0);
        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->returnDate = $row["return_date"] ?? "";
        $this->staffId = (int) ($row["staff_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}