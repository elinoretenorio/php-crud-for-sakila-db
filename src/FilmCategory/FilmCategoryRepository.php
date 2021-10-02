<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class FilmCategoryRepository implements IFilmCategoryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(FilmCategoryDto $dto): int
    {
        $sql = "INSERT INTO `film_category` (`film_id`, `last_update`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->filmId,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(FilmCategoryDto $dto): int
    {
        $sql = "UPDATE `film_category` SET `film_id` = ?, `last_update` = ?
                WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->filmId,
                $dto->lastUpdate,
                $dto->categoryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $categoryId): ?FilmCategoryDto
    {
        $sql = "SELECT `category_id`, `film_id`, `last_update`
                FROM `film_category` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new FilmCategoryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `category_id`, `film_id`, `last_update`
                FROM `film_category`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new FilmCategoryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $categoryId): int
    {
        $sql = "DELETE FROM `film_category` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}