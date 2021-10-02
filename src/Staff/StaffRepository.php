<?php

declare(strict_types=1);

namespace Sakila\Staff;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class StaffRepository implements IStaffRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(StaffDto $dto): int
    {
        $sql = "INSERT INTO `staff` (`first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->addressId,
                $dto->picture,
                $dto->email,
                $dto->storeId,
                $dto->active,
                $dto->username,
                $dto->password,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(StaffDto $dto): int
    {
        $sql = "UPDATE `staff` SET `first_name` = ?, `last_name` = ?, `address_id` = ?, `picture` = ?, `email` = ?, `store_id` = ?, `active` = ?, `username` = ?, `password` = ?, `last_update` = ?
                WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->addressId,
                $dto->picture,
                $dto->email,
                $dto->storeId,
                $dto->active,
                $dto->username,
                $dto->password,
                $dto->lastUpdate,
                $dto->staffId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $staffId): ?StaffDto
    {
        $sql = "SELECT `staff_id`, `first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`
                FROM `staff` WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$staffId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new StaffDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `staff_id`, `first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`
                FROM `staff`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new StaffDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $staffId): int
    {
        $sql = "DELETE FROM `staff` WHERE `staff_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$staffId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}