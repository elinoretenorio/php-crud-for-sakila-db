<?php

declare(strict_types=1);

namespace Sakila\Store;

class StoreDto 
{
    public int $storeId;
    public int $managerStaffId;
    public int $addressId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->storeId = (int) ($row["store_id"] ?? 0);
        $this->managerStaffId = (int) ($row["manager_staff_id"] ?? 0);
        $this->addressId = (int) ($row["address_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}