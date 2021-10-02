<?php

declare(strict_types=1);

namespace Sakila\FilmText;

class FilmTextService implements IFilmTextService
{
    private IFilmTextRepository $repository;

    public function __construct(IFilmTextRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(FilmTextModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(FilmTextModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $filmId): ?FilmTextModel
    {
        $dto = $this->repository->get($filmId);
        if ($dto === null) {
            return null;
        }

        return new FilmTextModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var FilmTextDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new FilmTextModel($dto);
        }

        return $result;
    }

    public function delete(int $filmId): int
    {
        return $this->repository->delete($filmId);
    }

    public function createModel(array $row): ?FilmTextModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new FilmTextDto($row);

        return new FilmTextModel($dto);
    }
}