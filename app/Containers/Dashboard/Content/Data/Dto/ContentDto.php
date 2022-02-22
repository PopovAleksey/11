<?php

namespace App\Containers\Dashboard\Content\Data\Dto;

class ContentDto
{
    private ?int $id = null;

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }
}