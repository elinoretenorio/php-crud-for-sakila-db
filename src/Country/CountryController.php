<?php

declare(strict_types=1);

namespace Sakila\Country;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CountryController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICountryService $service;

    public function __construct(ICountryService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CountryModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $countryId = (int) ($args["country_id"] ?? 0);
        if ($countryId <= 0) {
            return new JsonResponse(["result" => $countryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CountryModel $model */
        $model = $this->service->createModel($data);
        $model->setCountryId($countryId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $countryId = (int) ($args["country_id"] ?? 0);
        if ($countryId <= 0) {
            return new JsonResponse(["result" => $countryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CountryModel $model */
        $model = $this->service->get($countryId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CountryModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $countryId = (int) ($args["country_id"] ?? 0);
        if ($countryId <= 0) {
            return new JsonResponse(["result" => $countryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($countryId);

        return new JsonResponse(["result" => $result]);
    }
}