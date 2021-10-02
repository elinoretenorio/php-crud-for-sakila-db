<?php

declare(strict_types=1);

namespace Sakila\Payment;

use Sakila\Database\IDatabase;
use Sakila\Database\DatabaseException;

class PaymentRepository implements IPaymentRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PaymentDto $dto): int
    {
        $sql = "INSERT INTO `payment` (`customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->staffId,
                $dto->rentalId,
                $dto->amount,
                $dto->paymentDate,
                $dto->lastUpdate
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PaymentDto $dto): int
    {
        $sql = "UPDATE `payment` SET `customer_id` = ?, `staff_id` = ?, `rental_id` = ?, `amount` = ?, `payment_date` = ?, `last_update` = ?
                WHERE `payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->staffId,
                $dto->rentalId,
                $dto->amount,
                $dto->paymentDate,
                $dto->lastUpdate,
                $dto->paymentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $paymentId): ?PaymentDto
    {
        $sql = "SELECT `payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`
                FROM `payment` WHERE `payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$paymentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PaymentDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`
                FROM `payment`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PaymentDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $paymentId): int
    {
        $sql = "DELETE FROM `payment` WHERE `payment_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$paymentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}