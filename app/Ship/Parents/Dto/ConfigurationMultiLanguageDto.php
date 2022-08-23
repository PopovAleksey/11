<?php

namespace App\Ship\Parents\Dto;

use PopovAleksey\Mapper\Mapper;

final class ConfigurationMultiLanguageDto extends Mapper
{
    private ?int $languageId = null;

    private ?string $config = null;
    private ?string $value  = null;

    /**
     * @return int|null
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int|null $languageId
     * @return ConfigurationMultiLanguageDto
     */
    public function setLanguageId(?int $languageId): ConfigurationMultiLanguageDto
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getConfig(): ?string
    {
        return $this->config;
    }

    /**
     * @param string|null $config
     * @return ConfigurationMultiLanguageDto
     */
    public function setConfig(?string $config): ConfigurationMultiLanguageDto
    {
        $this->config = $config;

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
     * @param string|null $value
     * @return ConfigurationMultiLanguageDto
     */
    public function setValue(?string $value): ConfigurationMultiLanguageDto
    {
        $this->value = $value;

        return $this;
    }
}