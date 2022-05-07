<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class TemplateDto extends Mapper
{
    private ?int         $id                    = null;
    private ?string      $name                  = null;
    private ?string      $type                  = null;
    private ?int         $themeId               = null;
    private ?ThemeDto    $theme                 = null;
    private ?int         $pageId                = null;
    private ?int         $childPageId           = null;
    private ?PageDto     $page                  = null;
    private ?PageDto     $childPage             = null;
    private ?int         $languageId            = null;
    private ?LanguageDto $language              = null;
    private ?string      $templateFilepath      = null;
    private ?string      $childTemplateFilepath = null;
    private ?Carbon      $createAt              = null;
    private ?Carbon      $updateAt              = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getChildPageId(): ?int
    {
        return $this->childPageId;
    }

    /**
     * @param int|null $childPageId
     * @return $this
     */
    public function setChildPageId(?int $childPageId): self
    {
        $this->childPageId = $childPageId;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    public function getChildPage(): ?PageDto
    {
        return $this->childPage;
    }

    /**
     * @param \App\Ship\Parents\Dto\PageDto|null $childPage
     * @return $this
     */
    public function setChildPage(?PageDto $childPage): self
    {
        $this->childPage = $childPage;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChildTemplateFilepath(): ?string
    {
        return $this->childTemplateFilepath;
    }

    /**
     * @param string|null $childTemplateFilepath
     * @return $this
     */
    public function setChildTemplateFilepath(?string $childTemplateFilepath): self
    {
        $this->childTemplateFilepath = $childTemplateFilepath;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getThemeId(): ?int
    {
        return $this->themeId;
    }

    /**
     * @param int|null $themeId
     * @return $this
     */
    public function setThemeId(?int $themeId): self
    {
        $this->themeId = $themeId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageId(): ?int
    {
        return $this->pageId;
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
    public function getLanguageId(): ?int
    {
        return $this->languageId;
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
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type ?? null;
    }

    /**
     * @param string|null $type
     * @return $this
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\ThemeDto|null
     */
    public function getTheme(): ?ThemeDto
    {
        return $this->theme ?? null;
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto|null $theme
     * @return $this
     */
    public function setTheme(?ThemeDto $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    public function getPage(): ?PageDto
    {
        return $this->page ?? null;
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
     * @return \App\Ship\Parents\Dto\LanguageDto|null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language ?? null;
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
     * @return string|null
     */
    public function getTemplateFilepath(): ?string
    {
        return $this->templateFilepath ?? null;
    }

    /**
     * @param string|null $templateFilepath
     * @return $this
     */
    public function setTemplateFilepath(?string $templateFilepath): self
    {
        $this->templateFilepath = $templateFilepath;

        return $this;
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