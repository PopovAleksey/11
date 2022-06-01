<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class TemplateDto extends Mapper
{
    private ?int               $id               = null;
    private ?string            $name             = null;
    private ?string            $type             = null;
    private ?int               $themeId          = null;
    private ?ThemeDto          $theme            = null;
    private ?int               $pageId           = null;
    private ?int               $childPageId      = null;
    private ?PageDto           $page             = null;
    private ?PageDto           $childPage        = null;
    private ?int               $languageId       = null;
    private ?LanguageDto       $language         = null;
    private ?int               $parentTemplateId = null;
    private ?TemplateDto       $template         = null;
    private ?string            $commonFilepath   = null;
    private ?string            $elementFilepath  = null;
    private ?string            $previewFilepath  = null;
    private ?string            $commonHtml       = null;
    private ?string            $elementHtml      = null;
    private ?string            $previewHtml      = null;
    private ?TemplateWidgetDto $widget           = null;
    private ?Carbon            $createAt         = null;
    private ?Carbon            $updateAt         = null;

    /**
     * @return string|null
     */
    public function getCommonHtml(): ?string
    {
        return $this->commonHtml;
    }

    /**
     * @param string|null $commonHtml
     * @return $this
     */
    public function setCommonHtml(?string $commonHtml): self
    {
        $this->commonHtml = $commonHtml;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getElementHtml(): ?string
    {
        return $this->elementHtml;
    }

    /**
     * @param string|null $elementHtml
     * @return $this
     */
    public function setElementHtml(?string $elementHtml): self
    {
        $this->elementHtml = $elementHtml;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreviewHtml(): ?string
    {
        return $this->previewHtml;
    }

    /**
     * @param string|null $previewHtml
     * @return $this
     */
    public function setPreviewHtml(?string $previewHtml): self
    {
        $this->previewHtml = $previewHtml;

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
    public function getElementFilepath(): ?string
    {
        return $this->elementFilepath;
    }

    /**
     * @param string|null $elementFilepath
     * @return $this
     */
    public function setElementFilepath(?string $elementFilepath): self
    {
        $this->elementFilepath = $elementFilepath;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPreviewFilepath(): ?string
    {
        return $this->previewFilepath;
    }

    /**
     * @param string|null $previewFilepath
     * @return $this
     */
    public function setPreviewFilepath(?string $previewFilepath): self
    {
        $this->previewFilepath = $previewFilepath;

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
     * @return int|null
     */
    public function getParentTemplateId(): ?int
    {
        return $this->parentTemplateId;
    }

    /**
     * @param int|null $parentTemplateId
     * @return TemplateDto
     */
    public function setParentTemplateId(?int $parentTemplateId): TemplateDto
    {
        $this->parentTemplateId = $parentTemplateId;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\TemplateDto|null
     */
    public function getTemplate(): ?TemplateDto
    {
        return $this->template;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto|null $template
     * @return TemplateDto
     */
    public function setTemplate(?TemplateDto $template): TemplateDto
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommonFilepath(): ?string
    {
        return $this->commonFilepath ?? null;
    }

    /**
     * @param string|null $commonFilepath
     * @return $this
     */
    public function setCommonFilepath(?string $commonFilepath): self
    {
        $this->commonFilepath = $commonFilepath;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\TemplateWidgetDto|null
     */
    public function getWidget(): ?TemplateWidgetDto
    {
        return $this->widget;
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateWidgetDto|null $widget
     * @return TemplateDto
     */
    public function setWidget(?TemplateWidgetDto $widget): TemplateDto
    {
        $this->widget = $widget;

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