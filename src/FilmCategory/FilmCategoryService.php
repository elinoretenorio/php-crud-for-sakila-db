<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

class FilmCategoryService implements IFilmCategoryService
{
    private IFilmCategoryRepository $repository;

    public function __construct(IFilmCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(FilmCategoryModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(FilmCategoryModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $categoryId): ?FilmCategoryModel
    {
        $dto = $this->repository->get($categoryId);
        if ($dto === null) {
            return null;
        }

        return new FilmCategoryModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var FilmCategoryDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new FilmCategoryModel($dto);
        }

        return $result;
    }

    public function delete(int $categoryId): int
    {
        return $this->repository->delete($categoryId);
    }

    public function createModel(array $row): ?FilmCategoryModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new FilmCategoryDto($row);

        return new FilmCategoryModel($dto);
    }
}