<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\FindLanguageTaskInterface;
use App\Containers\Builder\Index\Tasks\IndexBuilderTaskInterface;
use App\Ship\Parents\Actions\Action;

class BuildTemplateAction extends Action implements BuildTemplateActionInterface
{
    public function __construct(
        private FindLanguageTaskInterface $languageTask,
        private IndexBuilderTaskInterface $getAllIndexTask
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
        $var         = $this->getAllIndexTask->run();

        dump($language, $var);

        return '<html lang="' . strtolower($languageDto->getShortName()) . '"></html>';
    }
}
