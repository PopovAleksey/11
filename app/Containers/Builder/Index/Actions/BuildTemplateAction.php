<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\Builder\BuildTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindWidgetsTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Support\Collection;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private FindLanguagesTaskInterface $languageTask,
        private FindContentsTaskInterface  $contentTask,
        private FindTemplatesTaskInterface $templateTask,
        private BuildTaskInterface         $buildTask,
        private FindMenuItemsTaskInterface $menuItemsTask,
        private FindWidgetsTaskInterface   $widgetsTask
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
        $languageDto = $this->languageTask->run($language);
        $contentDto  = $this->contentTask->run($languageDto->getId(), $seoLink)->setLink($seoLink);
        $themeDto    = $this->templateTask->run($languageDto->getId(), $contentDto->getPageId());

        $menuIds   = $this->findIds($themeDto, TemplateInterface::MENU_TYPE);
        $widgetIds = $this->findIds($themeDto, TemplateInterface::WIDGET_TYPE);

        $menuList   = $this->menuItemsTask->run($languageDto->getId(), $themeDto->getId(), $menuIds);
        $widgetList = $this->widgetsTask->run($languageDto->getId(), $widgetIds);

        return $this->buildTask->run($themeDto, $contentDto, $menuList, $widgetList);
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $themeDto
     * @param string                         $findOf
     * @return \Illuminate\Support\Collection
     */
    private function findIds(ThemeDto $themeDto, string $findOf): Collection
    {
        $baseHtml = $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)->getCommonHtml() ?? '';
        $pageHtml = $themeDto->getTemplates()?->get(TemplateInterface::PAGE_TYPE)->getCommonHtml() ?? '';
        $menuHtml = $themeDto->getTemplates()?->get(TemplateInterface::MENU_TYPE)
            ->map(fn(TemplateDto $templateDto) => $templateDto->getCommonHtml() ?? '')->implode('');

        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $baseHtml, $baseResult);
        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $pageHtml, $pageResult);
        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $menuHtml, $menuResult);

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
}
