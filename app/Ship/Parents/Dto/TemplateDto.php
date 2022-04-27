<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class TemplateDto extends Mapper
{
    private ?int         $id       = null;
    private ?string      $type     = null;
    private ?ThemeDto    $theme    = null;
    private ?PageDto     $page     = null;
    private ?LanguageDto $language = null;
    private ?string      $html     = null;
    private ?Carbon      $createAt = null;
    private ?Carbon      $updateAt = null;

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
    public function getId(): ?int
    {
        return $this->id ?? null;
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
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type ?? null;
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
     * @return \App\Ship\Parents\Dto\ThemeDto|null
     */
    public function getTheme(): ?ThemeDto
    {
        return $this->theme ?? null;
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
     * @return \App\Ship\Parents\Dto\PageDto|null
     */
    public function getPage(): ?PageDto
    {
        return $this->page ?? null;
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
     * @return \App\Ship\Parents\Dto\LanguageDto|null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language ?? null;
    }

    /**
     * @param string|null $html
     * @return $this
     */
    public function setHtml(?string $html): self
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHtml(): ?string
    {
        return $this->html ?? null;
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
    public function getCreateAt(): ?Carbon
    {
        return $this->createAt ?? null;
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

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt ?? null;
    }


}