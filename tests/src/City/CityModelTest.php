<?php

declare(strict_types=1);

namespace Sakila\Tests\City;

use PHPUnit\Framework\TestCase;
use Sakila\City\{ CityDto, CityModel };

class CityModelTest extends TestCase
{
    private array $input;
    private CityDto $dto;
    private CityModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "city_id" => 3771,
            "city" => "yard",
            "country_id" => 8593,
            "last_update" => "2021-10-03 09:21:00",
        ];
        $this->dto = new CityDto($this->input);
        $this->model = new CityModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CityModel(null);

        $this->assertInstanceOf(CityModel::class, $model);
    }

    public function testGetCityId(): void
    {
        $this->assertEquals($this->dto->cityId, $this->model->getCityId());
    }

    public function testSetCityId(): void
    {
        $expected = 3331;
        $model = $this->model;
        $model->setCityId($expected);

        $this->assertEquals($expected, $model->getCityId());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "at";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetCountryId(): void
    {
        $this->assertEquals($this->dto->countryId, $this->model->getCountryId());
    }

    public function testSetCountryId(): void
    {
        $expected = 8462;
        $model = $this->model;
        $model->setCountryId($expected);

        $this->assertEquals($expected, $model->getCountryId());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-09 12:47:02";
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