<?php

declare(strict_types=1);

namespace Sakila\Tests\Payment;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Payment\{ PaymentDto, IPaymentRepository, PaymentRepository };

class PaymentRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private PaymentDto $dto;
    private IPaymentRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "payment_id" => 7529,
            "customer_id" => 8695,
            "staff_id" => 9096,
            "rental_id" => 9005,
            "amount" => 755.00,
            "payment_date" => "2021-10-03 03:47:20",
            "last_update" => "2021-09-18 03:50:02",
        ];
        $this->dto = new PaymentDto($this->input);
        $this->repository = new PaymentRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 4415;

        $sql = "INSERT INTO `payment` (`customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->staffId,
                $this->dto->rentalId,
                $this->dto->amount,
                $this->dto->paymentDate,
                $this->dto->lastUpdate
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 9722;

        $sql = "UPDATE `payment` SET `customer_id` = ?, `staff_id` = ?, `rental_id` = ?, `amount` = ?, `payment_date` = ?, `last_update` = ?
                WHERE `payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->staffId,
                $this->dto->rentalId,
                $this->dto->amount,
                $this->dto->paymentDate,
                $this->dto->lastUpdate,
                $this->dto->paymentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $paymentId = 4001;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($paymentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $paymentId = 1444;

        $sql = "SELECT `payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`
                FROM `payment` WHERE `payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$paymentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($paymentId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `payment_id`, `customer_id`, `staff_id`, `rental_id`, `amount`, `payment_date`, `last_update`
                FROM `payment`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $paymentId = 4279;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($paymentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $paymentId = 2331;
        $expected = 2131;

        $sql = "DELETE FROM `payment` WHERE `payment_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$paymentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($paymentId);
        $this->assertEquals($expected, $actual);
    }
}