<?php declare(strict_types=1);

namespace App\Containers\Core\Cacher\Data\Dto;

use PopovAleksey\Mapper\Mapper;

final class CacheDto extends Mapper
{
    private ?int    $contentId = null;
    private ?string $language  = null;
    private ?string $seoLink   = null;
    private ?string $data      = null;

    /**
     * @return int|null
     */
    public function getContentId(): ?int
    {
        return $this->contentId;
    }

    /**
     * @param int|null $contentId
     * @return CacheDto
     */
    public function setContentId(?int $contentId): CacheDto
    {
        $this->contentId = $contentId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     * @return CacheDto
     */
    public function setLanguage(?string $language): CacheDto
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSeoLink(): ?string
    {
        return $this->seoLink;
    }

    /**
     * @param string|null $seoLink
     * @return CacheDto
     */
    public function setSeoLink(?string $seoLink): CacheDto
    {
        $this->seoLink = $seoLink;

        return $this;
    }

    /**
     * @param string|null $data
     * @return CacheDto
     */
    public function setData(?string $data): CacheDto
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }
}
