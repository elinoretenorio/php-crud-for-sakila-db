<?php

declare(strict_types=1);

namespace Sakila\Tests\Customer;

use PHPUnit\Framework\TestCase;
use Sakila\Customer\{ CustomerDto, CustomerModel, ICustomerService, CustomerService };

class CustomerServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomerDto $dto;
    private CustomerModel $model;
    private ICustomerService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Customer\ICustomerRepository");
        $this->input = [
            "customer_id" => 4486,
            "store_id" => 7388,
            "first_name" => "project",
            "last_name" => "situation",
            "email" => "eileensilva@example.net",
            "address_id" => 1346,
            "active" => False,
            "create_date" => "2021-09-25 16:45:14",
            "last_update" => "2021-10-14 10:23:43",
        ];
        $this->dto = new CustomerDto($this->input);
        $this->model = new CustomerModel($this->dto);
        $this->service = new CustomerService($this->repository);
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
        $expected = 2364;

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
        $expected = 3874;

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
        $customerId = 8762;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn(null);

        $actual = $this->service->get($customerId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerId = 3775;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerId);
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
        $customerId = 7353;
        $expected = 2856;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerId)
            ->willReturn($expected);

        $actual = $this->service->delete($customerId);
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