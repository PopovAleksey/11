<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Page\Tasks\FindFieldByIdTaskInterface;
use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Tasks\CreateSeoTaskInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;

class CreateSeoAction extends Action implements CreateSeoActionInterface
{
    public function __construct(
        private CreateSeoTaskInterface     $createSeoTask,
        private FindFieldByIdTaskInterface $findFieldByIdTask
    )
    {
    }

    /**
     * @param \App\Containers\Constructor\Seo\Data\Dto\SeoDto $data
     * @return int
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(SeoDto $data): int
    {
        $pageField = $this->findFieldByIdTask->run($data->getPageFieldId());
        $pageId    = $pageField->getPageId();

        if ($pageId === null) {
            throw new NotFoundException('Not found page for this field');
        }

        return $this->createSeoTask->run($data->setPageId($pageId));
    }
}

