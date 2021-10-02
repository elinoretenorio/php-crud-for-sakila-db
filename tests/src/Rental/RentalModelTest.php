<?php

declare(strict_types=1);

namespace Sakila\Tests\Rental;

use PHPUnit\Framework\TestCase;
use Sakila\Rental\{ RentalDto, RentalModel };

class RentalModelTest extends TestCase
{
    private array $input;
    private RentalDto $dto;
    private RentalModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "rental_id" => 2667,
            "rental_date" => "2021-09-24 22:26:05",
            "inventory_id" => 7752,
            "customer_id" => 7266,
            "return_date" => "2021-09-25 04:56:46",
            "staff_id" => 8796,
            "last_update" => "2021-10-06 23:49:51",
        ];
        $this->dto = new RentalDto($this->input);
        $this->model = new RentalModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new RentalModel(null);

        $this->assertInstanceOf(RentalModel::class, $model);
    }

    public function testGetRentalId(): void
    {
        $this->assertEquals($this->dto->rentalId, $this->model->getRentalId());
    }

    public function testSetRentalId(): void
    {
        $expected = 3914;
        $model = $this->model;
        $model->setRentalId($expected);

        $this->assertEquals($expected, $model->getRentalId());
    }

    public function testGetRentalDate(): void
    {
        $this->assertEquals($this->dto->rentalDate, $this->model->getRentalDate());
    }

    public function testSetRentalDate(): void
    {
        $expected = "2021-10-10 06:01:43";
        $model = $this->model;
        $model->setRentalDate($expected);

        $this->assertEquals($expected, $model->getRentalDate());
    }

    public function testGetInventoryId(): void
    {
        $this->assertEquals($this->dto->inventoryId, $this->model->getInventoryId());
    }

    public function testSetInventoryId(): void
    {
        $expected = 7635;
        $model = $this->model;
        $model->setInventoryId($expected);

        $this->assertEquals($expected, $model->getInventoryId());
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 3507;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetReturnDate(): void
    {
        $this->assertEquals($this->dto->returnDate, $this->model->getReturnDate());
    }

    public function testSetReturnDate(): void
    {
        $expected = "2021-09-19 04:38:44";
        $model = $this->model;
        $model->setReturnDate($expected);

        $this->assertEquals($expected, $model->getReturnDate());
    }

    public function testGetStaffId(): void
    {
        $this->assertEquals($this->dto->staffId, $this->model->getStaffId());
    }

    public function testSetStaffId(): void
    {
        $expected = 2370;
        $model = $this->model;
        $model->setStaffId($expected);

        $this->assertEquals($expected, $model->getStaffId());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-03 20:16:16";
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