<?php

declare(strict_types=1);

namespace Sakila\Actor;

use JsonSerializable;

class ActorModel implements JsonSerializable
{
    private int $actorId;
    private string $firstName;
    private string $lastName;
    private string $lastUpdate;

    public function __construct(ActorDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->actorId = $dto->actorId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getActorId(): int
    {
        return $this->actorId;
    }

    public function setActorId(int $actorId): void
    {
        $this->actorId = $actorId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): ActorDto
    {
        $dto = new ActorDto();
        $dto->actorId = (int) ($this->actorId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "actor_id" => $this->actorId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "last_update" => $this->lastUpdate,
        ];
    }
}