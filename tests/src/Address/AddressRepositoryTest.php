<?php

declare(strict_types=1);

namespace Sakila\Tests\Address;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Address\{ AddressDto, IAddressRepository, AddressRepository };

class AddressRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private AddressDto $dto;
    private IAddressRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "address_id" => 851,
            "address" => "tell",
            "address2" => "leader",
            "district" => "street",
            "city_id" => 9532,
            "postal_code" => "article",
            "phone" => "energy",
            "last_update" => "2021-09-14 20:14:21",
        ];
        $this->dto = new AddressDto($this->input);
        $this->repository = new AddressRepository($this->db);
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
        $expected = 5563;

        $sql = "INSERT INTO `address` (`address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->address,
                $this->dto->address2,
                $this->dto->district,
                $this->dto->cityId,
                $this->dto->postalCode,
                $this->dto->phone,
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
        $expected = 6045;

        $sql = "UPDATE `address` SET `address` = ?, `address2` = ?, `district` = ?, `city_id` = ?, `postal_code` = ?, `phone` = ?, `last_update` = ?
                WHERE `address_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->address,
                $this->dto->address2,
                $this->dto->district,
                $this->dto->cityId,
                $this->dto->postalCode,
                $this->dto->phone,
                $this->dto->lastUpdate,
                $this->dto->addressId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $addressId = 9925;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($addressId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $addressId = 4130;

        $sql = "SELECT `address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`
                FROM `address` WHERE `address_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$addressId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($addressId);
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
        $sql = "SELECT `address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`
                FROM `address`";

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
        $addressId = 8138;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($addressId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $addressId = 4748;
        $expected = 8592;

        $sql = "DELETE FROM `address` WHERE `address_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$addressId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($addressId);
        $this->assertEquals($expected, $actual);
    }
}