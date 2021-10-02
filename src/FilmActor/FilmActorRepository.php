<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class FilmActorRepository implements IFilmActorRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(FilmActorDto $dto): int
    {
        $sql = "INSERT INTO `film_actor` (`film_id`, `last_update`)
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

    public function update(FilmActorDto $dto): int
    {
        $sql = "UPDATE `film_actor` SET `film_id` = ?, `last_update` = ?
                WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->filmId,
                $dto->lastUpdate,
                $dto->actorId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $actorId): ?FilmActorDto
    {
        $sql = "SELECT `actor_id`, `film_id`, `last_update`
                FROM `film_actor` WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$actorId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new FilmActorDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `actor_id`, `film_id`, `last_update`
                FROM `film_actor`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new FilmActorDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $actorId): int
    {
        $sql = "DELETE FROM `film_actor` WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$actorId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}