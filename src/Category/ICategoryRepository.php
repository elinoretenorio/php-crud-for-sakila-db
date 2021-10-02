<?php

declare(strict_types=1);

namespace Sakila\Category;

interface ICategoryRepository
{
    public function insert(CategoryDto $dto): int;

    public function update(CategoryDto $dto): int;

    public function get(int $categoryId): ?CategoryDto;

    public function getAll(): array;

    public function delete(int $categoryId): int;
}