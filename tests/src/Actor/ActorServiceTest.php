<?php

declare(strict_types=1);

namespace Sakila\Tests\Actor;

use PHPUnit\Framework\TestCase;
use Sakila\Actor\{ ActorDto, ActorModel, IActorService, ActorService };

class ActorServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ActorDto $dto;
    private ActorModel $model;
    private IActorService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Actor\IActorRepository");
        $this->input = [
            "actor_id" => 3155,
            "first_name" => "there",
            "last_name" => "everything",
            "last_update" => "2021-09-15 22:56:22",
        ];
        $this->dto = new ActorDto($this->input);
        $this->model = new ActorModel($this->dto);
        $this->service = new ActorService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 5239;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 4370;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $actorId = 8185;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($actorId)
            ->willReturn(null);

        $actual = $this->service->get($actorId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $actorId = 8339;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($actorId)
            ->willReturn($this->dto);

        $actual = $this->service->get($actorId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $actorId = 5543;
        $expected = 2413;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($actorId)
            ->willReturn($expected);

        $actual = $this->service->delete($actorId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}