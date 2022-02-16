<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Containers\Constructor\Seo\Tasks\UpdateSeoTaskInterface;
use App\Ship\Parents\Actions\Action;

class UpdateSeoAction extends Action implements UpdateSeoActionInterface
{
    public function __construct(
        private UpdateSeoTaskInterface $updateSeoTask
    )
    {
    }

    public function run(SeoDto $data): SeoDto
    {
        return $this->updateSeoTask->run($data);
    }
}

interface UpdateSeoActionInterface
{
    public function run(SeoDto $data): SeoDto;
}
