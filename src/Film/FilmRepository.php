<?php

declare(strict_types=1);

namespace Sakila\Film;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class FilmRepository implements IFilmRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(FilmDto $dto): int
    {
        $sql = "INSERT INTO `film` (`title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->description,
                $dto->releaseYear,
                $dto->languageId,
                $dto->originalLanguageId,
                $dto->rentalDuration,
                $dto->rentalRate,
                $dto->length,
                $dto->replacementCost,
                $dto->rating,
                $dto->specialFeatures,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(FilmDto $dto): int
    {
        $sql = "UPDATE `film` SET `title` = ?, `description` = ?, `release_year` = ?, `language_id` = ?, `original_language_id` = ?, `rental_duration` = ?, `rental_rate` = ?, `length` = ?, `replacement_cost` = ?, `rating` = ?, `special_features` = ?, `last_update` = ?
                WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->description,
                $dto->releaseYear,
                $dto->languageId,
                $dto->originalLanguageId,
                $dto->rentalDuration,
                $dto->rentalRate,
                $dto->length,
                $dto->replacementCost,
                $dto->rating,
                $dto->specialFeatures,
                $dto->lastUpdate,
                $dto->filmId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $filmId): ?FilmDto
    {
        $sql = "SELECT `film_id`, `title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`
                FROM `film` WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$filmId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new FilmDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `film_id`, `title`, `description`, `release_year`, `language_id`, `original_language_id`, `rental_duration`, `rental_rate`, `length`, `replacement_cost`, `rating`, `special_features`, `last_update`
                FROM `film`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new FilmDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $filmId): int
    {
        $sql = "DELETE FROM `film` WHERE `film_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$filmId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}