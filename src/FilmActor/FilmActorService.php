<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

class FilmActorService implements IFilmActorService
{
    private IFilmActorRepository $repository;

    public function __construct(IFilmActorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(FilmActorModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(FilmActorModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $actorId): ?FilmActorModel
    {
        $dto = $this->repository->get($actorId);
        if ($dto === null) {
            return null;
        }

        return new FilmActorModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var FilmActorDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new FilmActorModel($dto);
        }

        return $result;
    }

    public function delete(int $actorId): int
    {
        return $this->repository->delete($actorId);
    }

    public function createModel(array $row): ?FilmActorModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new FilmActorDto($row);

        return new FilmActorModel($dto);
    }
}