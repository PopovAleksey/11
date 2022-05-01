<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\FindContentTaskInterface;
use App\Containers\Builder\Index\Tasks\FindLanguageTaskInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private FindLanguageTaskInterface $languageTask,
        private FindContentTaskInterface  $contentTask
    )
    {
    }

    /**
     * @param string|null $language
     * @param string|null $seoLink
     * @return string
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(?string $language = null, ?string $seoLink = null): string
    {
        $languageDto = $this->languageTask->run($language);
        $contentDto  = $this->contentTask->run($seoLink);

        if ($contentDto->getValues()?->first()->getLanguageId() !== $languageDto->getId()) {
            throw new NotFoundException();
        }

        dump($languageDto, $contentDto);

        return '<html lang="' . strtolower($languageDto->getShortName()) . '"></html>';
    }
}
