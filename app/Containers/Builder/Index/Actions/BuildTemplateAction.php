<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\BuildPageTaskInterface;
use App\Containers\Builder\Index\Tasks\FindContentsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguagesTaskInterface;
use App\Containers\Builder\Index\Tasks\FindMenuItemsTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Ship\Parents\Actions\Action;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private FindLanguagesTaskInterface $languageTask,
        private FindContentsTaskInterface  $contentTask,
        private FindTemplatesTaskInterface $templateTask,
        private BuildPageTaskInterface     $buildPageTask,
        private FindMenuItemsTaskInterface $menuItemsTask
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
        $contentDto  = $this->contentTask->run($languageDto->getId(), $seoLink);
        $menuList    = $this->menuItemsTask->run($languageDto->getId());
        $themeDto    = $this->templateTask->run($languageDto->getId());

        return $this->buildPageTask->run($themeDto, $contentDto, $menuList);
    }
}
