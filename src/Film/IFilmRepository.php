<?php

declare(strict_types=1);

namespace Sakila\Film;

interface IFilmRepository
{
    public function insert(FilmDto $dto): int;

    public function update(FilmDto $dto): int;

    public function get(int $filmId): ?FilmDto;

    public function getAll(): array;

    public function delete(int $filmId): int;
}