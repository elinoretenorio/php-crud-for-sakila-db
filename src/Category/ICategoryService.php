<?php

declare(strict_types=1);

namespace Sakila\Category;

interface ICategoryService
{
    public function insert(CategoryModel $model): int;

    public function update(CategoryModel $model): int;

    public function get(int $categoryId): ?CategoryModel;

    public function getAll(): array;

    public function delete(int $categoryId): int;

    public function createModel(array $row): ?CategoryModel;
}