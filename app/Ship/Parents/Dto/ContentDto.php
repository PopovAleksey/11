<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PopovAleksey\Mapper\Mapper;

final class ContentDto extends Mapper
{
    private ?int  $id                = null;
    private ?int  $page_id           = null;
    private ?int  $parent_content_id = null;
    private ?bool $active            = null;
    /**
     * \App\Ship\Parents\Dto\ContentValueDto[]
     * @var Collection|null
     */
    private ?Collection $values = null;
    /**
     * \App\Ship\Parents\Dto\ContentDto[]
     * @var Collection|null
     */
    private ?Collection $child_content = null;
    private ?PageDto    $page          = null;
    private ?Carbon     $createAt      = null;
    private ?Carbon     $updateAt      = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
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
     * @return int|null
     */
    public function getParentContentId(): ?int
    {
        return $this->parent_content_id;
    }

    /**
     * @param int|null $parent_content_id
     * @return $this
     */
    public function setParentContentId(?int $parent_content_id): self
    {
        $this->parent_content_id = $parent_content_id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageId(): ?int
    {
        return $this->page_id;
    }

    /**
     * @param int|null $page_id
     * @return $this
     */
    public function setPageId(?int $page_id): self
    {
        $this->page_id = $page_id;

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
     * \App\Ship\Parents\Dto\ContentValueDto[]
     * @return Collection
     */
    public function getValues(): Collection
    {
        return $this->values ?? collect();
    }

    /**
     * @param array|Collection $values
     * @return $this
     */
    public function setValues(array|Collection $values): self
    {
        $this->values = collect($values);

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getChildContent(): ?Collection
    {
        return $this->child_content ?? collect();
    }

    /**
     * @param array|\Illuminate\Support\Collection $child_content
     * @return $this
     */
    public function setChildContent(array|Collection $child_content): self
    {
        $this->child_content = collect($child_content);

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    public function getPage(): ?PageDto
    {
        return $this->page;
    }

    /**
     * @param \App\Ship\Parents\Dto\PageDto|null $page
     * @return $this
     */
    public function setPage(?PageDto $page): self
    {
        $this->page = $page;

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