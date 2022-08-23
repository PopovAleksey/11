<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Common;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Dto\ConfigurationMultiLanguageDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllCommonConfigurationTask extends Task implements GetAllCommonConfigurationTaskInterface
{
    public function __construct(
        private readonly ConfigurationCommonRepositoryInterface $configurationCommonRepository,
        private readonly LanguageRepositoryInterface            $languageRepository,
        private readonly ContentRepositoryInterface             $contentRepository,
        private readonly ContentValueRepositoryInterface        $contentValueRepository,
        private readonly ThemeRepositoryInterface               $themeRepository
    )
    {
    }

    /**
     * @return \App\Ship\Parents\Dto\ConfigurationCommonDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(): ConfigurationCommonDto
    {
        $configurationDto = (new ConfigurationCommonDto())
            ->setLanguageList($this->getLanguageList())
            ->setContentList($this->getContentList())
            ->setThemeList($this->getThemeList());

        $configMultiLanguageList = collect();

        $this->configurationCommonRepository
            ->all()->collect()
            ->each(function (ConfigurationCommonInterface $configuration) use ($configurationDto, &$configMultiLanguageList) {
                if ($this->isCorrectConfig($configuration->config)) {
                    $configMultiLanguageDto = (new ConfigurationMultiLanguageDto())
                        ->setConfig($configuration->config)
                        ->setLanguageId($configuration->language_id)
                        ->setValue($configuration->value);

                    $configMultiLanguageList->push($configMultiLanguageDto);

                    return;
                }

                match ($configuration->config) {
                    ConfigurationCommonInterface::DEFAULT_LANGUAGE => $configurationDto->setDefaultLanguageId((int) $configuration->value),
                    ConfigurationCommonInterface::DEFAULT_INDEX => $configurationDto->setDefaultIndexContentId((int) $configuration->value),
                    ConfigurationCommonInterface::DEFAULT_THEME => $configurationDto->setDefaultThemeId((int) $configuration->value),
                };
            });

        return $configurationDto->setMultiLanguage($configMultiLanguageList);
    }

    private function getLanguageList(): Collection
    {
        return $this->languageRepository
            ->findByField('active', true)->collect()
            ->map(static function (LanguageInterface $language) {
                return (new LanguageDto())
                    ->setId($language->id)
                    ->setName($language->name)
                    ->setShortName($language->short_name)
                    ->setIsActive($language->active)
                    ->setCreateAt($language->created_at)
                    ->setUpdateAt($language->updated_at);
            });
    }

    /**
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    private function getContentList(): Collection
    {
        $contentList = $this->contentRepository->findByField('active', true)->keyBy('id');
        /**
         * @var \App\Ship\Parents\Models\LanguageInterface|null $firstLanguage
         */
        $firstLanguage = $this->languageRepository->first();

        if ($firstLanguage === null) {
            throw new NotFoundException('Not found any language! Create one or more languages');
        }

        return $this->contentValueRepository
            ->findByField('language_id', $firstLanguage->id)
            ->filter(fn(ContentValueInterface $value) => $contentList->get($value->content_id) !== null)
            ->groupBy('content_id')
            ->map(static function (Collection $values) {
                /**
                 * @var \App\Ship\Parents\Models\ContentValueInterface $value
                 */
                $value = $values->first();

                return (new ContentValueDto())
                    ->setId($value->id)
                    ->setContentId($value->content_id)
                    ->setLanguageId($value->language_id)
                    ->setPageFieldId($value->page_field_id)
                    ->setValue($value->value)
                    ->setCreateAt($value->created_at)
                    ->setUpdateAt($value->updated_at);
            })
            ->values();
    }

    private function getThemeList(): Collection
    {
        return $this->themeRepository
            ->findByField('active', true)->collect()
            ->map(static function (ThemeInterface $theme) {
                return (new ThemeDto())
                    ->setId($theme->id)
                    ->setName($theme->name)
                    ->setActive($theme->active)
                    ->setDirectory($theme->directory)
                    ->setCreateAt($theme->created_at)
                    ->setUpdateAt($theme->updated_at);
            });
    }

    private function isCorrectConfig(string $config): bool
    {
        return collect([
                ConfigurationCommonInterface::TITLE,
                ConfigurationCommonInterface::DESCRIPTION,
                ConfigurationCommonInterface::TITLE_SEPARATOR,
                ConfigurationCommonInterface::META_CHARSET,
                ConfigurationCommonInterface::META_DESCRIPTION,
                ConfigurationCommonInterface::META_KEYWORDS,
                ConfigurationCommonInterface::META_AUTHOR,
            ])->search($config) !== false;
    }
}
