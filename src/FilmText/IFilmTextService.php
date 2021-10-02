<?php

declare(strict_types=1);

namespace Sakila\FilmText;

interface IFilmTextService
{
    public function insert(FilmTextModel $model): int;

    public function update(FilmTextModel $model): int;

    public function get(int $filmId): ?FilmTextModel;

    public function getAll(): array;

    public function delete(int $filmId): int;

    public function createModel(array $row): ?FilmTextModel;
}