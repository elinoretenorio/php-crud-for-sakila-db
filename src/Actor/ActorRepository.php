<?php

declare(strict_types=1);

namespace Sakila\Actor;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class ActorRepository implements IActorRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ActorDto $dto): int
    {
        $sql = "INSERT INTO `actor` (`first_name`, `last_name`, `last_update`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ActorDto $dto): int
    {
        $sql = "UPDATE `actor` SET `first_name` = ?, `last_name` = ?, `last_update` = ?
                WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->lastUpdate,
                $dto->actorId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $actorId): ?ActorDto
    {
        $sql = "SELECT `actor_id`, `first_name`, `last_name`, `last_update`
                FROM `actor` WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$actorId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ActorDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `actor_id`, `first_name`, `last_name`, `last_update`
                FROM `actor`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ActorDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $actorId): int
    {
        $sql = "DELETE FROM `actor` WHERE `actor_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$actorId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}