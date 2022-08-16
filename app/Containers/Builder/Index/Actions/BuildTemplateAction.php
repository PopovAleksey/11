<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\Builder\BuildTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
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
        private readonly FindLanguagesTaskInterface $languageTask,
        private readonly FindContentsTaskInterface  $contentTask,
        private readonly FindTemplatesTaskInterface $templateTask,
        private readonly BuildTaskInterface         $buildTask,
        private readonly FindMenuItemsTaskInterface $menuItemsTask,
        private readonly FindWidgetsTaskInterface   $widgetsTask,
        private readonly CacheActionInterface       $cacheAction
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

            return $this->buildTask->run($themeDto, $contentDto, $menuList, $widgetList);
        });
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @param string                         $findOf
     * @return \Illuminate\Support\Collection
     */
    private function findIds(ThemeDto $themeDto, string $findOf): Collection
    {
        $makeupHtml = $this->getThemeHtml($themeDto);

        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $makeupHtml->get(TemplateInterface::BASE_TYPE), $baseResult);
        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $makeupHtml->get(TemplateInterface::PAGE_TYPE)->common, $pageResult);
        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $makeupHtml->get(TemplateInterface::MENU_TYPE), $menuResult);

        $baseResult = collect(data_get($baseResult, 1));
        $pageResult = collect(data_get($pageResult, 1));
        $menuResult = collect(data_get($menuResult, 1));

        return $baseResult
            ->merge($pageResult)
            ->merge($menuResult)
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
        $themeHtml  = $this->getThemeHtml($themeDto);
        $pageMakeup = $themeHtml->get(TemplateInterface::PAGE_TYPE)->implode();

        $themeHtml->put(TemplateInterface::PAGE_TYPE, $pageMakeup);

        preg_match_all("/{L=([\w.\s]+)}((.*){L})+/mU", $themeHtml->implode(''), $matchResult, PREG_SET_ORDER);

        return collect($matchResult)
            ->map(static function (array $point) {
                return (new LocalizationDto())
                    ->setPoint(data_get($point, 1))
                    ->setDefaultValue(data_get($point, 3))
                    ->setHtml(data_get($point, 0));
            })
            ->unique(fn(LocalizationDto $point) => $point->getPoint());
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @return \Illuminate\Support\Collection
     */
    private function getThemeHtml(ThemeDto $themeDto): Collection
    {
        $baseHtml = $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)?->getCommonHtml() ?? '';
        $menuHtml = $themeDto->getTemplates()?->get(TemplateInterface::MENU_TYPE)
            ?->map(fn(TemplateDto $templateDto) => $templateDto->getCommonHtml() ?? '')->implode('');

        /**
         * @var TemplateDto|null $pageTemplateDto
         */
        $pageTemplateDto = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE);

        return collect([
            TemplateInterface::BASE_TYPE => $baseHtml,
            TemplateInterface::MENU_TYPE => $menuHtml,
            TemplateInterface::PAGE_TYPE => new class($pageTemplateDto) {
                readonly public string $common;
                readonly public string $preview;
                readonly public string $element;

                public function __construct(TemplateDto $pageTemplateDto)
                {
                    $this->common  = $pageTemplateDto->getCommonHtml() ?? '';
                    $this->preview = $pageTemplateDto->getPreviewHtml() ?? '';
                    $this->element = $pageTemplateDto->getElementHtml() ?? '';
                }

                public function implode(): string
                {
                    return implode([
                        $this->common,
                        $this->preview,
                        $this->element,
                    ]);
                }
            },
        ]);
    }
}
