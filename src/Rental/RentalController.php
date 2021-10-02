<?php

declare(strict_types=1);

namespace Sakila\Rental;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class RentalController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IRentalService $service;

    public function __construct(IRentalService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var RentalModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $rentalId = (int) ($args["rental_id"] ?? 0);
        if ($rentalId <= 0) {
            return new JsonResponse(["result" => $rentalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var RentalModel $model */
        $model = $this->service->createModel($data);
        $model->setRentalId($rentalId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $rentalId = (int) ($args["rental_id"] ?? 0);
        if ($rentalId <= 0) {
            return new JsonResponse(["result" => $rentalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var RentalModel $model */
        $model = $this->service->get($rentalId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var RentalModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $rentalId = (int) ($args["rental_id"] ?? 0);
        if ($rentalId <= 0) {
            return new JsonResponse(["result" => $rentalId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($rentalId);

        return new JsonResponse(["result" => $result]);
    }
}