<?php

declare(strict_types=1);

namespace Sakila\Actor;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ActorController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IActorService $service;

    public function __construct(IActorService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ActorModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $actorId = (int) ($args["actor_id"] ?? 0);
        if ($actorId <= 0) {
            return new JsonResponse(["result" => $actorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ActorModel $model */
        $model = $this->service->createModel($data);
        $model->setActorId($actorId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $actorId = (int) ($args["actor_id"] ?? 0);
        if ($actorId <= 0) {
            return new JsonResponse(["result" => $actorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var ActorModel $model */
        $model = $this->service->get($actorId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var ActorModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $actorId = (int) ($args["actor_id"] ?? 0);
        if ($actorId <= 0) {
            return new JsonResponse(["result" => $actorId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($actorId);

        return new JsonResponse(["result" => $result]);
    }
}