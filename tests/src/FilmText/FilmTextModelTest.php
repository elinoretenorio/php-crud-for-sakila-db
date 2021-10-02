<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmText;

use PHPUnit\Framework\TestCase;
use Sakila\FilmText\{ FilmTextDto, FilmTextModel };

class FilmTextModelTest extends TestCase
{
    private array $input;
    private FilmTextDto $dto;
    private FilmTextModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "film_id" => 754,
            "title" => "chair",
            "description" => "Quite clear style reality. Investment hope individual enjoy.",
        ];
        $this->dto = new FilmTextDto($this->input);
        $this->model = new FilmTextModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new FilmTextModel(null);

        $this->assertInstanceOf(FilmTextModel::class, $model);
    }

    public function testGetFilmId(): void
    {
        $this->assertEquals($this->dto->filmId, $this->model->getFilmId());
    }

    public function testSetFilmId(): void
    {
        $expected = 2354;
        $model = $this->model;
        $model->setFilmId($expected);

        $this->assertEquals($expected, $model->getFilmId());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "one";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals($this->dto->description, $this->model->getDescription());
    }

    public function testSetDescription(): void
    {
        $expected = "Receive so man.";
        $model = $this->model;
        $model->setDescription($expected);

        $this->assertEquals($expected, $model->getDescription());
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