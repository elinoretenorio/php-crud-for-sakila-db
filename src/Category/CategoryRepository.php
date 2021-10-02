<?php

declare(strict_types=1);

namespace Sakila\Category;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class CategoryRepository implements ICategoryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CategoryDto $dto): int
    {
        $sql = "INSERT INTO `category` (`name`, `last_update`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CategoryDto $dto): int
    {
        $sql = "UPDATE `category` SET `name` = ?, `last_update` = ?
                WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->name,
                $dto->lastUpdate,
                $dto->categoryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $categoryId): ?CategoryDto
    {
        $sql = "SELECT `category_id`, `name`, `last_update`
                FROM `category` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CategoryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `category_id`, `name`, `last_update`
                FROM `category`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CategoryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $categoryId): int
    {
        $sql = "DELETE FROM `category` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}