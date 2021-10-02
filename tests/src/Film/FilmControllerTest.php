<?php

declare(strict_types=1);

namespace Sakila\Tests\Film;

use PHPUnit\Framework\TestCase;
use Sakila\Film\{ FilmDto, FilmModel, FilmController };

class FilmControllerTest extends TestCase
{
    private array $input;
    private FilmDto $dto;
    private FilmModel $model;
    private $service;
    private $request;
    private $stream;
    private FilmController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "film_id" => 2890,
            "title" => "where",
            "description" => "Serve however take store investment. Smile these pressure window here matter feel. There several agent your support individual.",
            "release_year" => "Building cup trade approach thousand individual speech positive.",
            "language_id" => 7746,
            "original_language_id" => 9300,
            "rental_duration" => 2767,
            "rental_rate" => 952.20,
            "length" => 3016,
            "replacement_cost" => 610.00,
            "rating" => "Health physicist",
            "special_features" => "Engineer, petroleum",
            "last_update" => "2021-09-18 11:49:45",
        ];
        $this->dto = new FilmDto($this->input);
        $this->model = new FilmModel($this->dto);
        $this->service = $this->createMock("Sakila\Film\IFilmService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new FilmController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 7394;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["film_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 273;
        $expected = ["result" => $id];
        $args = ["film_id" => 9869];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["film_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["film_id" => 3208];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["film_id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["film_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 8372;
        $expected = ["result" => $id];
        $args = ["film_id" => 1782];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["film_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}