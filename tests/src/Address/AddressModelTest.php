<?php

declare(strict_types=1);

namespace Sakila\Tests\Address;

use PHPUnit\Framework\TestCase;
use Sakila\Address\{ AddressDto, AddressModel };

class AddressModelTest extends TestCase
{
    private array $input;
    private AddressDto $dto;
    private AddressModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "address_id" => 8564,
            "address" => "low",
            "address2" => "other",
            "district" => "hundred",
            "city_id" => 1597,
            "postal_code" => "design",
            "phone" => "color",
            "last_update" => "2021-10-01 23:15:17",
        ];
        $this->dto = new AddressDto($this->input);
        $this->model = new AddressModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new AddressModel(null);

        $this->assertInstanceOf(AddressModel::class, $model);
    }

    public function testGetAddressId(): void
    {
        $this->assertEquals($this->dto->addressId, $this->model->getAddressId());
    }

    public function testSetAddressId(): void
    {
        $expected = 7438;
        $model = $this->model;
        $model->setAddressId($expected);

        $this->assertEquals($expected, $model->getAddressId());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "movement";
        $model = $this->model;
        $model->setAddress($expected);

        $this->assertEquals($expected, $model->getAddress());
    }

    public function testGetAddress2(): void
    {
        $this->assertEquals($this->dto->address2, $this->model->getAddress2());
    }

    public function testSetAddress2(): void
    {
        $expected = "democratic";
        $model = $this->model;
        $model->setAddress2($expected);

        $this->assertEquals($expected, $model->getAddress2());
    }

    public function testGetDistrict(): void
    {
        $this->assertEquals($this->dto->district, $this->model->getDistrict());
    }

    public function testSetDistrict(): void
    {
        $expected = "common";
        $model = $this->model;
        $model->setDistrict($expected);

        $this->assertEquals($expected, $model->getDistrict());
    }

    public function testGetCityId(): void
    {
        $this->assertEquals($this->dto->cityId, $this->model->getCityId());
    }

    public function testSetCityId(): void
    {
        $expected = 4028;
        $model = $this->model;
        $model->setCityId($expected);

        $this->assertEquals($expected, $model->getCityId());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "citizen";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "body";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-16 23:23:33";
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