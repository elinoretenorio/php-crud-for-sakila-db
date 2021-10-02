<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmActor;

use PHPUnit\Framework\TestCase;
use Sakila\FilmActor\{ FilmActorDto, FilmActorModel, IFilmActorService, FilmActorService };

class FilmActorServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private FilmActorDto $dto;
    private FilmActorModel $model;
    private IFilmActorService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\FilmActor\IFilmActorRepository");
        $this->input = [
            "actor_id" => 4014,
            "film_id" => 3314,
            "last_update" => "2021-10-05 06:41:01",
        ];
        $this->dto = new FilmActorDto($this->input);
        $this->model = new FilmActorModel($this->dto);
        $this->service = new FilmActorService($this->repository);
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
        $expected = 9483;

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
        $expected = 7738;

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
        $actorId = 3759;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($actorId)
            ->willReturn(null);

        $actual = $this->service->get($actorId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $actorId = 4416;

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
        $actorId = 3349;
        $expected = 759;

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