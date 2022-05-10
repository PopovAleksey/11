<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Collection;
use PopovAleksey\Mapper\Mapper;

final class ConfigurationCommonDto extends Mapper
{
    private ?Collection $languageList          = null;
    private ?int        $defaultLanguageId     = null;
    private ?Collection $contentList           = null;
    private ?int        $defaultIndexContentId = null;
    private ?Collection $themeList             = null;
    private ?int        $defaultThemeId        = null;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getLanguageList(): Collection
    {
        return $this->languageList ?? collect();
    }

    /**
     * @param \Illuminate\Support\Collection|null $languageList
     * @return $this
     */
    public function setLanguageList(?Collection $languageList): self
    {
        $this->languageList = $languageList;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getContentList(): Collection
    {
        return $this->contentList ?? collect();
    }

    /**
     * @param \Illuminate\Support\Collection|null $contentList
     * @return $this
     */
    public function setContentList(?Collection $contentList): self
    {
        $this->contentList = $contentList;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultLanguageId(): ?int
    {
        return $this->defaultLanguageId;
    }

    /**
     * @param int|null $defaultLanguageId
     * @return $this
     */
    public function setDefaultLanguageId(?int $defaultLanguageId): self
    {
        $this->defaultLanguageId = $defaultLanguageId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultIndexContentId(): ?int
    {
        return $this->defaultIndexContentId;
    }

    /**
     * @param int|null $defaultIndexContentId
     * @return $this
     */
    public function setDefaultIndexContentId(?int $defaultIndexContentId): self
    {
        $this->defaultIndexContentId = $defaultIndexContentId;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getThemeList(): ?Collection
    {
        return $this->themeList;
    }

    /**
     * @param \Illuminate\Support\Collection|null $themeList
     * @return $this
     */
    public function setThemeList(?Collection $themeList): self
    {
        $this->themeList = $themeList;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefaultThemeId(): ?int
    {
        return $this->defaultThemeId;
    }

    /**
     * @param int|null $defaultThemeId
     * @return $this
     */
    public function setDefaultThemeId(?int $defaultThemeId): self
    {
        $this->defaultThemeId = $defaultThemeId;

        return $this;
    }


}