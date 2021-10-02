<?php

declare(strict_types=1);

namespace Sakila\FilmText;

interface IFilmTextRepository
{
    public function insert(FilmTextDto $dto): int;

    public function update(FilmTextDto $dto): int;

    public function get(int $filmId): ?FilmTextDto;

    public function getAll(): array;

    public function delete(int $filmId): int;
}