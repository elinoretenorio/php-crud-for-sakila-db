<?php

declare(strict_types=1);

namespace Sakila\Tests\Category;

use PHPUnit\Framework\TestCase;
use Sakila\Category\{ CategoryDto, CategoryModel };

class CategoryModelTest extends TestCase
{
    private array $input;
    private CategoryDto $dto;
    private CategoryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "category_id" => 1642,
            "name" => "work",
            "last_update" => "2021-10-10 18:08:14",
        ];
        $this->dto = new CategoryDto($this->input);
        $this->model = new CategoryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CategoryModel(null);

        $this->assertInstanceOf(CategoryModel::class, $model);
    }

    public function testGetCategoryId(): void
    {
        $this->assertEquals($this->dto->categoryId, $this->model->getCategoryId());
    }

    public function testSetCategoryId(): void
    {
        $expected = 9341;
        $model = $this->model;
        $model->setCategoryId($expected);

        $this->assertEquals($expected, $model->getCategoryId());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->dto->name, $this->model->getName());
    }

    public function testSetName(): void
    {
        $expected = "cover";
        $model = $this->model;
        $model->setName($expected);

        $this->assertEquals($expected, $model->getName());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-23 23:23:39";
        $model = $this->model;
        $model->setLastUpdate($expected);

        $this->assertEquals($expected, $model->getLastUpdate());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}