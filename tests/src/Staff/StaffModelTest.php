<?php

declare(strict_types=1);

namespace Sakila\Tests\Staff;

use PHPUnit\Framework\TestCase;
use Sakila\Staff\{ StaffDto, StaffModel };

class StaffModelTest extends TestCase
{
    private array $input;
    private StaffDto $dto;
    private StaffModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "staff_id" => 2742,
            "first_name" => "own",
            "last_name" => "work",
            "address_id" => 8688,
            "picture" => "Guy east understand draw game.",
            "email" => "hahnmary@example.com",
            "store_id" => 2961,
            "active" => False,
            "username" => "hair",
            "password" => "quite",
            "last_update" => "2021-10-04 18:54:39",
        ];
        $this->dto = new StaffDto($this->input);
        $this->model = new StaffModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new StaffModel(null);

        $this->assertInstanceOf(StaffModel::class, $model);
    }

    public function testGetStaffId(): void
    {
        $this->assertEquals($this->dto->staffId, $this->model->getStaffId());
    }

    public function testSetStaffId(): void
    {
        $expected = 2493;
        $model = $this->model;
        $model->setStaffId($expected);

        $this->assertEquals($expected, $model->getStaffId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "travel";
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
        $expected = "defense";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetAddressId(): void
    {
        $this->assertEquals($this->dto->addressId, $this->model->getAddressId());
    }

    public function testSetAddressId(): void
    {
        $expected = 2969;
        $model = $this->model;
        $model->setAddressId($expected);

        $this->assertEquals($expected, $model->getAddressId());
    }

    public function testGetPicture(): void
    {
        $this->assertEquals($this->dto->picture, $this->model->getPicture());
    }

    public function testSetPicture(): void
    {
        $expected = "Cup name they actually huge simply man.";
        $model = $this->model;
        $model->setPicture($expected);

        $this->assertEquals($expected, $model->getPicture());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->dto->email, $this->model->getEmail());
    }

    public function testSetEmail(): void
    {
        $expected = "devinbooth@example.net";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
    }

    public function testGetStoreId(): void
    {
        $this->assertEquals($this->dto->storeId, $this->model->getStoreId());
    }

    public function testSetStoreId(): void
    {
        $expected = 9080;
        $model = $this->model;
        $model->setStoreId($expected);

        $this->assertEquals($expected, $model->getStoreId());
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

    public function testGetUsername(): void
    {
        $this->assertEquals($this->dto->username, $this->model->getUsername());
    }

    public function testSetUsername(): void
    {
        $expected = "people";
        $model = $this->model;
        $model->setUsername($expected);

        $this->assertEquals($expected, $model->getUsername());
    }

    public function testGetPassword(): void
    {
        $this->assertEquals($this->dto->password, $this->model->getPassword());
    }

    public function testSetPassword(): void
    {
        $expected = "cold";
        $model = $this->model;
        $model->setPassword($expected);

        $this->assertEquals($expected, $model->getPassword());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-09-15 23:37:19";
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