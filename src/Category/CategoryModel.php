<?php

declare(strict_types=1);

namespace Sakila\Category;

use JsonSerializable;

class CategoryModel implements JsonSerializable
{
    private int $categoryId;
    private string $name;
    private string $lastUpdate;

    public function __construct(CategoryDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->categoryId = $dto->categoryId;
        $this->name = $dto->name;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastUpdate(): string
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function toDto(): CategoryDto
    {
        $dto = new CategoryDto();
        $dto->categoryId = (int) ($this->categoryId ?? 0);
        $dto->name = $this->name ?? "";
        $dto->lastUpdate = $this->lastUpdate ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "category_id" => $this->categoryId,
            "name" => $this->name,
            "last_update" => $this->lastUpdate,
        ];
    }
}