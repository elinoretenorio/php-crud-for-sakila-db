<?php

declare(strict_types=1);

namespace Sakila\Staff;

class StaffDto 
{
    public int $staffId;
    public string $firstName;
    public string $lastName;
    public int $addressId;
    public string $picture;
    public string $email;
    public int $storeId;
    public bool $active;
    public string $username;
    public string $password;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->staffId = (int) ($row["staff_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->addressId = (int) ($row["address_id"] ?? 0);
        $this->picture = $row["picture"] ?? "";
        $this->email = $row["email"] ?? "";
        $this->storeId = (int) ($row["store_id"] ?? 0);
        $this->active = (bool) $row["active"];
        $this->username = $row["username"] ?? "";
        $this->password = $row["password"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}