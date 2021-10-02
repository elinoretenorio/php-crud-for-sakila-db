<?php

declare(strict_types=1);

namespace Sakila\Country;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class CountryRepository implements ICountryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CountryDto $dto): int
    {
        $sql = "INSERT INTO `country` (`country`, `last_update`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->country,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CountryDto $dto): int
    {
        $sql = "UPDATE `country` SET `country` = ?, `last_update` = ?
                WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->country,
                $dto->lastUpdate,
                $dto->countryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $countryId): ?CountryDto
    {
        $sql = "SELECT `country_id`, `country`, `last_update`
                FROM `country` WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CountryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `country_id`, `country`, `last_update`
                FROM `country`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CountryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $countryId): int
    {
        $sql = "DELETE FROM `country` WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}