<?php

namespace App\Containers\ConstructorSection\Site\DTO;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class SiteDTO extends Mapper
{
    private ?int    $id         = null;
    private ?string $name       = null;
    private ?string $domain     = null;
    private bool    $active     = true;
    private ?Carbon $created_at = null;
    private ?Carbon $updated_at = null;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain ?? null;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at ?? null;
    }

    public function setCreatedAt(?Carbon $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at ?? null;
    }

    public function setUpdatedAt(?Carbon $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    
    
}