<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmCategory;

use PHPUnit\Framework\TestCase;
use Sakila\FilmCategory\{ FilmCategoryDto, FilmCategoryModel, IFilmCategoryService, FilmCategoryService };

class FilmCategoryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private FilmCategoryDto $dto;
    private FilmCategoryModel $model;
    private IFilmCategoryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\FilmCategory\IFilmCategoryRepository");
        $this->input = [
            "category_id" => 6934,
            "film_id" => 7424,
            "last_update" => "2021-10-08 10:44:15",
        ];
        $this->dto = new FilmCategoryDto($this->input);
        $this->model = new FilmCategoryModel($this->dto);
        $this->service = new FilmCategoryService($this->repository);
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
        $expected = 1687;

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
        $expected = 3336;

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
        $categoryId = 9351;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($categoryId)
            ->willReturn(null);

        $actual = $this->service->get($categoryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $categoryId = 6975;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($categoryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($categoryId);
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
        $categoryId = 2269;
        $expected = 8251;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($categoryId)
            ->willReturn($expected);

        $actual = $this->service->delete($categoryId);
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