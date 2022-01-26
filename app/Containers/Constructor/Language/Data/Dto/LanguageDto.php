<?php

namespace App\Containers\Constructor\Language\Data\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class LanguageDto extends Mapper
{
    private ?int    $id        = NULL;
    private ?string $name      = NULL;
    private ?string $shortName = NULL;
    private ?bool   $isActive  = NULL;
    private ?Carbon $createAt  = NULL;
    private ?Carbon $updateAt  = NULL;

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id ?? NULL;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name ?? NULL;
    }

    public function setShortName(?string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName ?? NULL;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive ?? true;
    }

    public function setCreateAt(?Carbon $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getCreateAt(): ?Carbon
    {
        return $this->createAt ?? NULL;
    }

    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt ?? NULL;
    }

    
}