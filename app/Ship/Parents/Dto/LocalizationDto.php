<?php

namespace App\Ship\Parents\Dto;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PopovAleksey\Mapper\Mapper;

final class LocalizationDto extends Mapper
{
    private ?int    $id    = null;
    private ?string $point = null;
    private ?string $html  = null;
    /**
     * \App\Ship\Parents\Dto\LocalizationValueDto[]
     * @var Collection|null
     */
    private ?Collection $values       = null;
    private ?string     $defaultValue = null;
    private ?int        $theme_id     = null;
    private ?ThemeDto   $theme        = null;
    private ?Carbon     $createAt     = null;
    private ?Carbon     $updateAt     = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return LocalizationDto
     */
    public function setId(?int $id): LocalizationDto
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPoint(): ?string
    {
        return $this->point;
    }

    /**
     * @param string|null $point
     * @return LocalizationDto
     */
    public function setPoint(?string $point): LocalizationDto
    {
        $this->point = $point;

        return $this;
    }

    /**
     * @param string|null $html
     * @return LocalizationDto
     */
    public function setHtml(?string $html): LocalizationDto
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHtml(): ?string
    {
        return $this->html;
    }

    
    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getValues(): ?Collection
    {
        return $this->values;
    }

    /**
     * @param \Illuminate\Support\Collection|null $values
     * @return LocalizationDto
     */
    public function setValues(?Collection $values): LocalizationDto
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @param string|null $defaultValue
     * @return LocalizationDto
     */
    public function setDefaultValue(?string $defaultValue): LocalizationDto
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getThemeId(): ?int
    {
        return $this->theme_id;
    }

    /**
     * @param int|null $theme_id
     * @return LocalizationDto
     */
    public function setThemeId(?int $theme_id): LocalizationDto
    {
        $this->theme_id = $theme_id;

        return $this;
    }

    /**
     * @return \App\Ship\Parents\Dto\ThemeDto|null
     */
    public function getTheme(): ?ThemeDto
    {
        return $this->theme;
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto|null $theme
     * @return LocalizationDto
     */
    public function setTheme(?ThemeDto $theme): LocalizationDto
    {
        $this->theme = $theme;

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
     * @param \Illuminate\Support\Carbon|null $createAt
     * @return LocalizationDto
     */
    public function setCreateAt(?Carbon $createAt): LocalizationDto
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Carbon|null
     */
    public function getUpdateAt(): ?Carbon
    {
        return $this->updateAt;
    }

    /**
     * @param \Illuminate\Support\Carbon|null $updateAt
     * @return LocalizationDto
     */
    public function setUpdateAt(?Carbon $updateAt): LocalizationDto
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}