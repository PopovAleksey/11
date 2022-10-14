<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\Builder\BuildTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLocalizationTaskInterface;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindWidgetsTaskInterface;
use App\Containers\Core\Cacher\Actions\CacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Support\Collection;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private readonly FindLanguagesTaskInterface    $languageTask,
        private readonly FindContentsTaskInterface     $contentTask,
        private readonly FindTemplatesTaskInterface    $templateTask,
        private readonly BuildTaskInterface            $buildTask,
        private readonly FindMenuItemsTaskInterface    $menuItemsTask,
        private readonly FindWidgetsTaskInterface      $widgetsTask,
        private readonly FindLocalizationTaskInterface $localizationTask,
        private readonly CacheActionInterface          $cacheAction
    )
    {
    }

    /**
     * @param string|null $language
     * @param string|null $seoLink
     * @return string
     */
    public function run(?string $language = null, ?string $seoLink = null): string
    {
        $cacheDto = (new CacheDto())
            ->setLanguage($language)
            ->setSeoLink($seoLink);

        return $this->cacheAction->run($cacheDto, function () use ($language, $seoLink) {
            $languageDto = $this->languageTask->run($language);
            $contentDto  = $this->contentTask->run($languageDto->getId(), $seoLink)->setLink($seoLink);
            $themeDto    = $this->templateTask->run($languageDto->getId(), $contentDto->getPageId());

            $menuIds      = $this->findIds($themeDto, TemplateInterface::MENU_TYPE);
            $widgetIds    = $this->findIds($themeDto, TemplateInterface::WIDGET_TYPE);
            $localePoints = $this->findLocalizationPoints($themeDto);

            $menuList   = $this->menuItemsTask->run($languageDto->getId(), $themeDto->getId(), $menuIds);
            $widgetList = $this->widgetsTask->run($languageDto->getId(), $widgetIds);
            $localeList = $this->localizationTask->run($languageDto->getId(), $themeDto->getId(), $localePoints);

            return $this->buildTask->run($languageDto->getId(), $themeDto, $contentDto, $menuList, $widgetList, $localeList);
        });
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @param string                         $findOf
     * @return \Illuminate\Support\Collection
     */
    private function findIds(ThemeDto $themeDto, string $findOf): Collection
    {
        $makeup = implode([
            $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)?->getCommonHtml(),
            $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getCommonHtml(),
            $themeDto->getTemplates()?->get(TemplateInterface::MENU_TYPE)
                ?->map(fn(TemplateDto $templateDto) => $templateDto->getCommonHtml() ?? '')
                ->implode(''),
        ]);

        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $makeup, $result);

        return collect(data_get($result, 1))
            ->unique()
            ->map(fn($id) => (int) $id)
            ->values();
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @return \Illuminate\Support\Collection
     */
    private function findLocalizationPoints(ThemeDto $themeDto): Collection
    {
        $pageHtml = collect([
            $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getCommonHtml(),
            $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getElementHtml(),
            $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)?->getPreviewHtml(),
        ])?->implode('') ?? '';

        $menusAndWidgetsHtml = $themeDto->getTemplates()
            ?->reject(fn($collect, $key) => !in_array($key, [TemplateInterface::MENU_TYPE, TemplateInterface::WIDGET_TYPE], true))
            ?->collapse()
            ?->map(static function (TemplateDto $templateDto) {
                return collect([
                    $templateDto->getCommonHtml(),
                    $templateDto->getElementHtml(),
                ])->implode('');
            })?->implode('') ?? '';

        $html = collect([
            $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)?->getCommonHtml(),
            $pageHtml,
            $menusAndWidgetsHtml,
        ])->implode('');

        preg_match_all("/{L=([\w.\s]+)}((.*){L})+/mU", $html, $matchResult, PREG_SET_ORDER);

        return collect($matchResult)
            ->map(static function (array $point) {
                return (new LocalizationDto())
                    ->setPoint(data_get($point, 1))
                    ->setDefaultValue(data_get($point, 3))
                    ->setHtml(data_get($point, 0));
            })
            ->unique(fn(LocalizationDto $point) => $point->getPoint());
    }
}
