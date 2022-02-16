<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Tasks\FindSeoByIdTaskInterface;
use App\Ship\Parents\Actions\Action;

class FindSeoByIdAction extends Action implements FindSeoByIdActionInterface
{
    public function __construct(
        private FindSeoByIdTaskInterface $findSeoByIdTask
    )
    {
    }

    public function run(int $id): SeoDto
    {
        return $this->findSeoByIdTask->run($id);
    }
}

interface FindSeoByIdActionInterface
{
    public function run(int $id): SeoDto;
}
