<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\FindContentByIdTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;

class FindContentByIdAction extends Action implements FindContentByIdActionInterface
{
    public function __construct(
        private FindContentByIdTaskInterface $findContentByIdTask
    )
    {
    }

    public function run(int $id): ContentDto
    {
        $content = $this->findContentByIdTask->run($id);
        $values  = [];

        $content->getValues()
            ->each(function (ContentValueDto $contentValueDto) use (&$values) {
                $values[$contentValueDto->getLanguageId()][$contentValueDto->getPageFieldId()] = $contentValueDto;
            });

        return $content->setValues($values);
    }
}
