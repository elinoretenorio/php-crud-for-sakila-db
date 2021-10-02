<?php

declare(strict_types=1);

namespace Sakila\Tests\Rental;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Rental\{ RentalDto, IRentalRepository, RentalRepository };

class RentalRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private RentalDto $dto;
    private IRentalRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "rental_id" => 730,
            "rental_date" => "2021-10-01 15:54:43",
            "inventory_id" => 9980,
            "customer_id" => 5855,
            "return_date" => "2021-09-28 13:13:19",
            "staff_id" => 5316,
            "last_update" => "2021-10-13 03:22:21",
        ];
        $this->dto = new RentalDto($this->input);
        $this->repository = new RentalRepository($this->db);
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
        $expected = 2660;

        $sql = "INSERT INTO `rental` (`rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->rentalDate,
                $this->dto->inventoryId,
                $this->dto->customerId,
                $this->dto->returnDate,
                $this->dto->staffId,
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
        $expected = 2197;

        $sql = "UPDATE `rental` SET `rental_date` = ?, `inventory_id` = ?, `customer_id` = ?, `return_date` = ?, `staff_id` = ?, `last_update` = ?
                WHERE `rental_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->rentalDate,
                $this->dto->inventoryId,
                $this->dto->customerId,
                $this->dto->returnDate,
                $this->dto->staffId,
                $this->dto->lastUpdate,
                $this->dto->rentalId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $rentalId = 1452;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($rentalId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $rentalId = 915;

        $sql = "SELECT `rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`
                FROM `rental` WHERE `rental_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$rentalId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($rentalId);
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
        $sql = "SELECT `rental_id`, `rental_date`, `inventory_id`, `customer_id`, `return_date`, `staff_id`, `last_update`
                FROM `rental`";

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
        $rentalId = 8949;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($rentalId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $rentalId = 1158;
        $expected = 1672;

        $sql = "DELETE FROM `rental` WHERE `rental_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$rentalId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($rentalId);
        $this->assertEquals($expected, $actual);
    }
}