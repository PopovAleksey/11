<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class SeoDto extends Mapper
{
    private ?int          $id          = null;
    private ?int          $pageId      = null;
    private ?int          $pageFieldId = null;
    private ?int          $languageId  = null;
    private ?string       $caseType    = null;
    private ?bool         $static      = null;
    private ?bool         $active      = null;
    private ?PageDto      $page        = null;
    private ?PageFieldDto $field       = null;
    private ?LanguageDto  $language    = null;
    private array         $links       = [];
    private ?Carbon       $createAt    = null;
    private ?Carbon       $updateAt    = null;

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
    public function getPageId(): ?int
    {
        return $this->pageId ?? null;
    }

    /**
     * @param int|null $pageId
     * @return $this
     */
    public function setPageId(?int $pageId): self
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageFieldId(): ?int
    {
        return $this->pageFieldId ?? null;
    }

    /**
     * @param int|null $pageFieldId
     * @return $this
     */
    public function setPageFieldId(?int $pageFieldId): self
    {
        $this->pageFieldId = $pageFieldId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId ?? null;
    }

    /**
     * @param int|null $languageId
     * @return $this
     */
    public function setLanguageId(?int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCaseType(): ?string
    {
        return $this->caseType ?? null;
    }

    /**
     * @param string|null $caseType
     * @return $this
     */
    public function setCaseType(?string $caseType): self
    {
        $this->caseType = $caseType;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isStatic(): ?bool
    {
        return $this->static ?? null;
    }

    /**
     * @param bool|null $static
     * @return $this
     */
    public function setStatic(?bool $static): self
    {
        $this->static = $static;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active ?? null;
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
     * @return \App\Ship\Parents\Dto\PageFieldDto|null
     */
    public function getField(): ?PageFieldDto
    {
        return $this->field;
    }

    /**
     * @param \App\Ship\Parents\Dto\PageFieldDto|null $field
     * @return $this
     */
    public function setField(?PageFieldDto $field): self
    {
        $this->field = $field;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\LanguageDto|null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @param \App\Ship\Parents\Dto\LanguageDto|null $language
     * @return $this
     */
    public function setLanguage(?LanguageDto $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param array $links
     * @return $this
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links ?? [];
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreateAt(): ?Carbon
    {
        return $this->createAt ?? null;
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
        return $this->updateAt ?? null;
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