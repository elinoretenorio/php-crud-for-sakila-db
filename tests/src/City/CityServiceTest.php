<?php

declare(strict_types=1);

namespace Sakila\Tests\City;

use PHPUnit\Framework\TestCase;
use Sakila\City\{ CityDto, CityModel, ICityService, CityService };

class CityServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CityDto $dto;
    private CityModel $model;
    private ICityService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\City\ICityRepository");
        $this->input = [
            "city_id" => 9649,
            "city" => "behavior",
            "country_id" => 671,
            "last_update" => "2021-10-09 21:02:40",
        ];
        $this->dto = new CityDto($this->input);
        $this->model = new CityModel($this->dto);
        $this->service = new CityService($this->repository);
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
        $expected = 7350;

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
        $expected = 3978;

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
        $cityId = 7199;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cityId)
            ->willReturn(null);

        $actual = $this->service->get($cityId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $cityId = 583;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($cityId)
            ->willReturn($this->dto);

        $actual = $this->service->get($cityId);
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
        $cityId = 2645;
        $expected = 1600;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($cityId)
            ->willReturn($expected);

        $actual = $this->service->delete($cityId);
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