<?php

declare(strict_types=1);

namespace Sakila\Category;

class CategoryService implements ICategoryService
{
    private ICategoryRepository $repository;

    public function __construct(ICategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CategoryModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CategoryModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $categoryId): ?CategoryModel
    {
        $dto = $this->repository->get($categoryId);
        if ($dto === null) {
            return null;
        }

        return new CategoryModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CategoryDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CategoryModel($dto);
        }

        return $result;
    }

    public function delete(int $categoryId): int
    {
        return $this->repository->delete($categoryId);
    }

    public function createModel(array $row): ?CategoryModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CategoryDto($row);

        return new CategoryModel($dto);
    }
}