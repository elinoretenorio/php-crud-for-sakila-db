<?php

declare(strict_types=1);

namespace Sakila\Staff;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class StaffController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IStaffService $service;

    public function __construct(IStaffService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StaffModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $staffId = (int) ($args["staff_id"] ?? 0);
        if ($staffId <= 0) {
            return new JsonResponse(["result" => $staffId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StaffModel $model */
        $model = $this->service->createModel($data);
        $model->setStaffId($staffId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $staffId = (int) ($args["staff_id"] ?? 0);
        if ($staffId <= 0) {
            return new JsonResponse(["result" => $staffId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var StaffModel $model */
        $model = $this->service->get($staffId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var StaffModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $staffId = (int) ($args["staff_id"] ?? 0);
        if ($staffId <= 0) {
            return new JsonResponse(["result" => $staffId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($staffId);

        return new JsonResponse(["result" => $result]);
    }
}