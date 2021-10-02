<?php

declare(strict_types=1);

namespace Sakila\Tests\Store;

use PHPUnit\Framework\TestCase;
use Sakila\Store\{ StoreDto, StoreModel };

class StoreModelTest extends TestCase
{
    private array $input;
    private StoreDto $dto;
    private StoreModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "store_id" => 9943,
            "manager_staff_id" => 684,
            "address_id" => 5309,
            "last_update" => "2021-09-20 20:01:45",
        ];
        $this->dto = new StoreDto($this->input);
        $this->model = new StoreModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new StoreModel(null);

        $this->assertInstanceOf(StoreModel::class, $model);
    }

    public function testGetStoreId(): void
    {
        $this->assertEquals($this->dto->storeId, $this->model->getStoreId());
    }

    public function testSetStoreId(): void
    {
        $expected = 2745;
        $model = $this->model;
        $model->setStoreId($expected);

        $this->assertEquals($expected, $model->getStoreId());
    }

    public function testGetManagerStaffId(): void
    {
        $this->assertEquals($this->dto->managerStaffId, $this->model->getManagerStaffId());
    }

    public function testSetManagerStaffId(): void
    {
        $expected = 8944;
        $model = $this->model;
        $model->setManagerStaffId($expected);

        $this->assertEquals($expected, $model->getManagerStaffId());
    }

    public function testGetAddressId(): void
    {
        $this->assertEquals($this->dto->addressId, $this->model->getAddressId());
    }

    public function testSetAddressId(): void
    {
        $expected = 5731;
        $model = $this->model;
        $model->setAddressId($expected);

        $this->assertEquals($expected, $model->getAddressId());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-03 11:01:37";
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