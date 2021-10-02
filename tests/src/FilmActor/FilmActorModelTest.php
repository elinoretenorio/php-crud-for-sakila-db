<?php

declare(strict_types=1);

namespace Sakila\Tests\FilmActor;

use PHPUnit\Framework\TestCase;
use Sakila\FilmActor\{ FilmActorDto, FilmActorModel };

class FilmActorModelTest extends TestCase
{
    private array $input;
    private FilmActorDto $dto;
    private FilmActorModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "actor_id" => 8735,
            "film_id" => 9889,
            "last_update" => "2021-09-28 03:03:49",
        ];
        $this->dto = new FilmActorDto($this->input);
        $this->model = new FilmActorModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new FilmActorModel(null);

        $this->assertInstanceOf(FilmActorModel::class, $model);
    }

    public function testGetActorId(): void
    {
        $this->assertEquals($this->dto->actorId, $this->model->getActorId());
    }

    public function testSetActorId(): void
    {
        $expected = 1638;
        $model = $this->model;
        $model->setActorId($expected);

        $this->assertEquals($expected, $model->getActorId());
    }

    public function testGetFilmId(): void
    {
        $this->assertEquals($this->dto->filmId, $this->model->getFilmId());
    }

    public function testSetFilmId(): void
    {
        $expected = 2807;
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
        $expected = "2021-10-07 05:07:05";
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