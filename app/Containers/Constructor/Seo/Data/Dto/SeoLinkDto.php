<?php

namespace App\Containers\Constructor\Seo\Data\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class SeoLinkDto extends Mapper
{
    private ?int    $id        = null;
    private ?int    $seoId     = null;
    private ?int    $contentId = null;
    private ?string $link      = null;
    private ?SeoDto $seo       = null;
    private ?Carbon $createAt  = null;
    private ?Carbon $updateAt  = null;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setSeoId(?int $seoId): self
    {
        $this->seoId = $seoId;

        return $this;
    }

    public function getSeoId(): ?int
    {
        return $this->seoId ?? null;
    }

    public function setContentId(?int $contentId): self
    {
        $this->contentId = $contentId;

        return $this;
    }

    public function getContentId(): ?int
    {
        return $this->contentId ?? null;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link ?? null;
    }

    public function setSeo(?SeoDto $seo): self
    {
        $this->seo = $seo;

        return $this;
    }

    public function getSeo(): ?SeoDto
    {
        return $this->seo ?? null;
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