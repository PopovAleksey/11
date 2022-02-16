<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Tasks\CreateSeoTaskInterface;
use App\Ship\Parents\Actions\Action;

class CreateSeoAction extends Action implements CreateSeoActionInterface
{
    public function __construct(
        private CreateSeoTaskInterface $createSeoTask
    )
    {
    }

    public function run(SeoDto $data): bool
    {
        return $this->createSeoTask->run($data);
    }
}

