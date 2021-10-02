<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

class FilmCategoryDto 
{
    public int $categoryId;
    public int $filmId;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->categoryId = (int) ($row["category_id"] ?? 0);
        $this->filmId = (int) ($row["film_id"] ?? 0);
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}