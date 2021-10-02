<?php

declare(strict_types=1);

namespace Sakila\Store;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class StoreController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IStoreService $service;

    public function __construct(IStoreService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StoreModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $storeId = (int) ($args["store_id"] ?? 0);
        if ($storeId <= 0) {
            return new JsonResponse(["result" => $storeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var StoreModel $model */
        $model = $this->service->createModel($data);
        $model->setStoreId($storeId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $storeId = (int) ($args["store_id"] ?? 0);
        if ($storeId <= 0) {
            return new JsonResponse(["result" => $storeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var StoreModel $model */
        $model = $this->service->get($storeId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var StoreModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $storeId = (int) ($args["store_id"] ?? 0);
        if ($storeId <= 0) {
            return new JsonResponse(["result" => $storeId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($storeId);

        return new JsonResponse(["result" => $result]);
    }
}