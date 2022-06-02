<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\Builder\BuildTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindWidgetsTaskInterface;
use App\Ship\Parents\Actions\Action;
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

        $baseHtml  = $themeDto->getTemplates()?->get(TemplateInterface::BASE_TYPE)->getCommonHtml() ?? '';
        $menuIds   = $this->findIds($baseHtml, TemplateInterface::MENU_TYPE);
        $widgetIds = $this->findIds($baseHtml, TemplateInterface::WIDGET_TYPE);

        $menuList   = $this->menuItemsTask->run($languageDto->getId(), $themeDto->getId(), $menuIds);
        $widgetList = $this->widgetsTask->run($languageDto->getId(), $widgetIds);

        return $this->buildTask->run($themeDto, $contentDto, $menuList, $widgetList);
    }

    /**
     * @param string $baseHtml
     * @param string $findOf
     * @return \Illuminate\Support\Collection
     */
    private function findIds(string $baseHtml, string $findOf): Collection
    {
        preg_match_all("{" . strtoupper($findOf) . "_(\d+)}", $baseHtml, $result);

        return collect(data_get($result, 1))->unique()->map(fn($id) => (int) $id)->values();
    }
}
