<?php

declare(strict_types=1);

namespace Sakila\FilmText;

class FilmTextDto 
{
    public int $filmId;
    public string $title;
    public string $description;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->filmId = (int) ($row["film_id"] ?? 0);
        $this->title = $row["title"] ?? "";
        $this->description = $row["description"] ?? "";
    }
}