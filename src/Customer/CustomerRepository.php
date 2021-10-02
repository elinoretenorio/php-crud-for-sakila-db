<?php

declare(strict_types=1);

namespace Sakila\Customer;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class CustomerRepository implements ICustomerRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomerDto $dto): int
    {
        $sql = "INSERT INTO `customer` (`store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->storeId,
                $dto->firstName,
                $dto->lastName,
                $dto->email,
                $dto->addressId,
                $dto->active,
                $dto->createDate,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomerDto $dto): int
    {
        $sql = "UPDATE `customer` SET `store_id` = ?, `first_name` = ?, `last_name` = ?, `email` = ?, `address_id` = ?, `active` = ?, `create_date` = ?, `last_update` = ?
                WHERE `customer_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->storeId,
                $dto->firstName,
                $dto->lastName,
                $dto->email,
                $dto->addressId,
                $dto->active,
                $dto->createDate,
                $dto->lastUpdate,
                $dto->customerId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerId): ?CustomerDto
    {
        $sql = "SELECT `customer_id`, `store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`
                FROM `customer` WHERE `customer_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomerDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `customer_id`, `store_id`, `first_name`, `last_name`, `email`, `address_id`, `active`, `create_date`, `last_update`
                FROM `customer`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomerDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerId): int
    {
        $sql = "DELETE FROM `customer` WHERE `customer_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}