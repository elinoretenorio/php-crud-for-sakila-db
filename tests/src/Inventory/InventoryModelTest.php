<?php

declare(strict_types=1);

namespace Sakila\Tests\Inventory;

use PHPUnit\Framework\TestCase;
use Sakila\Inventory\{ InventoryDto, InventoryModel };

class InventoryModelTest extends TestCase
{
    private array $input;
    private InventoryDto $dto;
    private InventoryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "inventory_id" => 1704,
            "film_id" => 9820,
            "store_id" => 291,
            "last_update" => "2021-09-23 11:23:54",
        ];
        $this->dto = new InventoryDto($this->input);
        $this->model = new InventoryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new InventoryModel(null);

        $this->assertInstanceOf(InventoryModel::class, $model);
    }

    public function testGetInventoryId(): void
    {
        $this->assertEquals($this->dto->inventoryId, $this->model->getInventoryId());
    }

    public function testSetInventoryId(): void
    {
        $expected = 2450;
        $model = $this->model;
        $model->setInventoryId($expected);

        $this->assertEquals($expected, $model->getInventoryId());
    }

    public function testGetFilmId(): void
    {
        $this->assertEquals($this->dto->filmId, $this->model->getFilmId());
    }

    public function testSetFilmId(): void
    {
        $expected = 207;
        $model = $this->model;
        $model->setFilmId($expected);

        $this->assertEquals($expected, $model->getFilmId());
    }

    public function testGetStoreId(): void
    {
        $this->assertEquals($this->dto->storeId, $this->model->getStoreId());
    }

    public function testSetStoreId(): void
    {
        $expected = 9989;
        $model = $this->model;
        $model->setStoreId($expected);

        $this->assertEquals($expected, $model->getStoreId());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-26 07:14:48";
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