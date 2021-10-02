<?php

declare(strict_types=1);

namespace Sakila\Store;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class StoreRepository implements IStoreRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(StoreDto $dto): int
    {
        $sql = "INSERT INTO `store` (`manager_staff_id`, `address_id`, `last_update`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->managerStaffId,
                $dto->addressId,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(StoreDto $dto): int
    {
        $sql = "UPDATE `store` SET `manager_staff_id` = ?, `address_id` = ?, `last_update` = ?
                WHERE `store_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->managerStaffId,
                $dto->addressId,
                $dto->lastUpdate,
                $dto->storeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $storeId): ?StoreDto
    {
        $sql = "SELECT `store_id`, `manager_staff_id`, `address_id`, `last_update`
                FROM `store` WHERE `store_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$storeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new StoreDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `store_id`, `manager_staff_id`, `address_id`, `last_update`
                FROM `store`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new StoreDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $storeId): int
    {
        $sql = "DELETE FROM `store` WHERE `store_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$storeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}