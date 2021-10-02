<?php

declare(strict_types=1);

namespace Sakila\Film;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class FilmController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IFilmService $service;

    public function __construct(IFilmService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var FilmModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $filmId = (int) ($args["film_id"] ?? 0);
        if ($filmId <= 0) {
            return new JsonResponse(["result" => $filmId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var FilmModel $model */
        $model = $this->service->createModel($data);
        $model->setFilmId($filmId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $filmId = (int) ($args["film_id"] ?? 0);
        if ($filmId <= 0) {
            return new JsonResponse(["result" => $filmId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var FilmModel $model */
        $model = $this->service->get($filmId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var FilmModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $filmId = (int) ($args["film_id"] ?? 0);
        if ($filmId <= 0) {
            return new JsonResponse(["result" => $filmId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($filmId);

        return new JsonResponse(["result" => $result]);
    }
}