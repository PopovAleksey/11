<?php

namespace App\Containers\Constructor\Template\Data\Dto;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Page\Data\Dto\PageDto;
use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class TemplateDto extends Mapper
{
    private ?int         $id       = null;
    private ?string      $type     = null;
    private ?ThemeDto    $theme    = null;
    private ?PageDto     $page     = null;
    private ?LanguageDto $language = null;
    private ?string      $html     = null;
    private ?Carbon      $createAt = null;
    private ?Carbon      $updateAt = null;

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type ?? null;
    }

    public function setTheme(?ThemeDto $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme(): ?ThemeDto
    {
        return $this->theme ?? null;
    }

    public function setPage(?PageDto $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): ?PageDto
    {
        return $this->page ?? null;
    }

    public function setLanguage(?LanguageDto $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language ?? null;
    }

    public function setHtml(?string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function getHtml(): ?string
    {
        return $this->html ?? null;
    }

    public function setCreateAt(?Carbon $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getCreateAt(): ?Carbon
    {
        return $this->createAt ?? null;
    }

    public function setUpdateAt(?Carbon $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt ?? null;
    }


}