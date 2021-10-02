<?php

declare(strict_types=1);

namespace Sakila\FilmText;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class FilmTextRepository implements IFilmTextRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(FilmTextDto $dto): int
    {
        $sql = "INSERT INTO `film_text` (`title`, `description`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->description
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(FilmTextDto $dto): int
    {
        $sql = "UPDATE `film_text` SET `title` = ?, `description` = ?
                WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->description,
                $dto->filmId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $filmId): ?FilmTextDto
    {
        $sql = "SELECT `film_id`, `title`, `description`
                FROM `film_text` WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$filmId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new FilmTextDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `film_id`, `title`, `description`
                FROM `film_text`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new FilmTextDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $filmId): int
    {
        $sql = "DELETE FROM `film_text` WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$filmId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}