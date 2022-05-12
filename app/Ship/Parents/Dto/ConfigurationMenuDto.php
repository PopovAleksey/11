<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PopovAleksey\Mapper\Mapper;

final class ConfigurationMenuDto extends Mapper
{
    private ?int    $id          = null;
    private ?string $name        = null;
    private ?bool   $active      = null;
    private ?int    $template_id = null;
    /**
     * @var \App\Ship\Parents\Dto\TemplateDto|null
     */
    private ?TemplateDto $template = null;
    /**
     * \App\Ship\Parents\Dto\ConfigurationMenuItemDto[]
     * @var \Illuminate\Support\Collection|null
     */
    private ?Collection $items    = null;
    private ?Carbon     $createAt = null;
    private ?Carbon     $updateAt = null;

    /**
     * @return \App\Ship\Parents\Dto\TemplateDto|null
     */
    public function getTemplate(): ?TemplateDto
    {
        return $this->template;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto|null $template
     * @return $this
     */
    public function setTemplate(?TemplateDto $template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
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
     * @return int|null
     */
    public function getTemplateId(): ?int
    {
        return $this->template_id;
    }

    /**
     * @param int|null $template_id
     * @return $this
     */
    public function setTemplateId(?int $template_id): self
    {
        $this->template_id = $template_id;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getItems(): ?Collection
    {
        return $this->items;
    }

    /**
     * @param \Illuminate\Support\Collection|null $items
     * @return $this
     */
    public function setItems(?Collection $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
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