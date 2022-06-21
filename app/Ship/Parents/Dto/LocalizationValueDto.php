<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

final class LocalizationValueDto extends Mapper
{
    private ?int             $id              = null;
    private ?string          $localization_id = null;
    private ?int             $language_id     = null;
    private ?string          $value           = null;
    private ?LocalizationDto $localization    = null;
    private ?LanguageDto     $language        = null;
    private ?Carbon          $createAt        = null;
    private ?Carbon          $updateAt        = null;

    /**
     * @param int|null $id
     * @return LocalizationValueDto
     */
    public function setId(?int $id): LocalizationValueDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string|null $localization_id
     * @return LocalizationValueDto
     */
    public function setLocalizationId(?string $localization_id): LocalizationValueDto
    {
        $this->localization_id = $localization_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocalizationId(): ?string
    {
        return $this->localization_id;
    }

    /**
     * @param int|null $language_id
     * @return LocalizationValueDto
     */
    public function setLanguageId(?int $language_id): LocalizationValueDto
    {
        $this->language_id = $language_id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    /**
     * @param string|null $value
     * @return LocalizationValueDto
     */
    public function setValue(?string $value): LocalizationValueDto
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param \App\Ship\Parents\Dto\LocalizationDto|null $localization
     * @return LocalizationValueDto
     */
    public function setLocalization(?LocalizationDto $localization): LocalizationValueDto
    {
        $this->localization = $localization;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\LocalizationDto|null
     */
    public function getLocalization(): ?LocalizationDto
    {
        return $this->localization;
    }

    /**
     * @param \App\Ship\Parents\Dto\LanguageDto|null $language
     * @return LocalizationValueDto
     */
    public function setLanguage(?LanguageDto $language): LocalizationValueDto
    {
        $this->language = $language;

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
     * @param \Illuminate\Support\Carbon|null $createAt
     * @return LocalizationValueDto
     */
    public function setCreateAt(?Carbon $createAt): LocalizationValueDto
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getCreateAt(): ?Carbon
    {
        return $this->createAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $updateAt
     * @return LocalizationValueDto
     */
    public function setUpdateAt(?Carbon $updateAt): LocalizationValueDto
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt;
    }


}