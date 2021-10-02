<?php

declare(strict_types=1);

namespace Sakila\Customer;

class CustomerDto 
{
    public int $customerId;
    public int $storeId;
    public string $firstName;
    public string $lastName;
    public string $email;
    public int $addressId;
    public bool $active;
    public string $createDate;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->storeId = (int) ($row["store_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->email = $row["email"] ?? "";
        $this->addressId = (int) ($row["address_id"] ?? 0);
        $this->active = (bool) $row["active"];
        $this->createDate = $row["create_date"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}