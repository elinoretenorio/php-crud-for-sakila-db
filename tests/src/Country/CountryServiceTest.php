<?php

declare(strict_types=1);

namespace Sakila\Tests\Country;

use PHPUnit\Framework\TestCase;
use Sakila\Country\{ CountryDto, CountryModel, ICountryService, CountryService };

class CountryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CountryDto $dto;
    private CountryModel $model;
    private ICountryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Country\ICountryRepository");
        $this->input = [
            "country_id" => 1382,
            "country" => "across",
            "last_update" => "2021-10-07 07:13:51",
        ];
        $this->dto = new CountryDto($this->input);
        $this->model = new CountryModel($this->dto);
        $this->service = new CountryService($this->repository);
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
        $expected = 3202;

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
        $expected = 4569;

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
        $countryId = 2739;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryId)
            ->willReturn(null);

        $actual = $this->service->get($countryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $countryId = 9536;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($countryId);
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
        $countryId = 2320;
        $expected = 6944;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($countryId)
            ->willReturn($expected);

        $actual = $this->service->delete($countryId);
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