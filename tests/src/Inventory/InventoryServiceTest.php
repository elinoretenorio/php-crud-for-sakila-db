<?php

declare(strict_types=1);

namespace Sakila\Tests\Inventory;

use PHPUnit\Framework\TestCase;
use Sakila\Inventory\{ InventoryDto, InventoryModel, IInventoryService, InventoryService };

class InventoryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private InventoryDto $dto;
    private InventoryModel $model;
    private IInventoryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Inventory\IInventoryRepository");
        $this->input = [
            "inventory_id" => 6812,
            "film_id" => 9382,
            "store_id" => 2887,
            "last_update" => "2021-09-19 06:09:34",
        ];
        $this->dto = new InventoryDto($this->input);
        $this->model = new InventoryModel($this->dto);
        $this->service = new InventoryService($this->repository);
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
        $expected = 8680;

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
        $expected = 5288;

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
        $inventoryId = 5613;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($inventoryId)
            ->willReturn(null);

        $actual = $this->service->get($inventoryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $inventoryId = 6838;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($inventoryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($inventoryId);
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
        $inventoryId = 1155;
        $expected = 2819;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($inventoryId)
            ->willReturn($expected);

        $actual = $this->service->delete($inventoryId);
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