<?php

declare(strict_types=1);

namespace Sakila\Film;

interface IFilmService
{
    public function insert(FilmModel $model): int;

    public function update(FilmModel $model): int;

    public function get(int $filmId): ?FilmModel;

    public function getAll(): array;

    public function delete(int $filmId): int;

    public function createModel(array $row): ?FilmModel;
}