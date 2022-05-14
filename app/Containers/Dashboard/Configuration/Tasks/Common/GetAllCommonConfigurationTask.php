<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Common;

use App\Ship\Parents\Dto\ConfigurationCommonDto;
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
    /**
     * @param \App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface $configurationCommonRepository
     * @param \App\Ship\Parents\Repositories\LanguageRepositoryInterface            $languageRepository
     * @param \App\Ship\Parents\Repositories\ContentRepositoryInterface             $contentRepository
     * @param \App\Ship\Parents\Repositories\ContentValueRepositoryInterface        $contentValueRepository
     * @param \App\Ship\Parents\Repositories\ThemeRepositoryInterface               $themeRepository
     */
    public function __construct(
        private ConfigurationCommonRepositoryInterface $configurationCommonRepository,
        private LanguageRepositoryInterface            $languageRepository,
        private ContentRepositoryInterface             $contentRepository,
        private ContentValueRepositoryInterface        $contentValueRepository,
        private ThemeRepositoryInterface               $themeRepository
    )
    {
    }

    /**
     * @return \App\Ship\Parents\Dto\ConfigurationCommonDto
     */
    public function run(): ConfigurationCommonDto
    {
        $configurationDto = (new ConfigurationCommonDto())
            ->setLanguageList($this->getLanguageList())
            ->setContentList($this->getContentList())
            ->setThemeList($this->getThemeList());

        $this->configurationCommonRepository
            ->all()->collect()
            ->each(static function (ConfigurationCommonInterface $configuration) use ($configurationDto) {
                match ($configuration->config) {
                    ConfigurationCommonInterface::DEFAULT_LANGUAGE => $configurationDto->setDefaultLanguageId((int) $configuration->value),
                    ConfigurationCommonInterface::DEFAULT_INDEX => $configurationDto->setDefaultIndexContentId((int) $configuration->value),
                    ConfigurationCommonInterface::DEFAULT_THEME => $configurationDto->setDefaultThemeId((int) $configuration->value),
                };
            });

        return $configurationDto;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
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
     */
    private function getContentList(): Collection
    {
        $contentList = $this->contentRepository->findByField('active', true)->keyBy('id');

        return $this->contentValueRepository
            ->findByField('language_id', 1)
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

    /**
     * @return \Illuminate\Support\Collection
     */
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
}
