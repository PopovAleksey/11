<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Requests\Request;

class UpdateCommonConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            ConfigurationCommonInterface::DEFAULT_LANGUAGE => ['required', 'integer'],
            ConfigurationCommonInterface::DEFAULT_INDEX    => ['required', 'integer'],
            ConfigurationCommonInterface::DEFAULT_THEME    => ['required', 'integer'],
        ];
    }

    public function mapped(): ConfigurationCommonDto
    {
        return (new ConfigurationCommonDto())
            ->setDefaultLanguageId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_LANGUAGE))
            ->setDefaultIndexContentId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_INDEX))
            ->setDefaultThemeId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_THEME));
    }
}
