<?php

namespace App\Containers\Dashboard\Content\Data\Dto;

use PopovAleksey\Mapper\Mapper;

class ContentDto extends Mapper
{
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}