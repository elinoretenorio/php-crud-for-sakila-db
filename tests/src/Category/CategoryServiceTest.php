<?php

declare(strict_types=1);

namespace Sakila\Tests\Category;

use PHPUnit\Framework\TestCase;
use Sakila\Category\{ CategoryDto, CategoryModel, ICategoryService, CategoryService };

class CategoryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CategoryDto $dto;
    private CategoryModel $model;
    private ICategoryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Category\ICategoryRepository");
        $this->input = [
            "category_id" => 3126,
            "name" => "now",
            "last_update" => "2021-09-20 18:08:53",
        ];
        $this->dto = new CategoryDto($this->input);
        $this->model = new CategoryModel($this->dto);
        $this->service = new CategoryService($this->repository);
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
        $expected = 1143;

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
        $expected = 6371;

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
        $categoryId = 8043;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($categoryId)
            ->willReturn(null);

        $actual = $this->service->get($categoryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $categoryId = 6746;

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
        $categoryId = 1143;
        $expected = 958;

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