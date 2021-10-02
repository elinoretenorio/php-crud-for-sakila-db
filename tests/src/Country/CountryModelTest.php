<?php

declare(strict_types=1);

namespace Sakila\Tests\Country;

use PHPUnit\Framework\TestCase;
use Sakila\Country\{ CountryDto, CountryModel };

class CountryModelTest extends TestCase
{
    private array $input;
    private CountryDto $dto;
    private CountryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "country_id" => 2503,
            "country" => "try",
            "last_update" => "2021-10-08 03:08:11",
        ];
        $this->dto = new CountryDto($this->input);
        $this->model = new CountryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CountryModel(null);

        $this->assertInstanceOf(CountryModel::class, $model);
    }

    public function testGetCountryId(): void
    {
        $this->assertEquals($this->dto->countryId, $this->model->getCountryId());
    }

    public function testSetCountryId(): void
    {
        $expected = 9765;
        $model = $this->model;
        $model->setCountryId($expected);

        $this->assertEquals($expected, $model->getCountryId());
    }

    public function testGetCountry(): void
    {
        $this->assertEquals($this->dto->country, $this->model->getCountry());
    }

    public function testSetCountry(): void
    {
        $expected = "member";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-08 12:49:04";
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