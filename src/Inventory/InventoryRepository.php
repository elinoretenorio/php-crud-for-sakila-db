<?php

declare(strict_types=1);

namespace Sakila\Inventory;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class InventoryRepository implements IInventoryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(InventoryDto $dto): int
    {
        $sql = "INSERT INTO `inventory` (`film_id`, `store_id`, `last_update`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->filmId,
                $dto->storeId,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(InventoryDto $dto): int
    {
        $sql = "UPDATE `inventory` SET `film_id` = ?, `store_id` = ?, `last_update` = ?
                WHERE `inventory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->filmId,
                $dto->storeId,
                $dto->lastUpdate,
                $dto->inventoryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $inventoryId): ?InventoryDto
    {
        $sql = "SELECT `inventory_id`, `film_id`, `store_id`, `last_update`
                FROM `inventory` WHERE `inventory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$inventoryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new InventoryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `inventory_id`, `film_id`, `store_id`, `last_update`
                FROM `inventory`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new InventoryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $inventoryId): int
    {
        $sql = "DELETE FROM `inventory` WHERE `inventory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$inventoryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}