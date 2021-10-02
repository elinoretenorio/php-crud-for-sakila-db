<?php

declare(strict_types=1);

namespace Sakila\Address;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class AddressRepository implements IAddressRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(AddressDto $dto): int
    {
        $sql = "INSERT INTO `address` (`address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->address,
                $dto->address2,
                $dto->district,
                $dto->cityId,
                $dto->postalCode,
                $dto->phone,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(AddressDto $dto): int
    {
        $sql = "UPDATE `address` SET `address` = ?, `address2` = ?, `district` = ?, `city_id` = ?, `postal_code` = ?, `phone` = ?, `last_update` = ?
                WHERE `address_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->address,
                $dto->address2,
                $dto->district,
                $dto->cityId,
                $dto->postalCode,
                $dto->phone,
                $dto->lastUpdate,
                $dto->addressId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $addressId): ?AddressDto
    {
        $sql = "SELECT `address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`
                FROM `address` WHERE `address_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$addressId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new AddressDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`
                FROM `address`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new AddressDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $addressId): int
    {
        $sql = "DELETE FROM `address` WHERE `address_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$addressId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}