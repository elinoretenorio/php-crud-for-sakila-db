<?php

declare(strict_types=1);

namespace Sakila\FilmText;

use JsonSerializable;

class FilmTextModel implements JsonSerializable
{
    private int $filmId;
    private string $title;
    private string $description;

    public function __construct(FilmTextDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->filmId = $dto->filmId;
        $this->title = $dto->title;
        $this->description = $dto->description;
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

    public function toDto(): FilmTextDto
    {
        $dto = new FilmTextDto();
        $dto->filmId = (int) ($this->filmId ?? 0);
        $dto->title = $this->title ?? "";
        $dto->description = $this->description ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "film_id" => $this->filmId,
            "title" => $this->title,
            "description" => $this->description,
        ];
    }
}