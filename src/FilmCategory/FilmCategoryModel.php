<?php

declare(strict_types=1);

namespace Sakila\FilmCategory;

use JsonSerializable;

class FilmCategoryModel implements JsonSerializable
{
    private int $categoryId;
    private int $filmId;
    private string $lastUpdate;

    public function __construct(FilmCategoryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->categoryId = $dto->categoryId;
        $this->filmId = $dto->filmId;
        $this->lastUpdate = $dto->lastUpdate;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
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

    public function toDto(): FilmCategoryDto
    {
        $dto = new FilmCategoryDto();
        $dto->categoryId = (int) ($this->categoryId ?? 0);
        $dto->filmId = (int) ($this->filmId ?? 0);
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "category_id" => $this->categoryId,
            "film_id" => $this->filmId,
            "last_update" => $this->lastUpdate,
        ];
    }
}