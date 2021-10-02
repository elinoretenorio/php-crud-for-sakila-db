<?php

declare(strict_types=1);

namespace Sakila\Payment;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class PaymentController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IPaymentService $service;

    public function __construct(IPaymentService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PaymentModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $paymentId = (int) ($args["payment_id"] ?? 0);
        if ($paymentId <= 0) {
            return new JsonResponse(["result" => $paymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var PaymentModel $model */
        $model = $this->service->createModel($data);
        $model->setPaymentId($paymentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $paymentId = (int) ($args["payment_id"] ?? 0);
        if ($paymentId <= 0) {
            return new JsonResponse(["result" => $paymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var PaymentModel $model */
        $model = $this->service->get($paymentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var PaymentModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $paymentId = (int) ($args["payment_id"] ?? 0);
        if ($paymentId <= 0) {
            return new JsonResponse(["result" => $paymentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($paymentId);

        return new JsonResponse(["result" => $result]);
    }
}