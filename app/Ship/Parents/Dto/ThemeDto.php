<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class ThemeDto extends Mapper
{
    private ?int    $id     = null;
    private ?string $name   = null;
    private ?bool   $active = null;
    /**
     * @var \App\Ship\Parents\Dto\TemplateDto[]
     */
    private array   $templates = [];
    private ?Carbon $createAt  = null;
    private ?Carbon $updateAt  = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return $this
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     * @return $this
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\TemplateDto[]
     */
    public function getTemplates(): array
    {
        return $this->templates;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto[] $templates
     */
    public function setTemplates(array $templates): self
    {
        $this->templates = $templates;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreateAt(): ?Carbon
    {
        return $this->createAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $createAt
     * @return $this
     */
    public function setCreateAt(?Carbon $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $updateAt
     * @return $this
     */
    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }


}