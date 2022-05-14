<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Containers\Dashboard\Configuration\Data\Dto\ConfigurationDto;
use App\Containers\Dashboard\Configuration\Data\Repositories\ConfigurationRepositoryInterface;
use App\Containers\Dashboard\Configuration\Models\ConfigurationInterface;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuTemplateTask extends Task implements GetAllMenuTemplateTaskInterface
{
    public function __construct(
        private TemplateRepositoryInterface $templateRepository,
        private ThemeRepositoryInterface    $themeRepository,
        private LanguageRepositoryInterface $languageRepository
    )
    {
    }

    public function run(): Collection
    {
        $menuTemplates = $this->templateRepository
            ->findByField('type', TemplateInterface::MENU_TYPE)
            ->collect();

        $themeIds = $menuTemplates->keyBy('theme_id')->keys()->toArray();
        $themes   = $this->themeList($themeIds);

        $languageIds = $menuTemplates->keyBy('language_id')->keys()->toArray();
        $languages   = $this->languageList($languageIds);

        return $menuTemplates->keyBy('id')->map(static function (TemplateInterface $template) use ($themes, $languages) {
            $themeDto    = $themes->get($template->theme_id);
            $languageDto = $languages->get($template->language_id);

            return (new TemplateDto())
                ->setId($template->id)
                ->setName($template->name)
                ->setThemeId($template->theme_id)
                ->setTheme($themeDto)
                ->setLanguageId($template->language_id)
                ->setLanguage($languageDto);
        });
    }

    private function themeList(array $themeIds): Collection
    {
        return $this->themeRepository
            ->findWhereIn('id', $themeIds)
            ->collect()
            ->keyBy('id')
            ->map(static function (ThemeInterface $theme) {
                return (new ThemeDto())
                    ->setId($theme->id)
                    ->setName($theme->name)
                    ->setActive($theme->active);
            });
    }

    private function languageList(array $languageIds): Collection
    {
        return $this->languageRepository
            ->findWhereIn('id', $languageIds)
            ->collect()
            ->keyBy('id')
            ->map(static function (LanguageInterface $language) {
                return (new LanguageDto())
                    ->setId($language->id)
                    ->setName($language->name)
                    ->setShortName($language->short_name)
                    ->setIsActive($language->active);
            });
    }
}
