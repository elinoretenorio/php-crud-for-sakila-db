<?php

declare(strict_types=1);

namespace Sakila\Tests\Customer;

use PHPUnit\Framework\TestCase;
use Sakila\Customer\{ CustomerDto, CustomerModel };

class CustomerModelTest extends TestCase
{
    private array $input;
    private CustomerDto $dto;
    private CustomerModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "customer_id" => 355,
            "store_id" => 7867,
            "first_name" => "picture",
            "last_name" => "someone",
            "email" => "staceyholloway@example.org",
            "address_id" => 6999,
            "active" => True,
            "create_date" => "2021-10-03 20:51:03",
            "last_update" => "2021-10-04 22:56:27",
        ];
        $this->dto = new CustomerDto($this->input);
        $this->model = new CustomerModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomerModel(null);

        $this->assertInstanceOf(CustomerModel::class, $model);
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 1100;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetStoreId(): void
    {
        $this->assertEquals($this->dto->storeId, $this->model->getStoreId());
    }

    public function testSetStoreId(): void
    {
        $expected = 1186;
        $model = $this->model;
        $model->setStoreId($expected);

        $this->assertEquals($expected, $model->getStoreId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "eight";
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
        $expected = "down";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->dto->email, $this->model->getEmail());
    }

    public function testSetEmail(): void
    {
        $expected = "johnmorris@example.net";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
    }

    public function testGetAddressId(): void
    {
        $this->assertEquals($this->dto->addressId, $this->model->getAddressId());
    }

    public function testSetAddressId(): void
    {
        $expected = 9468;
        $model = $this->model;
        $model->setAddressId($expected);

        $this->assertEquals($expected, $model->getAddressId());
    }

    public function testGetActive(): void
    {
        $this->assertEquals($this->dto->active, $this->model->getActive());
    }

    public function testSetActive(): void
    {
        $expected = False;
        $model = $this->model;
        $model->setActive($expected);

        $this->assertEquals($expected, $model->getActive());
    }

    public function testGetCreateDate(): void
    {
        $this->assertEquals($this->dto->createDate, $this->model->getCreateDate());
    }

    public function testSetCreateDate(): void
    {
        $expected = "2021-09-14 21:44:14";
        $model = $this->model;
        $model->setCreateDate($expected);

        $this->assertEquals($expected, $model->getCreateDate());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-12 12:18:41";
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