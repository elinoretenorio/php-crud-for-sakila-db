<?php

declare(strict_types=1);

namespace Sakila\Tests\Rental;

use PHPUnit\Framework\TestCase;
use Sakila\Rental\{ RentalDto, RentalModel, IRentalService, RentalService };

class RentalServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private RentalDto $dto;
    private RentalModel $model;
    private IRentalService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Rental\IRentalRepository");
        $this->input = [
            "rental_id" => 5021,
            "rental_date" => "2021-10-01 14:54:29",
            "inventory_id" => 6494,
            "customer_id" => 8723,
            "return_date" => "2021-09-16 17:21:58",
            "staff_id" => 196,
            "last_update" => "2021-10-09 23:38:28",
        ];
        $this->dto = new RentalDto($this->input);
        $this->model = new RentalModel($this->dto);
        $this->service = new RentalService($this->repository);
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
        $expected = 6091;

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
        $expected = 880;

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
        $rentalId = 4896;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($rentalId)
            ->willReturn(null);

        $actual = $this->service->get($rentalId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $rentalId = 7403;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($rentalId)
            ->willReturn($this->dto);

        $actual = $this->service->get($rentalId);
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
        $rentalId = 6893;
        $expected = 2113;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($rentalId)
            ->willReturn($expected);

        $actual = $this->service->delete($rentalId);
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