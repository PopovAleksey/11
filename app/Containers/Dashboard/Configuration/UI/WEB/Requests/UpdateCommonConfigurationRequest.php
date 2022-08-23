<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Dto\ConfigurationMultiLanguageDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Requests\Request;

class UpdateCommonConfigurationRequest extends Request
{
    public function rules(): array
    {
        return [
            ConfigurationCommonInterface::DEFAULT_LANGUAGE => ['nullable', 'integer'],
            ConfigurationCommonInterface::DEFAULT_INDEX    => ['nullable', 'integer'],
            ConfigurationCommonInterface::DEFAULT_THEME    => ['nullable', 'integer'],

            ConfigurationCommonInterface::TITLE                    => ['nullable', 'array'],
            ConfigurationCommonInterface::TITLE . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::TITLE . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::DESCRIPTION                    => ['nullable', 'array'],
            ConfigurationCommonInterface::DESCRIPTION . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::DESCRIPTION . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::TITLE_SEPARATOR                    => ['nullable', 'array'],
            ConfigurationCommonInterface::TITLE_SEPARATOR . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::TITLE_SEPARATOR . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::META_CHARSET                    => ['nullable', 'array'],
            ConfigurationCommonInterface::META_CHARSET . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::META_CHARSET . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::META_DESCRIPTION                    => ['nullable', 'array'],
            ConfigurationCommonInterface::META_DESCRIPTION . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::META_DESCRIPTION . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::META_KEYWORDS                    => ['nullable', 'array'],
            ConfigurationCommonInterface::META_KEYWORDS . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::META_KEYWORDS . '.*.value'       => ['nullable', 'string'],

            ConfigurationCommonInterface::META_AUTHOR                    => ['nullable', 'array'],
            ConfigurationCommonInterface::META_AUTHOR . '.*.language_id' => ['nullable', 'integer'],
            ConfigurationCommonInterface::META_AUTHOR . '.*.value'       => ['nullable', 'string'],

        ];
    }

    public function mapped(): ConfigurationCommonDto
    {
        $multiLanguageConfig = collect([
            ConfigurationCommonInterface::TITLE,
            ConfigurationCommonInterface::DESCRIPTION,
            ConfigurationCommonInterface::TITLE_SEPARATOR,
            ConfigurationCommonInterface::META_CHARSET,
            ConfigurationCommonInterface::META_DESCRIPTION,
            ConfigurationCommonInterface::META_KEYWORDS,
            ConfigurationCommonInterface::META_AUTHOR,
        ])->map(function (string $config) {

            return collect(data_get($this->validated(), $config))
                ->map(static function (array $inputData) use ($config) {

                    return (new ConfigurationMultiLanguageDto())
                        ->setConfig($config)
                        ->setLanguageId((int) data_get($inputData, 'language_id'))
                        ->setValue(data_get($inputData, 'value'));
                });
        })->collapse();

        return (new ConfigurationCommonDto())
            ->setDefaultLanguageId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_LANGUAGE))
            ->setDefaultIndexContentId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_INDEX))
            ->setDefaultThemeId(data_get($this->validated(), ConfigurationCommonInterface::DEFAULT_THEME))
            ->setMultiLanguage($multiLanguageConfig);
    }
}
