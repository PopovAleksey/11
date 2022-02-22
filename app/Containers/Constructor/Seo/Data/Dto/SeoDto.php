<?php

namespace App\Containers\Constructor\Seo\Data\Dto;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
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

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPageId(): ?int
    {
        return $this->pageId ?? null;
    }

    public function setPageId(?int $pageId): self
    {
        $this->pageId = $pageId;

        return $this;
    }

    public function getPageFieldId(): ?int
    {
        return $this->pageFieldId ?? null;
    }

    public function setPageFieldId(?int $pageFieldId): self
    {
        $this->pageFieldId = $pageFieldId;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->languageId ?? null;
    }

    public function setLanguageId(?int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    public function getCaseType(): ?string
    {
        return $this->caseType ?? null;
    }

    public function setCaseType(?string $caseType): self
    {
        $this->caseType = $caseType;

        return $this;
    }

    public function isStatic(): ?bool
    {
        return $this->static ?? null;
    }

    public function setStatic(?bool $static): self
    {
        $this->static = $static;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active ?? null;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPage(): ?PageDto
    {
        return $this->page;
    }

    public function setPage(?PageDto $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getField(): ?PageFieldDto
    {
        return $this->field;
    }

    public function setField(?PageFieldDto $field): self
    {
        $this->field = $field;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguage(?LanguageDto $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setLinks(array $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getLinks(): array
    {
        return $this->links ?? [];
    }

    public function getCreateAt(): ?Carbon
    {
        return $this->createAt ?? null;
    }

    public function setCreateAt(?Carbon $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt ?? null;
    }

    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }


}