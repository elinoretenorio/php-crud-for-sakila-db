<?php

declare(strict_types=1);

namespace Sakila\Tests\Actor;

use PHPUnit\Framework\TestCase;
use Sakila\Database\DatabaseException;
use Sakila\Actor\{ ActorDto, IActorRepository, ActorRepository };

class ActorRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ActorDto $dto;
    private IActorRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Sakila\Database\IDatabase");
        $this->result = $this->createMock("Sakila\Database\IDatabaseResult");
        $this->input = [
            "actor_id" => 5306,
            "first_name" => "yeah",
            "last_name" => "center",
            "last_update" => "2021-09-26 09:56:09",
        ];
        $this->dto = new ActorDto($this->input);
        $this->repository = new ActorRepository($this->db);
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
        $expected = 7525;

        $sql = "INSERT INTO `actor` (`first_name`, `last_name`, `last_update`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
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
        $expected = 5033;

        $sql = "UPDATE `actor` SET `first_name` = ?, `last_name` = ?, `last_update` = ?
                WHERE `actor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->lastUpdate,
                $this->dto->actorId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $actorId = 7865;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($actorId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $actorId = 1737;

        $sql = "SELECT `actor_id`, `first_name`, `last_name`, `last_update`
                FROM `actor` WHERE `actor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$actorId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($actorId);
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
        $sql = "SELECT `actor_id`, `first_name`, `last_name`, `last_update`
                FROM `actor`";

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
        $actorId = 7124;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($actorId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $actorId = 2605;
        $expected = 6773;

        $sql = "DELETE FROM `actor` WHERE `actor_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$actorId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($actorId);
        $this->assertEquals($expected, $actual);
    }
}