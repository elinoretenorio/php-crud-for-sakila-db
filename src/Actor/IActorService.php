<?php

declare(strict_types=1);

namespace Sakila\Actor;

interface IActorService
{
    public function insert(ActorModel $model): int;

    public function update(ActorModel $model): int;

    public function get(int $actorId): ?ActorModel;

    public function getAll(): array;

    public function delete(int $actorId): int;

    public function createModel(array $row): ?ActorModel;
}