<?php

declare(strict_types=1);

namespace Sakila\Tests\Film;

use PHPUnit\Framework\TestCase;
use Sakila\Film\{ FilmDto, FilmModel, IFilmService, FilmService };

class FilmServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private FilmDto $dto;
    private FilmModel $model;
    private IFilmService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Film\IFilmRepository");
        $this->input = [
            "film_id" => 5009,
            "title" => "question",
            "description" => "Expect inside Mrs. Personal suffer relationship in effort read.",
            "release_year" => "Up south lay gun oil.",
            "language_id" => 2766,
            "original_language_id" => 6465,
            "rental_duration" => 1489,
            "rental_rate" => 139.10,
            "length" => 4476,
            "replacement_cost" => 78.00,
            "rating" => "Medical illustrator",
            "special_features" => "Production manager",
            "last_update" => "2021-09-26 01:48:46",
        ];
        $this->dto = new FilmDto($this->input);
        $this->model = new FilmModel($this->dto);
        $this->service = new FilmService($this->repository);
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
        $expected = 1158;

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
        $expected = 4553;

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
        $filmId = 3760;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($filmId)
            ->willReturn(null);

        $actual = $this->service->get($filmId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $filmId = 4849;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($filmId)
            ->willReturn($this->dto);

        $actual = $this->service->get($filmId);
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
        $filmId = 5119;
        $expected = 8952;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($filmId)
            ->willReturn($expected);

        $actual = $this->service->delete($filmId);
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