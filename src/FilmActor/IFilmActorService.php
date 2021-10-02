<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

interface IFilmActorService
{
    public function insert(FilmActorModel $model): int;

    public function update(FilmActorModel $model): int;

    public function get(int $actorId): ?FilmActorModel;

    public function getAll(): array;

    public function delete(int $actorId): int;

    public function createModel(array $row): ?FilmActorModel;
}