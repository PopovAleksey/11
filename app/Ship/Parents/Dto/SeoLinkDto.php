<?php

namespace App\Ship\Parents\Dto;

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
     * @param int|null $seoId
     * @return $this
     */
    public function setSeoId(?int $seoId): self
    {
        $this->seoId = $seoId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSeoId(): ?int
    {
        return $this->seoId ?? null;
    }

    /**
     * @param int|null $contentId
     * @return $this
     */
    public function setContentId(?int $contentId): self
    {
        $this->contentId = $contentId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getContentId(): ?int
    {
        return $this->contentId ?? null;
    }

    /**
     * @param string|null $link
     * @return $this
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link ?? null;
    }

    /**
     * @param \App\Ship\Parents\Dto\SeoDto|null $seo
     * @return $this
     */
    public function setSeo(?SeoDto $seo): self
    {
        $this->seo = $seo;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\SeoDto|null
     */
    public function getSeo(): ?SeoDto
    {
        return $this->seo ?? null;
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