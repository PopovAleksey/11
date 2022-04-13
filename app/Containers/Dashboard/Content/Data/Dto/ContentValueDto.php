<?php

namespace App\Containers\Dashboard\Content\Data\Dto;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class ContentValueDto extends Mapper
{
    private ?int          $id            = null;
    private ?int          $language_id   = null;
    private ?int          $content_id    = null;
    private ?int          $page_field_id = null;
    private ?string       $value         = null;
    private ?ContentDto   $content       = null;
    private ?LanguageDto  $language      = null;
    private ?PageFieldDto $page_field    = null;
    private ?Carbon       $createAt      = null;
    private ?Carbon       $updateAt      = null;

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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
     */
    public function setLanguageId(?int $language_id): self
    {
        $this->language_id = $language_id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getContentId(): ?int
    {
        return $this->content_id;
    }

    /**
     * @param int|null $content_id
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
     */
    public function setContentId(?int $content_id): self
    {
        $this->content_id = $content_id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageFieldId(): ?int
    {
        return $this->page_field_id;
    }

    /**
     * @param int|null $page_field_id
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
     */
    public function setPageFieldId(?int $page_field_id): self
    {
        $this->page_field_id = $page_field_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentDto|null
     */
    public function getContent(): ?ContentDto
    {
        return $this->content;
    }

    /**
     * @param \App\Containers\Dashboard\Content\Data\Dto\ContentDto|null $content
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
     */
    public function setContent(?ContentDto $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \App\Containers\Constructor\Language\Data\Dto\LanguageDto|null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @param \App\Containers\Constructor\Language\Data\Dto\LanguageDto|null $language
     */
    public function setLanguage(?LanguageDto $language): void
    {
        $this->language = $language;
    }

    /**
     * @return \App\Containers\Constructor\Page\Data\Dto\PageFieldDto|null
     */
    public function getPageField(): ?PageFieldDto
    {
        return $this->page_field;
    }

    /**
     * @param \App\Containers\Constructor\Page\Data\Dto\PageFieldDto|null $page_field
     */
    public function setPageField(?PageFieldDto $page_field): void
    {
        $this->page_field = $page_field;
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
     * @return \App\Containers\Dashboard\Content\Data\Dto\ContentValueDto
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