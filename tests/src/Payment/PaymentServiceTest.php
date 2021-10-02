<?php

declare(strict_types=1);

namespace Sakila\Tests\Payment;

use PHPUnit\Framework\TestCase;
use Sakila\Payment\{ PaymentDto, PaymentModel, IPaymentService, PaymentService };

class PaymentServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PaymentDto $dto;
    private PaymentModel $model;
    private IPaymentService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Sakila\Payment\IPaymentRepository");
        $this->input = [
            "payment_id" => 938,
            "customer_id" => 6943,
            "staff_id" => 9246,
            "rental_id" => 975,
            "amount" => 763.00,
            "payment_date" => "2021-10-05 16:49:14",
            "last_update" => "2021-10-14 04:04:44",
        ];
        $this->dto = new PaymentDto($this->input);
        $this->model = new PaymentModel($this->dto);
        $this->service = new PaymentService($this->repository);
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
        $expected = 812;

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
        $expected = 6183;

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
        $paymentId = 7986;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($paymentId)
            ->willReturn(null);

        $actual = $this->service->get($paymentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $paymentId = 1498;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($paymentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($paymentId);
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
        $paymentId = 9933;
        $expected = 1638;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($paymentId)
            ->willReturn($expected);

        $actual = $this->service->delete($paymentId);
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