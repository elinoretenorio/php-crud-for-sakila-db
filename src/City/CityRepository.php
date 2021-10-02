<?php

declare(strict_types=1);

namespace Sakila\City;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class CityRepository implements ICityRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CityDto $dto): int
    {
        $sql = "INSERT INTO `city` (`city`, `country_id`, `last_update`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->city,
                $dto->countryId,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CityDto $dto): int
    {
        $sql = "UPDATE `city` SET `city` = ?, `country_id` = ?, `last_update` = ?
                WHERE `city_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->city,
                $dto->countryId,
                $dto->lastUpdate,
                $dto->cityId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $cityId): ?CityDto
    {
        $sql = "SELECT `city_id`, `city`, `country_id`, `last_update`
                FROM `city` WHERE `city_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cityId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CityDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `city_id`, `city`, `country_id`, `last_update`
                FROM `city`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CityDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $cityId): int
    {
        $sql = "DELETE FROM `city` WHERE `city_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$cityId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}