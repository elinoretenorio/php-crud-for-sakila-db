<?php

declare(strict_types=1);

namespace Sakila\Actor;

class ActorDto 
{
    public int $actorId;
    public string $firstName;
    public string $lastName;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->actorId = (int) ($row["actor_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}