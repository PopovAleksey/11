<?php

namespace App\Containers\Dashboard\Content\Data\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class ContentDto extends Mapper
{
    private ?int    $id          = null;
    private ?int    $language_id = null;
    private ?int    $page_id     = null;
    private ?bool   $active      = null;
    private array   $values      = [];
    private ?Carbon $createAt    = null;
    private ?Carbon $updateAt    = null;

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
    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    /**
     * @param int|null $language_id
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     */
    public function setLanguageId(?int $language_id): self
    {
        $this->language_id = $language_id;

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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     */
    public function setPageId(?int $page_id): self
    {
        $this->page_id = $page_id;

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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     */
    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array $values
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     */
    public function setValues(array $values): self
    {
        $this->values = $values;

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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto
     */
    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }


}