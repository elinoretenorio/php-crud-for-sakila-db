<?php

declare(strict_types=1);

namespace Sakila\Actor;

class ActorService implements IActorService
{
    private IActorRepository $repository;

    public function __construct(IActorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ActorModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ActorModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $actorId): ?ActorModel
    {
        $dto = $this->repository->get($actorId);
        if ($dto === null) {
            return null;
        }

        return new ActorModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ActorDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ActorModel($dto);
        }

        return $result;
    }

    public function delete(int $actorId): int
    {
        return $this->repository->delete($actorId);
    }

    public function createModel(array $row): ?ActorModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ActorDto($row);

        return new ActorModel($dto);
    }
}