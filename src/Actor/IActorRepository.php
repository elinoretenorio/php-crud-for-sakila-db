<?php

declare(strict_types=1);

namespace Sakila\Actor;

interface IActorRepository
{
    public function insert(ActorDto $dto): int;

    public function update(ActorDto $dto): int;

    public function get(int $actorId): ?ActorDto;

    public function getAll(): array;

    public function delete(int $actorId): int;
}