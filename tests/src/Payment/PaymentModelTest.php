<?php

declare(strict_types=1);

namespace Sakila\Tests\Payment;

use PHPUnit\Framework\TestCase;
use Sakila\Payment\{ PaymentDto, PaymentModel };

class PaymentModelTest extends TestCase
{
    private array $input;
    private PaymentDto $dto;
    private PaymentModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "payment_id" => 5717,
            "customer_id" => 4655,
            "staff_id" => 3255,
            "rental_id" => 1339,
            "amount" => 440.00,
            "payment_date" => "2021-09-30 21:57:27",
            "last_update" => "2021-10-08 16:38:43",
        ];
        $this->dto = new PaymentDto($this->input);
        $this->model = new PaymentModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PaymentModel(null);

        $this->assertInstanceOf(PaymentModel::class, $model);
    }

    public function testGetPaymentId(): void
    {
        $this->assertEquals($this->dto->paymentId, $this->model->getPaymentId());
    }

    public function testSetPaymentId(): void
    {
        $expected = 910;
        $model = $this->model;
        $model->setPaymentId($expected);

        $this->assertEquals($expected, $model->getPaymentId());
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 1890;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetStaffId(): void
    {
        $this->assertEquals($this->dto->staffId, $this->model->getStaffId());
    }

    public function testSetStaffId(): void
    {
        $expected = 1950;
        $model = $this->model;
        $model->setStaffId($expected);

        $this->assertEquals($expected, $model->getStaffId());
    }

    public function testGetRentalId(): void
    {
        $this->assertEquals($this->dto->rentalId, $this->model->getRentalId());
    }

    public function testSetRentalId(): void
    {
        $expected = 7658;
        $model = $this->model;
        $model->setRentalId($expected);

        $this->assertEquals($expected, $model->getRentalId());
    }

    public function testGetAmount(): void
    {
        $this->assertEquals($this->dto->amount, $this->model->getAmount());
    }

    public function testSetAmount(): void
    {
        $expected = 321.83;
        $model = $this->model;
        $model->setAmount($expected);

        $this->assertEquals($expected, $model->getAmount());
    }

    public function testGetPaymentDate(): void
    {
        $this->assertEquals($this->dto->paymentDate, $this->model->getPaymentDate());
    }

    public function testSetPaymentDate(): void
    {
        $expected = "2021-10-06 14:48:11";
        $model = $this->model;
        $model->setPaymentDate($expected);

        $this->assertEquals($expected, $model->getPaymentDate());
    }

    public function testGetLastUpdate(): void
    {
        $this->assertEquals($this->dto->lastUpdate, $this->model->getLastUpdate());
    }

    public function testSetLastUpdate(): void
    {
        $expected = "2021-10-05 22:05:20";
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