<?php

declare(strict_types=1);

namespace Sakila\Tests\Store;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Store\{ StoreDto, IStoreRepository, StoreRepository };

class StoreRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private StoreDto $dto;
    private IStoreRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "store_id" => 4751,
            "manager_staff_id" => 2328,
            "address_id" => 4581,
            "last_update" => "2021-09-14 22:45:52",
        ];
        $this->dto = new StoreDto($this->input);
        $this->repository = new StoreRepository($this->db);
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
        $expected = 8251;

        $sql = "INSERT INTO `store` (`manager_staff_id`, `address_id`, `last_update`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->managerStaffId,
                $this->dto->addressId,
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
        $expected = 9671;

        $sql = "UPDATE `store` SET `manager_staff_id` = ?, `address_id` = ?, `last_update` = ?
                WHERE `store_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->managerStaffId,
                $this->dto->addressId,
                $this->dto->lastUpdate,
                $this->dto->storeId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $storeId = 7165;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($storeId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $storeId = 5836;

        $sql = "SELECT `store_id`, `manager_staff_id`, `address_id`, `last_update`
                FROM `store` WHERE `store_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$storeId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($storeId);
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
        $sql = "SELECT `store_id`, `manager_staff_id`, `address_id`, `last_update`
                FROM `store`";

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
        $storeId = 2137;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($storeId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $storeId = 8792;
        $expected = 6046;

        $sql = "DELETE FROM `store` WHERE `store_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$storeId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($storeId);
        $this->assertEquals($expected, $actual);
    }
}