<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

interface IFilmCategoryService
{
    public function insert(FilmCategoryModel $model): int;

    public function update(FilmCategoryModel $model): int;

    public function get(int $categoryId): ?FilmCategoryModel;

    public function getAll(): array;

    public function delete(int $categoryId): int;

    public function createModel(array $row): ?FilmCategoryModel;
}