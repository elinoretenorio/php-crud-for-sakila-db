<?php

declare(strict_types=1);

namespace Sakila\Tests\Address;

use PHPUnit\Framework\TestCase;
use Sakila\Address\{ AddressDto, AddressModel, IAddressService, AddressService };

class AddressServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private AddressDto $dto;
    private AddressModel $model;
    private IAddressService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Address\IAddressRepository");
        $this->input = [
            "address_id" => 5357,
            "address" => "beat",
            "address2" => "represent",
            "district" => "evidence",
            "city_id" => 9232,
            "postal_code" => "wife",
            "phone" => "size",
            "last_update" => "2021-10-07 14:22:52",
        ];
        $this->dto = new AddressDto($this->input);
        $this->model = new AddressModel($this->dto);
        $this->service = new AddressService($this->repository);
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
        $expected = 5097;

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
        $expected = 8587;

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
        $addressId = 8288;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($addressId)
            ->willReturn(null);

        $actual = $this->service->get($addressId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $addressId = 9736;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($addressId)
            ->willReturn($this->dto);

        $actual = $this->service->get($addressId);
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
        $addressId = 5164;
        $expected = 6359;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($addressId)
            ->willReturn($expected);

        $actual = $this->service->delete($addressId);
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