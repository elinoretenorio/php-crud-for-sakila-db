<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

interface IFilmActorRepository
{
    public function insert(FilmActorDto $dto): int;

    public function update(FilmActorDto $dto): int;

    public function get(int $actorId): ?FilmActorDto;

    public function getAll(): array;

    public function delete(int $actorId): int;
}