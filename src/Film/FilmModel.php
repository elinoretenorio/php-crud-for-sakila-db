<?php

declare(strict_types=1);

namespace Sakila\Film;

use JsonSerializable;

class FilmModel implements JsonSerializable
{
    private int $filmId;
    private string $title;
    private string $description;
    private string $releaseYear;
    private int $languageId;
    private int $originalLanguageId;
    private int $rentalDuration;
    private float $rentalRate;
    private int $length;
    private float $replacementCost;
    private string $rating;
    private string $specialFeatures;
    private string $lastUpdate;

    public function __construct(FilmDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->filmId = $dto->filmId;
        $this->title = $dto->title;
        $this->description = $dto->description;
        $this->releaseYear = $dto->releaseYear;
        $this->languageId = $dto->languageId;
        $this->originalLanguageId = $dto->originalLanguageId;
        $this->rentalDuration = $dto->rentalDuration;
        $this->rentalRate = $dto->rentalRate;
        $this->length = $dto->length;
        $this->replacementCost = $dto->replacementCost;
        $this->rating = $dto->rating;
        $this->specialFeatures = $dto->specialFeatures;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getFilmId(): int
    {
        return $this->filmId;
    }

    public function setFilmId(int $filmId): void
    {
        $this->filmId = $filmId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getReleaseYear(): string
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(string $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getOriginalLanguageId(): int
    {
        return $this->originalLanguageId;
    }

    public function setOriginalLanguageId(int $originalLanguageId): void
    {
        $this->originalLanguageId = $originalLanguageId;
    }

    public function getRentalDuration(): int
    {
        return $this->rentalDuration;
    }

    public function setRentalDuration(int $rentalDuration): void
    {
        $this->rentalDuration = $rentalDuration;
    }

    public function getRentalRate(): float
    {
        return $this->rentalRate;
    }

    public function setRentalRate(float $rentalRate): void
    {
        $this->rentalRate = $rentalRate;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getReplacementCost(): float
    {
        return $this->replacementCost;
    }

    public function setReplacementCost(float $replacementCost): void
    {
        $this->replacementCost = $replacementCost;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function setRating(string $rating): void
    {
        $this->rating = $rating;
    }

    public function getSpecialFeatures(): string
    {
        return $this->specialFeatures;
    }

    public function setSpecialFeatures(string $specialFeatures): void
    {
        $this->specialFeatures = $specialFeatures;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): FilmDto
    {
        $dto = new FilmDto();
        $dto->filmId = (int) ($this->filmId ?? 0);
        $dto->title = $this->title ?? "";
        $dto->description = $this->description ?? "";
        $dto->releaseYear = $this->releaseYear ?? "";
        $dto->languageId = (int) ($this->languageId ?? 0);
        $dto->originalLanguageId = (int) ($this->originalLanguageId ?? 0);
        $dto->rentalDuration = (int) ($this->rentalDuration ?? 0);
        $dto->rentalRate = (float) ($this->rentalRate ?? 0);
        $dto->length = (int) ($this->length ?? 0);
        $dto->replacementCost = (float) ($this->replacementCost ?? 0);
        $dto->rating = $this->rating ?? "";
        $dto->specialFeatures = $this->specialFeatures ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "film_id" => $this->filmId,
            "title" => $this->title,
            "description" => $this->description,
            "release_year" => $this->releaseYear,
            "language_id" => $this->languageId,
            "original_language_id" => $this->originalLanguageId,
            "rental_duration" => $this->rentalDuration,
            "rental_rate" => $this->rentalRate,
            "length" => $this->length,
            "replacement_cost" => $this->replacementCost,
            "rating" => $this->rating,
            "special_features" => $this->specialFeatures,
            "last_update" => $this->lastUpdate,
        ];
    }
}