<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\FindContentTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguageTaskInterface;
use App\Containers\Builder\Index\Tasks\FindTemplatesTaskInterface;
use App\Ship\Parents\Actions\Action;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private FindLanguageTaskInterface  $languageTask,
        private FindContentTaskInterface   $contentTask,
        private FindTemplatesTaskInterface $templateTask
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
        $themeDto    = $this->templateTask->run($languageDto->getId());

        dump($languageDto, $contentDto, $themeDto);

        return '<html lang="' . strtolower($languageDto->getShortName()) . '"></html>';
    }
}
