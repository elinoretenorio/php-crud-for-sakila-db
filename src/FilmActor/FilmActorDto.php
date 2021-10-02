<?php

declare(strict_types=1);

namespace Sakila\FilmActor;

class FilmActorDto 
{
    public int $actorId;
    public int $filmId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->actorId = (int) ($row["actor_id"] ?? 0);
        $this->filmId = (int) ($row["film_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}