<?php

declare(strict_types=1);

namespace Sakila\Film;

class FilmDto 
{
    public int $filmId;
    public string $title;
    public string $description;
    public string $releaseYear;
    public int $languageId;
    public int $originalLanguageId;
    public int $rentalDuration;
    public float $rentalRate;
    public int $length;
    public float $replacementCost;
    public string $rating;
    public string $specialFeatures;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->filmId = (int) ($row["film_id"] ?? 0);
        $this->title = $row["title"] ?? "";
        $this->description = $row["description"] ?? "";
        $this->releaseYear = $row["release_year"] ?? "";
        $this->languageId = (int) ($row["language_id"] ?? 0);
        $this->originalLanguageId = (int) ($row["original_language_id"] ?? 0);
        $this->rentalDuration = (int) ($row["rental_duration"] ?? 0);
        $this->rentalRate = (float) ($row["rental_rate"] ?? 0);
        $this->length = (int) ($row["length"] ?? 0);
        $this->replacementCost = (float) ($row["replacement_cost"] ?? 0);
        $this->rating = $row["rating"] ?? "";
        $this->specialFeatures = $row["special_features"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}