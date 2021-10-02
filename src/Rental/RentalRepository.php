<?php

declare(strict_types=1);

namespace Sakila\Rental;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class RentalRepository implements IRentalRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(RentalDto $dto): int
    {
        $sql = "INSERT INTO `rental` (`rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->rentalDate,
                $dto->inventoryId,
                $dto->customerId,
                $dto->returnDate,
                $dto->staffId,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(RentalDto $dto): int
    {
        $sql = "UPDATE `rental` SET `rental_date` = ?, `inventory_id` = ?, `customer_id` = ?, `return_date` = ?, `staff_id` = ?, `last_update` = ?
                WHERE `rental_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->rentalDate,
                $dto->inventoryId,
                $dto->customerId,
                $dto->returnDate,
                $dto->staffId,
                $dto->lastUpdate,
                $dto->rentalId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $rentalId): ?RentalDto
    {
        $sql = "SELECT `rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`
                FROM `rental` WHERE `rental_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$rentalId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new RentalDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`
                FROM `rental`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new RentalDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $rentalId): int
    {
        $sql = "DELETE FROM `rental` WHERE `rental_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$rentalId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}