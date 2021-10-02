<?php

declare(strict_types=1);

namespace Sakila\Tests\Staff;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Staff\{ StaffDto, IStaffRepository, StaffRepository };

class StaffRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private StaffDto $dto;
    private IStaffRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "staff_id" => 270,
            "first_name" => "sing",
            "last_name" => "surface",
            "address_id" => 1512,
            "picture" => "Point hand maybe our.",
            "email" => "qboyle@example.net",
            "store_id" => 8036,
            "active" => True,
            "username" => "test",
            "password" => "white",
            "last_update" => "2021-10-01 07:54:36",
        ];
        $this->dto = new StaffDto($this->input);
        $this->repository = new StaffRepository($this->db);
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
        $expected = 2568;

        $sql = "INSERT INTO `staff` (`first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->addressId,
                $this->dto->picture,
                $this->dto->email,
                $this->dto->storeId,
                $this->dto->active,
                $this->dto->username,
                $this->dto->password,
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
        $expected = 4816;

        $sql = "UPDATE `staff` SET `first_name` = ?, `last_name` = ?, `address_id` = ?, `picture` = ?, `email` = ?, `store_id` = ?, `active` = ?, `username` = ?, `password` = ?, `last_update` = ?
                WHERE `staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->addressId,
                $this->dto->picture,
                $this->dto->email,
                $this->dto->storeId,
                $this->dto->active,
                $this->dto->username,
                $this->dto->password,
                $this->dto->lastUpdate,
                $this->dto->staffId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $staffId = 6661;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($staffId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $staffId = 1112;

        $sql = "SELECT `staff_id`, `first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`
                FROM `staff` WHERE `staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$staffId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($staffId);
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
        $sql = "SELECT `staff_id`, `first_name`, `last_name`, `address_id`, `picture`, `email`, `store_id`, `active`, `username`, `password`, `last_update`
                FROM `staff`";

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
        $staffId = 2432;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($staffId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $staffId = 9031;
        $expected = 2662;

        $sql = "DELETE FROM `staff` WHERE `staff_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$staffId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($staffId);
        $this->assertEquals($expected, $actual);
    }
}