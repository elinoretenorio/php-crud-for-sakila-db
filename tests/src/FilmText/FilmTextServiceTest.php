<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmText;

use PHPUnit\Framework\TestCase;
use Sakila\FilmText\{ FilmTextDto, FilmTextModel, IFilmTextService, FilmTextService };

class FilmTextServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private FilmTextDto $dto;
    private FilmTextModel $model;
    private IFilmTextService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\FilmText\IFilmTextRepository");
        $this->input = [
            "film_id" => 3220,
            "title" => "oil",
            "description" => "Scientist especially similar put find point up. Bad analysis ahead wind pay more bank challenge. Close director daughter crime sing share.",
        ];
        $this->dto = new FilmTextDto($this->input);
        $this->model = new FilmTextModel($this->dto);
        $this->service = new FilmTextService($this->repository);
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
        $expected = 4883;

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
        $expected = 4423;

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
        $filmId = 2335;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($filmId)
            ->willReturn(null);

        $actual = $this->service->get($filmId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $filmId = 5086;

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
        $filmId = 5209;
        $expected = 6631;

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