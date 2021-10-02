<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

use JsonSerializable;

class FilmActorModel implements JsonSerializable
{
    private int $actorId;
    private int $filmId;
    private string $lastUpdate;

    public function __construct(FilmActorDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->actorId = $dto->actorId;
        $this->filmId = $dto->filmId;
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

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): FilmActorDto
    {
        $dto = new FilmActorDto();
        $dto->actorId = (int) ($this->actorId ?? 0);
        $dto->filmId = (int) ($this->filmId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "actor_id" => $this->actorId,
            "film_id" => $this->filmId,
            "last_update" => $this->lastUpdate,
        ];
    }
}