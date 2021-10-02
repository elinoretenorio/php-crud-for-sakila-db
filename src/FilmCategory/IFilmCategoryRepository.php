<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

interface IFilmCategoryRepository
{
    public function insert(FilmCategoryDto $dto): int;

    public function update(FilmCategoryDto $dto): int;

    public function get(int $categoryId): ?FilmCategoryDto;

    public function getAll(): array;

    public function delete(int $categoryId): int;
}