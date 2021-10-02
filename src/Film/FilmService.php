<?php

declare(strict_types=1);

namespace Sakila\Film;

class FilmService implements IFilmService
{
    private IFilmRepository $repository;

    public function __construct(IFilmRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(FilmModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(FilmModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $filmId): ?FilmModel
    {
        $dto = $this->repository->get($filmId);
        if ($dto === null) {
            return null;
        }

        return new FilmModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var FilmDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new FilmModel($dto);
        }

        return $result;
    }

    public function delete(int $filmId): int
    {
        return $this->repository->delete($filmId);
    }

    public function createModel(array $row): ?FilmModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new FilmDto($row);

        return new FilmModel($dto);
    }
}