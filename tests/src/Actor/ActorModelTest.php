<?php

declare(strict_types=1);

namespace Sakila\Tests\Actor;

use PHPUnit\Framework\TestCase;
use Sakila\Actor\{ ActorDto, ActorModel };

class ActorModelTest extends TestCase
{
    private array $input;
    private ActorDto $dto;
    private ActorModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "actor_id" => 4393,
            "first_name" => "east",
            "last_name" => "the",
            "last_update" => "2021-10-02 06:31:52",
        ];
        $this->dto = new ActorDto($this->input);
        $this->model = new ActorModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ActorModel(null);

        $this->assertInstanceOf(ActorModel::class, $model);
    }

    public function testGetActorId(): void
    {
        $this->assertEquals($this->dto->actorId, $this->model->getActorId());
    }

    public function testSetActorId(): void
    {
        $expected = 8374;
        $model = $this->model;
        $model->setActorId($expected);

        $this->assertEquals($expected, $model->getActorId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "rule";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "this";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-22 17:00:24";
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