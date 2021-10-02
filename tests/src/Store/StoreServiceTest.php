<?php

declare(strict_types=1);

namespace Sakila\Tests\Store;

use PHPUnit\Framework\TestCase;
use Sakila\Store\{ StoreDto, StoreModel, IStoreService, StoreService };

class StoreServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private StoreDto $dto;
    private StoreModel $model;
    private IStoreService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Store\IStoreRepository");
        $this->input = [
            "store_id" => 1185,
            "manager_staff_id" => 6053,
            "address_id" => 7298,
            "last_update" => "2021-10-03 09:11:19",
        ];
        $this->dto = new StoreDto($this->input);
        $this->model = new StoreModel($this->dto);
        $this->service = new StoreService($this->repository);
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
        $expected = 4000;

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
        $expected = 9972;

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
        $storeId = 3541;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($storeId)
            ->willReturn(null);

        $actual = $this->service->get($storeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $storeId = 7067;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($storeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($storeId);
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
        $storeId = 6288;
        $expected = 3023;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($storeId)
            ->willReturn($expected);

        $actual = $this->service->delete($storeId);
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