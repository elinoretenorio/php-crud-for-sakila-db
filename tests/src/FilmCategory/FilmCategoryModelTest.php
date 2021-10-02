<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmCategory;

use PHPUnit\Framework\TestCase;
use Sakila\FilmCategory\{ FilmCategoryDto, FilmCategoryModel };

class FilmCategoryModelTest extends TestCase
{
    private array $input;
    private FilmCategoryDto $dto;
    private FilmCategoryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "category_id" => 7152,
            "film_id" => 145,
            "last_update" => "2021-10-09 15:54:15",
        ];
        $this->dto = new FilmCategoryDto($this->input);
        $this->model = new FilmCategoryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new FilmCategoryModel(null);

        $this->assertInstanceOf(FilmCategoryModel::class, $model);
    }

    public function testGetCategoryId(): void
    {
        $this->assertEquals($this->dto->categoryId, $this->model->getCategoryId());
    }

    public function testSetCategoryId(): void
    {
        $expected = 7361;
        $model = $this->model;
        $model->setCategoryId($expected);

        $this->assertEquals($expected, $model->getCategoryId());
    }

    public function testGetFilmId(): void
    {
        $this->assertEquals($this->dto->filmId, $this->model->getFilmId());
    }

    public function testSetFilmId(): void
    {
        $expected = 4136;
        $model = $this->model;
        $model->setFilmId($expected);

        $this->assertEquals($expected, $model->getFilmId());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-24 02:42:16";
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