<?php

declare(strict_types=1);

namespace Sakila\Category;

class CategoryDto 
{
    public int $categoryId;
    public string $name;
    public string $lastUpdate;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->categoryId = (int) ($row["category_id"] ?? 0);
        $this->name = $row["name"] ?? "";
        $this->lastUpdate = $row["last_update"] ?? "";
    }
}